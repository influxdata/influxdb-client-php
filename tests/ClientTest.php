<?php

namespace InfluxDB2Test;

use Exception;
use InfluxDB2\Client;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ClientTest extends IntegrationBaseTestCase
{
    public function test_health(): void
    {
        $health = $this->client->health();

        self::assertEquals('ready for queries and writes', $health->getMessage());
        self::assertEquals('influxdb', $health->getName());
        self::assertEquals('pass', $health->getStatus());
    }

    public function test_health_not_running(): void
    {
        $this->client->close();
        $this->client = new Client([
            "url" => "http://localhost:8099",
            "token" => "my-token",
        ]);

        $health = $this->client->health();

        self::assertStringContainsString('Failed to connect to localhost port 8099', $health->getMessage());
        self::assertEquals('influxdb', $health->getName());
        self::assertEquals('fail', $health->getStatus());
    }

    public function test_ping(): void
    {
        $ping = $this->client->ping();

        self::assertArrayHasKey('X-Influxdb-Build', $ping);
        self::assertArrayHasKey('X-Influxdb-Version', $ping);
    }

    public function test_ping_not_running(): void
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

    public function test_debug(): void
    {
        $logFileMetadata = stream_get_meta_data(tmpfile());
        self::assertArrayHasKey('uri', $logFileMetadata);
        $logFilePath = $logFileMetadata['uri'];
        self::assertIsString($logFilePath);
        $this->client->close();
        $this->client = new Client([
            "url" => "http://localhost:8086",
            "token" => "my-token",
            "debug" => true,
            "logFile" => $logFilePath
        ]);

        $tables = $this->client->createQueryApi()->query("buckets()", "my-org");
        self::assertCount(1, $tables);

        $logFileContents = file_get_contents($logFilePath);
        self::assertIsString($logFileContents);
        self::assertStringContainsString('Authorization: ***', $logFileContents);
        unlink($logFilePath);
    }
}
