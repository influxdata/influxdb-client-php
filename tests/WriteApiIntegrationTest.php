<?php

namespace InfluxDB2Test;

use InfluxDB2\Client;
use InfluxDB2\Point;
use InfluxDB2\Model\WritePrecision;
use PHPUnit\Framework\TestCase;

class WriteApiIntegrationTest extends TestCase
{
    private $client;
    private $writeApi;

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
            "org" => "my-org",
            "debug" => true
        ]);

        $this->writeApi = $this->client->createWriteApi();
    }

    public function testExistsWriteApi()
    {
        $this->assertNotNull($this->writeApi);
    }

    public function testWriteApiWriteRaw()
    {
        $payload = 'h2o_feet,location=coyote_creek water_level=2.0 2';
        $response = $this->writeApi->writeRaw($payload);
        self::assertNull($response);
    }

    public function testWriteArray()
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

        $response = $this->writeApi->write($data, WritePrecision::S, "my-bucket", "my-org");
        self::assertNull($response);
    }

    public function testWriteArrayOfPoint()
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

        $response = $this->writeApi->write($data, WritePrecision::S, "my-bucket", "my-org");
        self::assertNull($response);
    }

    public function testWriteArrayOfArray()
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

        $response = $this->writeApi->write($data, WritePrecision::S, "my-bucket", "my-org");
        self::assertNull($response);
    }
}
