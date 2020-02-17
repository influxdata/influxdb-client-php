<?php

namespace InfluxDB2Generated;

use InfluxDB2\ApiClient;
use PHPUnit\Framework\TestCase;

class InfluxDBTest extends TestCase
{
    public function testDummy()
    {
        $this->assertTrue(true);
    }

    public function testApiClient()
    {
        $apiClient = ApiClient::createWithCredentials("localhost:9999", "my-org", "my-password");
        $this->assertNotNull($apiClient);
    }
}
