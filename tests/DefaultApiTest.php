<?php

namespace InfluxDB2Test;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\ApiException;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InvalidArgumentException;
use ReflectionObject;

require_once('BasicTest.php');

class DefaultApiTest extends BasicTest
{
    public function testUserAgent(): void
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        self::assertStringStartsWith(
            'influxdb-client-php/',
            strval($request->getHeader("User-Agent")[0])
        );
    }

    public function testTrailingSlashInUrl(): void
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        self::assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns', strval($request->getUri()));

        $this->tearDown();
        $this->setUp("http://localhost:8086/");

        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        self::assertEquals('http://localhost:8086/api/v2/write?org=my-org&bucket=my-bucket&precision=ns', strval($request->getUri()));
    }

    public function testContentType(): void
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        self::assertNotEmpty($request->getHeader("Content-Type"));
    }

    public function testApiException(): void
    {
        $this->mockHandler->append(new Response(400));

        $this->expectException(ApiException::class);

        $this->writeApi->write('h2o,location=west value=33i 15');
    }

    public function testInvalidArgument(): void
    {
        $this->mockHandler->append(new Response(204));

        $this->writeApi->options["org"] = '';

        $this->expectException(InvalidArgumentException::class);

        $this->writeApi->write('h2o,location=west value=33i 15');
    }

    public function testDefaultVerifySSL(): void
    {
        $guzzle = $this->property_value($this->property_value($this->writeApi->http, 'client'), 'httpClient');

        self::assertTrue($guzzle->getConfig()['verify']);
    }

    public function testConfigureVerifySSL(): void
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

        $guzzle = $this->property_value($this->property_value($client->createQueryApi()->http, 'client'), 'httpClient');

        self::assertFalse($guzzle->getConfig()['verify']);

        $client->close();
    }

    public function testFollowRedirect(): void
    {
        $this->mockHandler->append(
            new Response(
                307,
                ['location' => 'http://localhost:8086']
            ),
            new Response(204, [], "{\"status\": \"pass\"}")
        );
        $this->writeApi->write('h2o,location=west value=33i 15');

        self::assertCount(2, $this->requests);

        self::assertEquals('Token my-token', $this->getHeader($this->requests[0]['request']));
        self::assertEquals('Token my-token', $this->getHeader($this->requests[1]['request']));
    }

    public function testJsonBodyWithMessageReturnsMessage(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessageMatches('~^\[500\].*\(a failure\)$~');
        $this->mockHandler->append(
            new Response(500, [], "{\"message\": \"a failure\"}")
        );
        $this->queryApi->query('some broken query');
    }

    public function testJsonBodyWithErrorReturnsMessage(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessageMatches('~^\[500\].*\(another failure\)$~');
        $this->mockHandler->append(
            new Response(500, [], "{\"error\": \"another failure\"}")
        );
        $this->queryApi->query('some broken query');
    }

    /**
     * @param Request $request with headers
     * @return string Authorization headers
     */
    private function getHeader(Request $request): string
    {
        return implode(' ', $request->getHeaders()['Authorization']);
    }

    /**
     * @throws \ReflectionException fail to access property
     */
    private function property_value(object $object, string $property_name): object
    {
        $reflection = new ReflectionObject($object);
        $property = $reflection->getProperty($property_name);
        if (PHP_VERSION_ID < 80100) {
            $property->setAccessible(true);
        }
        return $property->getValue($object);
    }
}
