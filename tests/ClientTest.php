<?php

namespace InfluxDB2Test;

use Exception;
use InfluxDB2\Client;

require_once('BasicTest.php');

/**
 * @group integration
 */
class ClientTest extends BasicTest
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
}
