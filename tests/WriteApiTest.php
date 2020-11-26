<?php

namespace InfluxDB2Test;

use GuzzleHttp\Psr7\Response;
use InfluxDB2\ApiException;
use InfluxDB2\Point;

require_once('BasicTest.php');

/**
 * Class WriteApiTest
 * @package InfluxDB2Test
 */
class WriteApiTest extends BasicTest
{
    private const ID_TAG = "132-987-655";
    private const CUSTOMER_TAG = "California Miner";

    public function setUp($url = "http://localhost:8086", $logFile = "php://output")
    {
        parent::setUp($url, $logFile);

        putenv("data_center=LA");
    }

    public function testWriteLineProtocol()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
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

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
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

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
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

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
        $this->assertEquals($expected, strval($request->getBody()));
    }

    public function testAuthorizationHeader()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
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
        }
        catch (ApiException $e)
        {
            $this->assertEquals(400, $e->getCode());
            $this->assertEquals('invalid', implode($e->getResponseHeaders()['X-Platform-Error-Code']));
            $this->assertEquals($errorBody, strval($e->getResponseBody()));
        }
        catch (\Exception $e)
        {
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

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
        $this->assertEquals('h2o,customer=California\ Miner,data_center=LA,id=132-987-655,location=europe level=2i',
            strval($request->getBody()));
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

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
        $this->assertEquals('h2o,customer=California\ Miner,data_center=LA,host=aws,id=132-987-655,region=us level=5i,saturation="99%" 123',
            strval($request->getBody()));
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

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
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

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
        $this->assertEquals('h2o,customer=California\ Miner,data_center=LA,id=132-987-655 level=5i,saturation="99%" 123',
            strval($request->getBody()));
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
            new Response(429));

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

        $this->assertEquals(4, count($this->container));

        $count = $this->mockHandler->count();
        $this->assertEquals(1, $count);
    }
}
