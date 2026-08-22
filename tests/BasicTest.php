<?php

namespace InfluxDB2Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\QueryApi;
use InfluxDB2\WriteApi;
use InfluxDB2\WriteType;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Parent class for all units tests that uses mocked InfluxDB server
 * @package InfluxDB2Test
 */
abstract class BasicTest extends TestCase
{
    protected Client $client;
    protected WriteApi $writeApi;
    protected QueryApi $queryApi;
    protected MockHandler $mockHandler;
    /** @var array<int, array{request: RequestInterface, response: ResponseInterface|null, error: mixed, options: array<mixed>}> */
    protected array $requests;

    /**
     * @before
     * @param string $url
     * @param string $logFile default log file
     */
    public function setUp(string $url = "http://localhost:8086", string $logFile = "php://output"): void
    {
        $this->client = new Client([
            "url" => $url,
            "token" => "my-token",
            "bucket" => "my-bucket",
            "precision" => WritePrecision::NS,
            "org" => "my-org",
            "logFile" => $logFile
        ]);

        $this->writeApi = $this->client->createWriteApi($this->getWriteOptions());
        $this->queryApi = $this->client->createQueryApi();

        $this->mockHandler = new MockHandler();

        $this->requests = [];

        $handlerStack = HandlerStack::create($this->mockHandler);
        $handlerStack->push(Middleware::history($this->requests));

        $this->writeApi->http = $this->writeApi->configuredClient(new \GuzzleHttp\Client([
            'handler' => $handlerStack,
        ]));

        $this->queryApi->http = $this->writeApi->configuredClient(new \GuzzleHttp\Client([
            'handler' => $handlerStack,
        ]));
    }

    public function tearDown(): void
    {
        $this->client->close();
    }

    /**
     * @return array{
     *     writeType?: WriteType::BATCHING|WriteType::SYNCHRONOUS,
     *     batchSize?: int,
     *     retryInterval?: int,
     *     maxRetries?: int,
     *     maxRetryDelay?: int,
     *     maxRetryTime?: int,
     *     exponentialBase?: int,
     *     jitterInterval?: int,
     * }|null
     */
    protected function getWriteOptions(): ?array
    {
        return null;
    }
}
