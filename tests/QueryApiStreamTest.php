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
class QueryApiStreamTest extends TestCase
{
    /** @var Client */
    private $client;
    /** @var WriteApi */
    private $writeApi;
    /** @var QueryApi */
    private $queryApi;
    /** @var DateTime */
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

    public function testQueryStream(): void
    {
        $measurement = 'h2o_query_stream' . $this->now->format('Y-m-d-H-i-s');
        $this->write(10, $measurement);

        $query = 'from(bucket: "my-bucket") |> range(start: -1m, stop: now()) '
            . '|> filter(fn: (r) => r._measurement == "' . $measurement . '")';

        $count = 0;

        $parser = $this->queryApi->queryStream($query);

        foreach ($parser->each() as $record) {
            self::assertNotNull($record);

            self::assertEquals($measurement, $record->getMeasurement());
            self::assertEquals('europe', $record->values['location']);
            self::assertEquals($count, $record->getValue());
            self::assertEquals('level', $record->getField());

            $count++;
        }

        self::assertEquals(10, $count);
    }

    public function testQueryStreamBreak(): void
    {
        $measurement = 'h2o_query_stream_break' . $this->now->format('Y-m-d-H-i-s');
        $this->write(20, $measurement);

        $query = 'from(bucket: "my-bucket") |> range(start: -1m, stop: now()) '
            . '|> filter(fn: (r) => r._measurement == "' . $measurement . '")';

        $count = 0;

        $parser = $this->queryApi->queryStream($query);

        $records = [];

        self::assertFalse($parser->closed);

        foreach ($parser->each() as $record) {
            if ($count >= 5) {
                break;
            }

            $records[] = $record;

            $count++;
        }

        self::assertCount(5, $records);
        self::assertTrue($parser->closed);
    }

    public function testQueryEmptyData(): void
    {
        $result = $this->queryApi->queryStream(null);

        self::assertNull($result);
    }

    private function write(int $values, string $measurement): void
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
