<?php

namespace InfluxDB2Test;

use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use InfluxDB2\ApiException;

require_once('BasicTest.php');

class DefaultApiTest extends BasicTest
{
    public function testUserAgent()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertStringStartsWith('influxdb-client-php/',
            strval($request->getHeader("User-Agent")[0]));
    }

    public function testContentType()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertNotEmpty($request->getHeader("Content-Type"));
    }

    public function testApiException()
    {
        $this->mockHandler->append(new Response(400));

        $this->expectException(ApiException::class);

        $this->writeApi->write('h2o,location=west value=33i 15');
    }

    public function testInvalidArgument()
    {
        $this->mockHandler->append(new Response(204));

        $this->writeApi->options["org"] = '';

        $this->expectException(InvalidArgumentException::class);

        $this->writeApi->write('h2o,location=west value=33i 15');
    }
}
