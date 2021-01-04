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
class QueryApiStreamTest extends TestCase
{
    private $client;
    private $writeApi;
    private $queryApi;
    private $now;

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

        $this->now = new DateTime();
    }

    public function testQueryStream()
    {
        $measurement = 'h2o_query_stream' . $this->now->format('Y-m-d-H-i-s');
        $this->write(10, $measurement);

        $query = 'from(bucket: "my-bucket") |> range(start: -1m, stop: now()) '
            . '|> filter(fn: (r) => r._measurement == "' . $measurement . '")';

        $count = 0;

        $parser = $this->queryApi->queryStream($query);

        foreach ($parser->each() as $record) {
            $this->assertNotNull($record);

            $this->assertEquals($measurement, $record->getMeasurement());
            $this->assertEquals('europe', $record->values['location']);
            $this->assertEquals($count, $record->getValue());
            $this->assertEquals('level', $record->getField());

            $count++;
        }

        $this->assertEquals(10, $count);
    }

    public function testQueryStreamBreak()
    {
        $measurement = 'h2o_query_stream_break' . $this->now->format('Y-m-d-H-i-s');
        $this->write(20, $measurement);

        $query = 'from(bucket: "my-bucket") |> range(start: -1m, stop: now()) '
            . '|> filter(fn: (r) => r._measurement == "' . $measurement . '")';

        $count = 0;

        $parser = $this->queryApi->queryStream($query);

        $records = [];

        $this->assertFalse($parser->closed);

        foreach ($parser->each() as $record) {
            if ($count >= 5) {
                break;
            }

            $records[] = $record;

            $count++;
        }

        $this->assertEquals(5, count($records));
        $this->assertTrue($parser->closed);
    }

    public function testQueryEmptyData()
    {
        $result = $this->queryApi->queryStream(null);

        $this->assertNull($result);
    }

    private function write($values, $measurement)
    {
        for ($ii = 0; $ii < $values; $ii++) {
            $this->writeApi->write(
                Point::measurement($measurement)
                ->addTag('location', 'europe')
                ->addField('level', $ii)
                ->time($this->now->getTimestamp() - $values + $ii, WritePrecision::S),
                WritePrecision::S
            );
        }
    }
}
