<?php

namespace InfluxDB2Test;

use GuzzleHttp\Psr7\Response;
use InfluxDB2\ApiException;
use InfluxDB2\Point;

/**
 * Class WriteApiTest
 * @package InfluxDB2Test
 */
require_once('BasicTest.php');

class WriteApiTest extends BasicTest
{
    public function testWriteLineProtocol()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals('/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
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

        $this->assertEquals('/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
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

        $this->assertEquals('/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
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

        $this->assertEquals('/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
            strval($request->getUri()));
        $this->assertEquals($expected, strval($request->getBody()));
    }

    public function testAuthorizationHeader()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals('/api/v2/write?org=my-org&bucket=my-bucket&precision=ns',
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
}
