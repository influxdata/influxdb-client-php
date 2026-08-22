<?php

namespace InfluxDB2Test;

use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use InfluxDB2\WriteApi;
use InfluxDB2\WriteType;
use PHPUnit\Framework\TestCase;

/**
 * @group integration
 */
class WriteApiIntegrationTest extends TestCase
{
    private Client $client;
    private WriteApi $writeApi;

    /**
     * @before
     */
    public function setUp(): void
    {
        $this->client = new Client([
            "url" => "http://localhost:8086",
            "token" => "my-token",
            "bucket" => "my-bucket",
            "precision" => WritePrecision::NS,
            "org" => "my-org",
            "debug" => false
        ]);
        $this->writeApi = $this->client->createWriteApi();
    }

    public function testWriteApiWriteRaw(): void
    {
        $payload = 'h2o_feet,location=coyote_creek water_level=2.0 2';
        $this->writeApi->writeRaw($payload);
        self::expectNotToPerformAssertions();
    }

    public function testWriteArray(): void
    {
        $data = [
            'name' => "h2o",
            'tags' => [
                'host' => 'aws', 'region' => 'us'
            ],
            'fields' => [
                'level' => 5, 'saturation' => 99
            ],
            'time' => 123
        ];

        $this->writeApi->write($data, WritePrecision::S, "my-bucket", "my-org");
        self::expectNotToPerformAssertions();
    }

    public function testBatchingWrite(): void
    {
        $writeApi = $this->client->createWriteApi(
            ["writeType" => WriteType::BATCHING, 'batchSize' => 3]
        );

        $data = ['name' => 'cpu',
            'tags' => ['host' => 'server_nl', 'region' => 'us'],
            'fields' => ['internal' => 5, 'external' => 6],
            'time' => microtime(true)];

        $writeApi->write($data, WritePrecision::MS);

        $p1 = ['name' => "h2o", 'tags' => ['host' => 'aws', 'region' => 'us'], 'fields' => ['level' => 1, 'saturation' => 99], 'time' => 1];
        $p2 = ['name' => "h2o", 'tags' => ['host' => 'aws', 'region' => 'us'], 'fields' => ['level' => 2, 'saturation' => 98], 'time' => 2];
        $p3 = ['name' => "h2o", 'tags' => ['host' => 'aws', 'region' => 'us'], 'fields' => ['level' => 3, 'saturation' => 97], 'time' => 3];
        $p4 = ['name' => "h2o", 'tags' => ['host' => 'aws', 'region' => 'us'], 'fields' => ['level' => 4, 'saturation' => 96], 'time' => 4];
        $p5 = ['name' => "h2o", 'tags' => ['host' => 'aws', 'region' => 'us'], 'fields' => ['level' => 5, 'saturation' => 95], 'time' => 5];
        $p6 = ['name' => "h2o", 'tags' => ['host' => 'aws', 'region' => 'us'], 'fields' => ['level' => 6, 'saturation' => 95], 'time' => 6];

        $writeApi->write($p1);
        $writeApi->write($p2);
        $writeApi->write($p3);
        $writeApi->write($p4);
        $writeApi->write($p5);
        $writeApi->write($p6);

        $this->client->close();
        self::expectNotToPerformAssertions();
    }

    public function testWriteArrayOfPoint(): void
    {
        $point1 = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time(123);
        $point2 = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 3)
            ->time(124);

        $data = array($point1, $point2);

        $this->writeApi->write($data, WritePrecision::S, "my-bucket", "my-org");
        self::expectNotToPerformAssertions();
    }

    public function testWriteArrayOfArray(): void
    {
        $data1 = [
            'name' => "h2o",
            'tags' => [
                'host' => 'aws', 'region' => 'us'
            ],
            'fields' => [
                'level' => 5, 'saturation' => 99
            ],
            'time' => 123
        ];

        $data2 = [
            'name' => "h2o",
            'tags' => [
                'host' => 'aws', 'region' => 'us'
            ],
            'fields' => [
                'level' => 6, 'saturation' => 98
            ],
            'time' => 124
        ];

        $data = array($data1, $data2);

        $this->writeApi->write($data, WritePrecision::S, "my-bucket", "my-org");
        self::expectNotToPerformAssertions();
    }
}
