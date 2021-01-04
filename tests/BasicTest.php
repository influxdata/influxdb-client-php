<?php

namespace InfluxDB2Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\QueryApi;
use InfluxDB2\WriteApi;
use PHPUnit\Framework\TestCase;

/**
 * Parent class for all units tests that uses mocked InfluxDB server
 * @package InfluxDB2Test
 */
abstract class BasicTest extends TestCase
{
    /** @var Client */
    protected $client;
    /** @var WriteApi */
    protected $writeApi;
    /** @var QueryApi */
    protected $queryApi;
    /** @var MockHandler */
    protected $mockHandler;
    /** @var array */
    protected $container;

    /**
     * @before
     * @param string $url
     * @param string $logFile default log file
     */
    public function setUp($url = "http://localhost:8086", $logFile = "php://output"): void
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

        $this->container = [];
        $history = Middleware::history($this->container);

        $handlerStack = HandlerStack::create($this->mockHandler);

        $handlerStack->push($history);

        $this->writeApi->http = new \GuzzleHttp\Client([
            'base_uri' => $this->writeApi->options["url"],
            'handler' => $handlerStack,
        ]);

        $this->queryApi->http = new \GuzzleHttp\Client([
            'base_uri' => $this->writeApi->options["url"],
            'handler' => $handlerStack,
        ]);
    }

    public function tearDown(): void
    {
        $this->client->close();
    }

    protected function getWriteOptions(): ?array
    {
        return null;
    }
}
