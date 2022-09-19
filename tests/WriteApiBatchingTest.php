<?php

namespace InfluxDB2Test;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\ApiException;
use InfluxDB2\Point;

require_once('BasicTest.php');
/**
 * Class WriteApiBatchingTest
 * @package InfluxDB2Test
 */
class WriteApiBatchingTest extends BasicTest
{
    protected function getWriteOptions(): ?array
    {
        return array('writeType' => 2, 'batchSize' => 2);
    }

    public function testBatchSize()
    {
        $this->mockHandler->append(
            new Response(204),
            new Response(204)
        );

        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=1.0 1');
        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=2.0 2');
        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=3.0 3');
        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=4.0 4');

        $this->assertCount(2, $this->requests);

        $result1 = "h2o_feet,location=coyote_creek level\\ water_level=1.0 1\n"
            . "h2o_feet,location=coyote_creek level\\ water_level=2.0 2";
        $result2 = "h2o_feet,location=coyote_creek level\\ water_level=3.0 3\n"
            . "h2o_feet,location=coyote_creek level\\ water_level=4.0 4";

        $this->assertEquals($result1, $this->requests[0]['request']->getBody());
        $this->assertEquals($result2, $this->requests[1]['request']->getBody());
    }

    public function testBatchSizeGroupBy()
    {
        $this->mockHandler->append(
            new Response(204),
            new Response(204),
            new Response(204),
            new Response(204),
            new Response(204)
        );

        $bucket = 'my-bucket';
        $bucket2 = 'my-bucket2';

        $this->writeApi->write(
            'h2o_feet,location=coyote_creek level\\ water_level=1.0 1',
            'ns',
            $bucket,
            'my-org'
        );
        $this->writeApi->write(
            'h2o_feet,location=coyote_creek level\\ water_level=2.0 2',
            's',
            $bucket,
            'my-org'
        );
        $this->writeApi->write(
            'h2o_feet,location=coyote_creek level\\ water_level=3.0 3',
            'ns',
            $bucket,
            'my-org-a'
        );
        $this->writeApi->write(
            'h2o_feet,location=coyote_creek level\\ water_level=4.0 4',
            'ns',
            $bucket,
            'my-org-a'
        );
        $this->writeApi->write(
            'h2o_feet,location=coyote_creek level\\ water_level=5.0 5',
            'ns',
            $bucket2,
            'my-org-a'
        );
        $this->writeApi->write(
            'h2o_feet,location=coyote_creek level\\ water_level=6.0 6',
            'ns',
            $bucket,
            'my-org-a'
        );

        $this->assertCount(5, $this->requests);

        $request = $this->requests[0]['request'];

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals('h2o_feet,location=coyote_creek level\\ water_level=1.0 1', $request->getBody());

        $request = $this->requests[1]['request'];

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=s',
            strval($request->getUri())
        );
        $this->assertEquals('h2o_feet,location=coyote_creek level\\ water_level=2.0 2', $request->getBody());

        $request = $this->requests[2]['request'];

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org-a&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals("h2o_feet,location=coyote_creek level\\ water_level=3.0 3\n"
            . 'h2o_feet,location=coyote_creek level\\ water_level=4.0 4', $request->getBody());

        $request = $this->requests[3]['request'];

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org-a&bucket=my-bucket2&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals('h2o_feet,location=coyote_creek level\\ water_level=5.0 5', $request->getBody());

