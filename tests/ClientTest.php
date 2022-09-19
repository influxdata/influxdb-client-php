<?php

namespace InfluxDB2Test;

use Exception;
use InfluxDB2\Client;
use IntegrationBaseTestCase;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ClientTest extends IntegrationBaseTestCase
{
    public function test_health()
    {
        $health = $this->client->health();

        $this->assertEquals('ready for queries and writes', $health->getMessage());
        $this->assertEquals('influxdb', $health->getName());
        $this->assertEquals('pass', $health->getStatus());
    }

    public function test_health_not_running()
    {
        $this->client->close();
        $this->client = new Client([
            "url" => "http://localhost:8099",
            "token" => "my-token",
        ]);

        $health = $this->client->health();

        $this->assertStringContainsString('Failed to connect to localhost port 8099', $health->getMessage());
        $this->assertEquals('influxdb', $health->getName());
        $this->assertEquals('fail', $health->getStatus());
    }

    public function test_ping()
    {
        $ping = $this->client->ping();

        $this->assertArrayHasKey('X-Influxdb-Build', $ping);
        $this->assertArrayHasKey('X-Influxdb-Version', $ping);
    }

    public function test_ping_not_running()
    {
        $this->client->close();
        $this->client = new Client([
            "url" => "http://localhost:8099",
            "token" => "my-token",
        ]);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Failed to connect to localhost");

        $this->client->ping();
    }

    public function test_debug()
    {
        $logFilePath = stream_get_meta_data(tmpfile())['uri'];
        $this->client->close();
        $this->client = new Client([
            "url" => "http://localhost:8086",
            "token" => "my-token",
            "debug" => true,
            "logFile" => $logFilePath
        ]);

        $tables = $this->client->createQueryApi()->query("buckets()", "my-org");
        $this->assertCount(1, $tables);

        $this->assertStringContainsString('Authorization: ***', file_get_contents($logFilePath));
        unlink($logFilePath);
    }
}
