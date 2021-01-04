<?php


namespace InfluxDB2;

class WritePayloadSerializer
{
    /**
     * Generate payload from provided data.
     *
     * @param $data string|Point|array to generate payload
     * @param string|null $precision the precision used as a key for Batch
     * @param string|null $bucket the bucket used as a key for Batch
     * @param string|null $org the org used as a key for Batch
     * @param int|null $writeType specify type of writes - WriteType::SYNCHRONOUS or WriteType::BATCHING
     * @return BatchItem|string|null
     */
    public static function generatePayload($data, string $precision = null, string $bucket = null, string $org = null, int $writeType = null)
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
}
