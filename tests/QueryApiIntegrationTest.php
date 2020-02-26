<?php

namespace InfluxDB2Test;

use DateTime;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use PHPUnit\Framework\TestCase;

class QueryApiIntegrationTest extends TestCase
{
    private $client;
    private $writeApi;
    private $queryApi;

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
        $this->queryApi = $this->client->createQueryApi();
    }

    public function testExistsApi()
    {
        $this->assertNotNull($this->writeApi);
        $this->assertNotNull($this->queryApi);
    }

    public function testQueryRaw()
    {
        $now = new DateTime();
        $measurement = 'h2o_query_' . $now->getTimestamp();

        $this->writeApi->write(Point::measurement($measurement)
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time($now, WritePrecision::US));

        $query = 'from(bucket: "my-bucket") |> range(start: 0)
            |> filter(fn: (r) => r._measurement == "'.$measurement.'")';

        print $query;

        $result = $this->queryApi->queryRaw($query);

        $this->assertContains(',result,table,_start,_stop,_time,_value,_field,_measurement,location', $result);
        $this->assertContains($measurement, $result);
    }

}
