<?php

namespace InfluxDB2Generated;

use InfluxDB2\Client;
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

    public function testDummy()
    {
        $this->assertTrue(true);
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


}
