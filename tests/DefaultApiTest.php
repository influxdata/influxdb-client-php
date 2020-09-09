<?php

namespace InfluxDB2Test;

use GuzzleHttp\Psr7\Response;
use InfluxDB2\ApiException;
use InvalidArgumentException;

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

    public function testTrailingSlashInUrl()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns', strval($request->getUri()));

        $this->tearDown();
        $this->setUp("http://localhost:8086/");

        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns', strval($request->getUri()));
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
