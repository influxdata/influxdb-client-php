<?php

namespace InfluxDB2Test;

use InfluxDB2\BatchItem;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use InfluxDB2\WritePayloadSerializer;
use PHPUnit\Framework\TestCase;

class WritePayloadSerializerTest extends TestCase
{
    /**
     * @return array<string, array{mixed}>
     */
    public function providerEmptyData(): array
    {
        return [
            'null' => [null],
            'empty string' => [''],
            'empty array' => [[]],
            'point without fields' => [Point::measurement('h2o')],
            'array of points without fields' => [[Point::measurement('h2o'), Point::measurement('h2o')]],
        ];
    }

    /**
     * @dataProvider providerEmptyData
     * @param mixed $data
     */
    public function testEmptyData($data): void
    {
        self::assertSame([], WritePayloadSerializer::generateBatchItems($data, WritePrecision::NS, 'my-bucket', 'my-org'));
    }

    public function testString(): void
    {
        $items = WritePayloadSerializer::generateBatchItems("h2o level=1i 1\nh2o level=2i 2", WritePrecision::S, 'my-bucket', 'my-org');

        self::assertSame([["h2o level=1i 1\nh2o level=2i 2", 's', 'my-bucket', 'my-org']], self::toArray($items));
    }

    public function testPointPrecision(): void
    {
        $items = WritePayloadSerializer::generateBatchItems([
            Point::measurement('h2o')->addField('level', 1)->time(1, WritePrecision::MS),
            Point::measurement('h2o')->addField('level', 2)->time(2),
            Point::measurement('h2o')->addField('level', 3),
            new Point('h2o', null, ['level' => 4]),
        ], WritePrecision::S, 'my-bucket', 'my-org');

        self::assertSame([
            // precision of point with time overrides default precision
            ['h2o level=1i 1', 'ms', 'my-bucket', 'my-org'],
            // time without precision => default precision
            ['h2o level=2i 2', 's', 'my-bucket', 'my-org'],
            // no time => precision is not relevant, default precision
            ['h2o level=3i', 's', 'my-bucket', 'my-org'],
            ['h2o level=4i', 's', 'my-bucket', 'my-org'],
        ], self::toArray($items));
    }

    public function testPointWithoutPrecisionUsesWritePrecision(): void
    {
        $time = new \DateTime('2021-01-02T03:04:05.678901Z');
        $point = Point::measurement('h2o')->addField('level', 1)->time($time);

        $items = WritePayloadSerializer::generateBatchItems([
            $point,
            new Point('h2o', null, ['level' => 2], 1609556645),
            new Point('h2o', null, ['level' => 3], $time),
        ], WritePrecision::MS, 'my-bucket', 'my-org');

        self::assertSame([
            ['h2o level=1i 1609556645678', 'ms', 'my-bucket', 'my-org'],
            ['h2o level=2i 1609556645', 'ms', 'my-bucket', 'my-org'],
            ['h2o level=3i 1609556645678', 'ms', 'my-bucket', 'my-org'],
        ], self::toArray($items));
        // the point is not modified
        self::assertNull($point->getPrecision());
        self::assertSame('h2o level=1i 1609556645678901000', $point->toLineProtocol());
    }

    public function testArrays(): void
    {
        $items = WritePayloadSerializer::generateBatchItems([
            ['name' => 'h2o', 'fields' => ['level' => 1], 'time' => 1],
            ['name' => 'h2o', 'fields' => ['level' => 2], 'time' => 2, 'precision' => WritePrecision::US],
            [
                'h2o level=3i 3',
                [Point::measurement('h2o')->addField('level', 4)->time(4)],
            ],
        ], WritePrecision::S, 'my-bucket', 'my-org');

        self::assertSame([
            ['h2o level=1i 1', 's', 'my-bucket', 'my-org'],
            ['h2o level=2i 2', 'us', 'my-bucket', 'my-org'],
            ['h2o level=3i 3', 's', 'my-bucket', 'my-org'],
            ['h2o level=4i 4', 's', 'my-bucket', 'my-org'],
        ], self::toArray($items));
    }

    /**
     * @param BatchItem[] $items
     * @return array<int, array{string, string|null, string, string}>
     */
    private static function toArray(array $items): array
    {
        return array_map(function (BatchItem $item) {
            return [$item->data, $item->key->precision, $item->key->bucket, $item->key->org];
        }, $items);
    }
}
