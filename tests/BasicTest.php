<?php

namespace InfluxDB2Test;


use GuzzleHttp\Handler\MockHandler;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\QueryApi;
use InfluxDB2\WriteApi;
use PHPUnit\Framework\TestCase;

/**
 * Class BasicTest
 * @package InfluxDB2Test
 */
class BasicTest extends TestCase
{
    /** @var Client */
    protected $client;
    /** @var WriteApi */
    protected $writeApi;
    /** @var QueryApi */
    protected $queryApi;
    /** @var MockHandler */
    protected $mockHandler;

    /**
     * @before
     */
    public function setUp()
    {
        $this->client = new Client([
            "url" => "http://localhost:9999",
            "token" => "my-token",
            "bucket" => "my-bucket",
            "precision" => WritePrecision::NS,
            "org" => "my-org"
        ]);

        $this->writeApi = $this->client->createWriteApi();
        $this->queryApi = $this->client->createQueryApi();

        $this->mockHandler = new MockHandler();

        $this->writeApi->http = new \GuzzleHttp\Client([
            'handler' => $this->mockHandler,
        ]);

        $this->queryApi->http = new \GuzzleHttp\Client([
            'handler' => $this->mockHandler,
        ]);
    }

    public function tearDown()
    {
        $this->client->close();
    }
}