        $request = $this->requests[4]['request'];

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org-a&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals('h2o_feet,location=coyote_creek level\\ water_level=6.0 6', $request->getBody());
    }

    public function testFlushAllByCloseClient()
    {
        $this->mockHandler->append(new Response(204));

        $this->writeApi->writeOptions->batchSize = 10;

        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=1.0 1');
        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=2.0 2');
        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=3.0 3');

        $this->assertNull($this->mockHandler->getLastRequest());

        $this->client->close();

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals("h2o_feet,location=coyote_creek level\\ water_level=1.0 1\n"
            . "h2o_feet,location=coyote_creek level\\ water_level=2.0 2\n"
            . 'h2o_feet,location=coyote_creek level\\ water_level=3.0 3', $request->getBody());
    }

    public function testRetryIntervalByConfig()
    {
        $errorBody = '{"code":"temporarily unavailable","message":"Token is temporarily over quota.'
            . 'The Retry-After header describes when to try the write again."}';

        $this->mockHandler->append(new Response(
            429,
            ['X-Platform-Error-Code' => 'temporarily unavailable'],
            $errorBody
        ), new Response(204));

        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=1.0 1');
        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=2.0 2');

        $this->assertCount(2, $this->requests);
        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals("h2o_feet,location=coyote_creek water_level=1.0 1\n"
            . "h2o_feet,location=coyote_creek water_level=2.0 2", $request->getBody()->getContents());
    }

    public function testRetryIntervalByHeader()
    {
        $errorBody = '{"code":"temporarily unavailable","message":"Token is temporarily over quota.'
            . 'The Retry-After header describes when to try the write again."}';

        $this->mockHandler->append(new Response(
            429,
            ['X-Platform-Error-Code' => 'temporarily unavailable',
            'Retry-After' => '3'],
            $errorBody
        ), new Response(204));

        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=1.0 1');
        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=2.0 2');

        $this->assertCount(2, $this->requests);
        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals("h2o_feet,location=coyote_creek water_level=1.0 1\n"
            . "h2o_feet,location=coyote_creek water_level=2.0 2", $request->getBody()->getContents());
    }

    public function testRetryIntervalMaxRetries()
    {
        $errorBody = '{"code":"temporarily unavailable","message":"Token is temporarily over quota.'
            . 'The Retry-After header describes when to try the write again."}';

        $this->writeApi->writeOptions->maxRetries = 2;

        $this->mockHandler->append(
            new Response(429, ['X-Platform-Error-Code' => 'temporarily unavailable'], $errorBody),
            new Response(429, ['X-Platform-Error-Code' => 'temporarily unavailable'], $errorBody),
            new Response(429, ['X-Platform-Error-Code' => 'temporarily unavailable'], $errorBody)
        );

        $this->expectException(ApiException::class);

        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=1.0 1');
        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=2.0 2');

        $this->assertCount(3, $this->requests);
    }

    public function testRetryCount()
    {
        $this->mockHandler->append(
        // regular call
            new Response(429),
            // retry
            new Response(429),
            // retry
            new Response(429),
            // retry
            new Response(429),
            // not called
            new Response(429)
        );

        $this->writeApi->writeOptions->batchSize = 1;
        $this->writeApi->writeOptions->retryInterval = 1000;
        $this->writeApi->writeOptions->maxRetries = 3;
        $this->writeApi->writeOptions->maxRetryDelay = 15000;
        $this->writeApi->writeOptions->exponentialBase = 2;

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        try {
            $this->writeApi->write($point);
        } catch (ApiException $e) {
            $this->assertEquals(429, $e->getCode());
        }

        $this->assertCount(4, $this->requests);

        $count = $this->mockHandler->count();
        $this->assertEquals(1, $count);
    }

    public function testRetryConnectionError()
    {
        $errorMessage = 'Failed to connect to localhost port 8086';

        $this->writeApi->writeOptions->maxRetries = 2;
        $this->writeApi->writeOptions->retryInterval = 1000;
        $this->writeApi->writeOptions->maxRetryDelay = 15000;
        $this->writeApi->writeOptions->exponentialBase = 2;

        $this->mockHandler->append(
            new ConnectException($errorMessage, new Request('POST', '')),
            new ConnectException($errorMessage, new Request('POST', '')),
            new ConnectException($errorMessage, new Request('POST', ''))
        );

        $this->expectException(ApiException::class);

        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=1.0 1');
        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=2.0 2');

        $this->assertCount(3, $this->requests);
    }

    public function testJitterInterval()
    {
        $this->mockHandler->append(
            new Response(204),
            new Response(204)
        );

        $this->writeApi->writeOptions->jitterInterval = 2000;

        $start = microtime(true);

        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=1.0 1');
        $this->writeApi->write('h2o_feet,location=coyote_creek level\\ water_level=2.0 2');

        $time = microtime(true) - $start;

        $this->assertTrue($time > 0 && $time <= 2);

        $this->assertCount(1, $this->requests);

        $result1 = "h2o_feet,location=coyote_creek level\\ water_level=1.0 1\n"
            . "h2o_feet,location=coyote_creek level\\ water_level=2.0 2";

        $this->assertEquals($result1, $this->requests[0]['request']->getBody());
    }

    public function testRetryContainsMessage()
    {
        // create log file
        fopen("log_test.txt", "w");

        $this->tearDown();
        $this->setUp("http://localhost:8086", "log_test.txt");

        $this->mockHandler->append(
            new Response(
                429,
                ['X-Platform-Error-Code' => 'temporarily unavailable',
            'Retry-After' => '3'],
                'org 04014de4ed590000 has exceeded limited_write plan limit'
            ),
            new Response(204)
        );

        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=1.0 1');
        $this->writeApi->write('h2o_feet,location=coyote_creek water_level=2.0 2');

        $this->assertCount(2, $this->requests);

        $message = file_get_contents("log_test.txt");
        $this->assertStringContainsString("The retryable error occurred during writing of data. Reason: 'org 04014de4ed590000 has exceeded limited_write plan limit'. Retry in: 3s.", $message);
    }
}
