<?php

namespace InfluxDB2Test;

use DateTime;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use InfluxDB2\QueryApi;
use InfluxDB2\WriteApi;
use PHPUnit\Framework\TestCase;

/**
 * @group integration
 */
class QueryApiIntegrationTest extends TestCase
{
    private Client $client;
    private WriteApi $writeApi;
    private QueryApi $queryApi;

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

    public function testQueryRaw(): void
    {
        $now = new DateTime();
        $measurement = 'h2o_query_' . $now->getTimestamp();

        $query = $this->prepareData($measurement, $now);
        print $query;

        $result = $this->queryApi->queryRaw($query);

        self::assertIsString($result);
        self::assertStringContainsString(',result,table,_start,_stop,_time,_value,_field,_measurement,location', $result);
        self::assertStringContainsString($measurement, $result);
    }

    public function testQuery(): void
    {
        $now = new DateTime();
        $measurement = 'h2o_query_' . $now->getTimestamp();
        $query = $this->prepareData($measurement, $now);
        print $query;

        $result = $this->queryApi->query($query);

        self::assertNotNull($result);
        self::assertEquals(1, sizeof($result));
        $records = $result[0]->records;
        self::assertEquals(1, sizeof($records));
        $record = $records[0];
        self::assertEquals($measurement, $record->getMeasurement());
        self::assertEquals('europe', $record->values['location']);
        self::assertEquals(2, $record->getValue());
        self::assertEquals(0, $record->table);
        self::assertEquals(0, $record->values['table']);
        self::assertEquals('level', $record->getField());
    }

    public function testWriteQueryNewLine(): void
    {
        $measurement = 'h2o_QueryNewLine_' . (new DateTime())->getTimestamp();

        $this->writeApi->write(Point::measurement($measurement)
            ->addTag('location', 'europe')
            ->addField('value', "some \n value"));

        $result = $this->queryApi->query('from(bucket: "my-bucket") |> range(start: 0)
            |> filter(fn: (r) => r._measurement == "' . $measurement . '")');

        self::assertNotNull($result);
        self::assertEquals(1, sizeof($result));
        $records = $result[0]->records;
        self::assertEquals(1, sizeof($records));
        $record = $records[0];

        self::assertEquals("some \r\n value", $record->getValue());
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
