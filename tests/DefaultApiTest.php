<?php

namespace InfluxDB2Test;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\ApiException;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InvalidArgumentException;

require_once('BasicTest.php');

class DefaultApiTest extends BasicTest
{
    public function testUserAgent()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertStringStartsWith(
            'influxdb-client-php/',
            strval($request->getHeader("User-Agent")[0])
        );
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

    public function testDefaultVerifySSL()
    {
        $config = $this->writeApi->http->getConfig();

        $this->assertEquals(true, $config['verify']);
    }

    public function testConfigureVerifySSL()
    {
        $client = new Client([
            "url" => "http://localhost:8086",
            "token" => "my-token",
            "bucket" => "my-bucket",
            "precision" => WritePrecision::NS,
            "org" => "my-org",
            "logFile" => "php://output",
            "verifySSL" => false
        ]);

        $config = $client->createQueryApi()->http->getConfig();

        $this->assertEquals(false, $config['verify']);

        $client->close();
    }

    public function test_follow_redirect()
    {
        $this->mockHandler->append(
            new Response(
                307,
                ['location' => 'http://localhost:8088']
            ),
            new Response(204, [], "{\"status\": \"pass\"}")
        );
        $this->writeApi->write('h2o,location=west value=33i 15');

        $this->assertCount(2, $this->container);

        $this->assertEquals('Token my-token', $this->getHeader($this->container[0]['request']));
        $this->assertEquals('Token my-token', $this->getHeader($this->container[1]['request']));
    }

    /**
     * @param Request $request with headers
     * @return string Authorization headers
     */
    private function getHeader(Request $request): string
    {
        return implode(' ', $request->getHeaders()['Authorization']);
    }
}
