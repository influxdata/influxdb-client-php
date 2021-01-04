<?php

namespace InfluxDB2Test;

use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use PHPUnit\Framework\TestCase;

class PointSettingsTest extends TestCase
{
    private const ID_TAG = "132-987-655";
    private const CUSTOMER_TAG = "California Miner";

    /** @var Client */
    private $client;

    public function setUp(): void
    {
        $this->client = new Client([
            "url" => "http://localhost:8086",
            "token" => "my-token",
            "bucket" => "my-bucket",
            "precision" => WritePrecision::NS,
            "org" => "my-org",
            "tags" => ['id' => PointSettingsTest::ID_TAG]
        ]);
    }

    public function testPointSettings()
    {
        $writeApi = $this->client->createWriteApi(null, ['customer' => PointSettingsTest::CUSTOMER_TAG]);

        $defaultTags = $writeApi->pointSettings->getDefaultTags();

        $this->assertEquals(PointSettingsTest::ID_TAG, $defaultTags['id']);
        $this->assertEquals(PointSettingsTest::CUSTOMER_TAG, $defaultTags['customer']);
    }

    public function testPointSettingsWithAdd()
    {
        putenv("data_center=LA");

        $writeApi = $this->client->createWriteApi();

        $writeApi->pointSettings->addDefaultTag('customer', PointSettingsTest::CUSTOMER_TAG);

        $defaultTags = $writeApi->pointSettings->getDefaultTags();

        $this->assertEquals(PointSettingsTest::ID_TAG, $defaultTags['id']);
        $this->assertEquals(PointSettingsTest::CUSTOMER_TAG, $defaultTags['customer']);
    }
}
