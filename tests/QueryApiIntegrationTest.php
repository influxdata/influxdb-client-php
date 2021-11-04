<?php

namespace InfluxDB2Test;

use DateTime;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use PHPUnit\Framework\TestCase;

/**
 * @group integration
 */
class QueryApiIntegrationTest extends TestCase
{
    private $client;
    private $writeApi;
    private $queryApi;

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

        $query = $this->prepareData($measurement, $now);
        print $query;

        $result = $this->queryApi->queryRaw($query);

        $this->assertStringContainsString(',result,table,_start,_stop,_time,_value,_field,_measurement,location', $result);
        $this->assertStringContainsString($measurement, $result);
    }

    public function testQuery()
    {
        $now = new DateTime();
        $measurement = 'h2o_query_' . $now->getTimestamp();
        $query = $this->prepareData($measurement, $now);
        print $query;

        $result = $this->queryApi->query($query);

        $this->assertNotNull($result);
        $this->assertEquals(1, sizeof($result));
        $records = $result[0]->records;
        $this->assertEquals(1, sizeof($records));
        $record = $records[0];
        $this->assertEquals($measurement, $record->getMeasurement());
        $this->assertEquals('europe', $record->values['location']);
        $this->assertEquals(2, $record->getValue());
        $this->assertEquals(0, $record->table);
        $this->assertEquals(0, $record->values['table']);
        $this->assertEquals('level', $record->getField());
    }

    public function testWriteQueryNewLine()
    {
        $measurement = 'h2o_QueryNewLine_' . (new DateTime())->getTimestamp();

        $this->writeApi->write(Point::measurement($measurement)
            ->addTag('location', 'europe')
            ->addField('value', "some \n value"));

        $result = $this->queryApi->query('from(bucket: "my-bucket") |> range(start: 0)
            |> filter(fn: (r) => r._measurement == "' . $measurement . '")');

        $this->assertNotNull($result);
        $this->assertEquals(1, sizeof($result));
        $records = $result[0]->records;
        $this->assertEquals(1, sizeof($records));
        $record = $records[0];

        $this->assertEquals("some \r\n value", $record->getValue());
    }

    /**
     * @param string $measurement
     * @param DateTime $now
     * @return string
     */
    public function prepareData(string $measurement, DateTime $now): string
    {
        $this->writeApi->write(Point::measurement($measurement)
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time($now, WritePrecision::US));

        $query = 'from(bucket: "my-bucket") |> range(start: 0)
            |> filter(fn: (r) => r._measurement == "' . $measurement . '")';
        return $query;
    }
}
