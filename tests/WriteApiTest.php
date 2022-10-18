<?php

namespace InfluxDB2Test;

use Exception;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\ApiException;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use InfluxDB2\WriteRetry;

require_once('BasicTest.php');

/**
 * Class WriteApiTest
 * @package InfluxDB2Test
 */
class WriteApiTest extends BasicTest
{
    private const ID_TAG = "132-987-655";
    private const CUSTOMER_TAG = "California Miner";

    public function setUp($url = "http://localhost:8086", $logFile = "php://output"): void
    {
        parent::setUp($url, $logFile);

        putenv("data_center=LA");
    }

    public function testWriteLineProtocol()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals('h2o,location=west value=33i 15', $request->getBody());
    }

    public function testWritePoint()
    {
        $this->mockHandler->append(new Response(204));

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        $this->writeApi->write($point);

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals('h2o,location=europe level=2i', $request->getBody());
    }

    public function testWriteArray()
    {
        $this->mockHandler->append(new Response(204));

        $array = array('name' => 'h2o',
            'tags' => array('host' => 'aws', 'region' => 'us'),
            'fields' => array('level' => 5, 'saturation' => '99%'),
            'time' => 123);

        $this->writeApi->write($array);

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals('h2o,host=aws,region=us level=5i,saturation="99%" 123', $request->getBody());
    }

    public function testWriteCollection()
    {
        $this->mockHandler->append(new Response(204));

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        $array = array('name' => 'h2o',
            'tags' => array('host' => 'aws', 'region' => 'us'),
            'fields' => array('level' => 5, 'saturation' => '99%'),
            'time' => 123);

        $this->writeApi->write(array('h2o,location=west value=33i 15', null, $point, $array));

        $request = $this->mockHandler->getLastRequest();

        $expected = "h2o,location=west value=33i 15\n"
            . "h2o,location=europe level=2i\n"
            . "h2o,host=aws,region=us level=5i,saturation=\"99%\" 123";

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals($expected, strval($request->getBody()));
    }

    public function testAuthorizationHeader()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals('Token my-token', implode(' ', $request->getHeaders()['Authorization']));
    }

    public function testWithoutData()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('');

        $request = $this->mockHandler->getLastRequest();

        $this->assertNull($request);
    }

    public function testInfluxException()
    {
        $errorBody = '{"code":"invalid","message":"unable to parse \'h2o_feet, location=coyote_creek water_level=1.0 1\': missing tag key"}';

        $this->mockHandler->append(new Response(400, array('X-Platform-Error-Code' => 'invalid'), $errorBody));

        try {
            $this->writeApi->write('h2o,location=west value=33i 15');
            $this->fail();
        } catch (ApiException $e) {
            $this->assertEquals(400, $e->getCode());
            $this->assertEquals('invalid', implode($e->getResponseHeaders()['X-Platform-Error-Code']));
            $this->assertEquals($errorBody, strval($e->getResponseBody()));
        } catch (Exception $e) {
            $this->fail();
        }
    }

    public function testWritePointWithDefaultTags()
    {
        $this->mockHandler->append(new Response(204));

        $this->writeApi->pointSettings->addDefaultTag('id', WriteApiTest::ID_TAG);
        $this->writeApi->pointSettings->addDefaultTag('customer', WriteApiTest::CUSTOMER_TAG);
        $this->writeApi->pointSettings->addDefaultTag('data_center', '${env.data_center}');

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        $this->writeApi->write($point);

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals(
            'h2o,customer=California\ Miner,data_center=LA,id=132-987-655,location=europe level=2i',
            strval($request->getBody())
        );
    }

    public function testWriteArrayWithDefaultTags()
    {
        $this->mockHandler->append(new Response(204));

        $this->writeApi->pointSettings->addDefaultTag('id', WriteApiTest::ID_TAG);
        $this->writeApi->pointSettings->addDefaultTag('customer', WriteApiTest::CUSTOMER_TAG);
        $this->writeApi->pointSettings->addDefaultTag('data_center', '${env.data_center}');

        $array = array('name' => 'h2o',
            'tags' => array('host' => 'aws', 'region' => 'us'),
            'fields' => array('level' => 5, 'saturation' => '99%'),
            'time' => 123);

        $this->writeApi->write($array);

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals(
            'h2o,customer=California\ Miner,data_center=LA,host=aws,id=132-987-655,region=us level=5i,saturation="99%" 123',
            strval($request->getBody())
        );
    }

    public function testWriteCollectionWithDefaultTags()
    {
        $this->mockHandler->append(new Response(204));

        $this->writeApi->pointSettings->addDefaultTag('id', WriteApiTest::ID_TAG);
        $this->writeApi->pointSettings->addDefaultTag('customer', WriteApiTest::CUSTOMER_TAG);
        $this->writeApi->pointSettings->addDefaultTag('data_center', '${env.data_center}');

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        $array = array('name' => 'h2o',
            'tags' => array('host' => 'aws', 'region' => 'us'),
            'fields' => array('level' => 5, 'saturation' => '99%'),
            'time' => 123);

        $this->writeApi->write(array('h2o,location=west value=33i 15', null, $point, $array));

        $request = $this->mockHandler->getLastRequest();

        $expected = "h2o,location=west value=33i 15\n"
            . "h2o,customer=California\ Miner,data_center=LA,id=132-987-655,location=europe level=2i\n"
            . "h2o,customer=California\ Miner,data_center=LA,host=aws,id=132-987-655,region=us level=5i,saturation=\"99%\" 123";

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals($expected, strval($request->getBody()));
    }

    public function testWriteArrayWithoutTagsWithDefaultTags()
    {
        $this->mockHandler->append(new Response(204));

        $this->writeApi->pointSettings->addDefaultTag('id', WriteApiTest::ID_TAG);
        $this->writeApi->pointSettings->addDefaultTag('customer', WriteApiTest::CUSTOMER_TAG);
        $this->writeApi->pointSettings->addDefaultTag('data_center', '${env.data_center}');

        $array = array('name' => 'h2o',
            'fields' => array('level' => 5, 'saturation' => '99%'),
            'time' => 123);

        $this->writeApi->write($array);

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals(
            'http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri())
        );
        $this->assertEquals(
            'h2o,customer=California\ Miner,data_center=LA,id=132-987-655 level=5i,saturation="99%" 123',
            strval($request->getBody())
        );
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

        $this->writeApi->writeOptions->retryInterval = 1000;
        $this->writeApi->writeOptions->maxRetries = 3;
        $this->writeApi->writeOptions->maxRetryDelay = 15000;
        $this->writeApi->writeOptions->exponentialBase = 2;

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        $this->expectExceptionCode(429);
        $this->expectException(ApiException::class);
        $this->writeApi->write($point);

        $this->assertCount(4, $this->requests);
        $this->assertCount(1, $this->mockHandler);
    }

    public function testRetryMaxTime()
    {
        $this->mockHandler->append(
        // regular call
            new Response(429),
            // retry
            new Response(429),
            // retry
            new Response(200)
        );

        $this->writeApi->writeOptions->retryInterval = 1000;
        $this->writeApi->writeOptions->maxRetries = 3;
        $this->writeApi->writeOptions->maxRetryDelay = 15000;
        $this->writeApi->writeOptions->exponentialBase = 2;
        $this->writeApi->writeOptions->maxRetryTime = 300;

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        $this->expectException(ApiException::class);
        $this->expectExceptionCode(429);

        $this->writeApi->write($point);

        $this->assertCount(2, $this->requests);
        $this->assertCount(1, $this->mockHandler);
    }


    public function testRetryBackoffTime()
    {
        $retry = new WriteRetry();

        $backoff = $retry->getBackoffTime(1);
        $this->assertGreaterThanOrEqual(5000, $backoff);
        $this->assertLessThanOrEqual(10000, $backoff);

        $backoff = $retry->getBackoffTime(2);
        $this->assertGreaterThanOrEqual(10000, $backoff);
        $this->assertLessThanOrEqual(20000, $backoff);

        $backoff = $retry->getBackoffTime(3);
        $this->assertGreaterThanOrEqual(20000, $backoff);
        $this->assertLessThanOrEqual(40000, $backoff);

        $backoff = $retry->getBackoffTime(4);
        $this->assertGreaterThanOrEqual(40000, $backoff);
        $this->assertLessThanOrEqual(80000, $backoff);

        $backoff = $retry->getBackoffTime(5);
        $this->assertGreaterThanOrEqual(80000, $backoff);
        $this->assertLessThanOrEqual(125000, $backoff);

        $backoff = $retry->getBackoffTime(6);
        $this->assertGreaterThanOrEqual(80000, $backoff);
        $this->assertLessThanOrEqual(125000, $backoff);
    }

    public function testConnectExceptionRetry()
    {
        $client = new Client([
            "url" => "http://nonexistenthost:8086/",
            "token" => "my-token",
            "bucket" => "my-bucket",
            "precision" => WritePrecision::NS,
            "org" => "my-org",
            "logFile" => "php://output"
        ]);

        $writeApi = $client->createWriteApi(["retryInterval" => 100]);
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage("Could not resolve host: nonexistenthost");

        try {
            $writeApi->write($point);
        } catch (ApiException $e) {
            $this->assertEquals(ConnectException::class, get_class($e->getPrevious()));
            throw $e;
        }
    }
}
