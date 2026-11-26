<?php


namespace InfluxDB2;

use InfluxDB2\Model\WritePrecision;

class WritePayloadSerializer
{
    /**
     * Generate payload from provided data.
     *
     * @param $data string|Point|array to generate payload
     * @param WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null $precision the precision used as a key for Batch
     * @param string|null $bucket the bucket used as a key for Batch
     * @param string|null $org the org used as a key for Batch
     * @param int|null $writeType specify type of writes - WriteType::SYNCHRONOUS or WriteType::BATCHING
     * @return BatchItem|string|null
     */
    public static function generatePayload($data, ?string $precision = null, ?string $bucket = null, ?string $org = null, ?int $writeType = null)
    {
        if ($data == null || empty($data)) {
            return null;
        }
        if (is_string($data)) {
            if (WriteType::BATCHING == $writeType) {
                return new BatchItem(new BatchItemKey($bucket, $org, $precision), $data);
            } else {
                return $data;
            }
        }
        if ($data instanceof Point) {
            return self::generatePayload($data->toLineProtocol(), $data->getPrecision() !== null ?
                $data->getPrecision() : $precision, $bucket, $org, $writeType);
        }
        if (is_array($data)) {
            if (array_key_exists('name', $data)) {
                return self::generatePayload(Point::fromArray($data), $precision, $bucket, $org, $writeType);
            }

            $payload = '';

            foreach ($data as $item) {
                if (isset($item)) {
                    $payload .= self::generatePayload($item, $precision, $bucket, $org, $writeType) . "\n";
                }
            }

            // remove last new line
            if (isset($payload) && trim($payload) !== '') {
                $payload = rtrim($payload, "\n");
            }

            return $payload;
        }

        return null;
    }

    /**
     * Converts provided data into the list of line protocol records with the key of their destination.
     *
     * The precision of a Point with a timestamp takes precedence over the $precision argument,
     * the timestamp of a Point without precision is serialized in the $precision.
     *
     * @param string|Point|array<mixed>|null $data the data to convert
     * @param WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS $precision the default precision
     * @param string $bucket the destination bucket
     * @param string $org the destination organization
     * @return BatchItem[] the records in the original order
     */
    public static function generateBatchItems($data, string $precision, string $bucket, string $org): array
    {
        if ($data === null || $data === '' || $data === []) {
            return [];
        }
        if (is_string($data)) {
            return [new BatchItem(new BatchItemKey($bucket, $org, $precision), $data)];
        }
        if ($data instanceof Point) {
            $pointPrecision = $precision;
            if ($data->getTime() !== null) {
                if ($data->getPrecision() === null) {
                    // the time of the point is serialized in the precision of the write
                    $data = (clone $data)->time($data->getTime(), $precision);
                } else {
                    $pointPrecision = $data->getPrecision();
                }
            }
            $lineProtocol = $data->toLineProtocol();
            if ($lineProtocol === null) {
                return [];
            }
            return [new BatchItem(new BatchItemKey($bucket, $org, $pointPrecision), $lineProtocol)];
        }
        if (is_array($data)) {
            if (array_key_exists('name', $data)) {
                $point = Point::fromArray($data);
                return $point === null ? [] : self::generateBatchItems($point, $precision, $bucket, $org);
            }

            $items = [];
            foreach ($data as $item) {
                foreach (self::generateBatchItems($item, $precision, $bucket, $org) as $batchItem) {
                    $items[] = $batchItem;
                }
            }
            return $items;
        }

        return [];
    }
}
