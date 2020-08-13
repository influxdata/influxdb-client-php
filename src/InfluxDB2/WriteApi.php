<?php

namespace InfluxDB2;


use InfluxDB2\Model\WritePrecision;

/**
 * Write time series data into InfluxDB.
 * @package InfluxDB2
 */
class WriteApi extends DefaultApi
{
    public $writeOptions;

    /** @var Worker */
    private $worker;
    public $closed = false;

    /**
     * WriteApi constructor.
     * @param $options
     * @param $writeOptions
     */
    public function __construct($options,array $writeOptions = null)
    {
        parent::__construct($options);
        $this->writeOptions = new WriteOptions($writeOptions) ?: new WriteOptions();
    }

    /**
     * Write data into specified bucket
     *
     * Example write data in array
     *      $writeApi->write([
     *          ['name' => 'cpu','tags' => ['host' => 'server_nl', 'region' => 'us'],
     *              'fields' => ['internal' => 5, 'external' => 6],
     *              'time' => 1422568543702900257],
     *          ['name' => 'gpu', 'fields' => ['value' => 0.9999]]],
     *      WritePrecision::NS,
     *      'my-bucket',
     *      'my-org'
     *      )
     *
     * Example write data in line protocol
     *      $writeApi->write('h2o,location=west value=33i 15')
     *
     * Example write data using Point structure
     *      $point = new Point("h2o).
     *
     *
     * @param string|Point|array $data DataPoints to write into InfluxDB. The data could be represent by
     * array, Point, string
     * @param string|null $precision The precision for the unix timestamps within the body line-protocol @see \InfluxDB2\Model\WritePrecision
     * @param string|null $bucket specifies the destination bucket for writes
     * @param string|null $org specifies the destination organization for writes
     * @throws ApiException
     */
    public function write($data, string $precision = null, string $bucket = null, string $org = null)
    {
        $precisionParam = $this->getOption("precision", $precision);
        $bucketParam = $this->getOption("bucket", $bucket);
        $orgParam = $this->getOption("org", $org);

        $this->check("precision", $precisionParam);
        $this->check("bucket", $bucketParam);
        $this->check("org", $orgParam);

        $payload = $this->generatePayload($data, $precisionParam, $bucketParam, $orgParam);

        if ($payload == null) {
            return;
        }

        if (WriteType::BATCHING == $this->writeOptions->writeType)
        {
            $this->worker()->push($payload);
        } else {
            $this->writeRaw($payload, $precisionParam, $bucketParam, $orgParam);
        }
    }

    /**
     * Writes data using line protocol.
     *
     * @param string $data payload data as string (in line protocol format)
     * @param string|null $precision The precision for the unix timestamps within the body line-protocol
     * @param string|null $bucket specifies the destination bucket for writes
     * @param string|null $org specifies the destination organization for writes
     * @throws ApiException
     *
     * @see \InfluxDB2\Model\WritePrecision
     */
    public function writeRaw(string $data, string $precision = null, string $bucket = null, string $org = null)
    {
        $precisionParam = $this->getOption("precision", $precision);
        $bucketParam = $this->getOption("bucket", $bucket);
        $orgParam = $this->getOption("org", $org);

        $this->check("precision", $precisionParam);
        $this->check("bucket", $bucketParam);
        $this->check("org", $orgParam);

        $queryParams = ["org" => $orgParam, "bucket" => $bucketParam, "precision" => $precisionParam];

        $this->writeRawInternal($data, $queryParams, 1, $this->writeOptions->retryInterval);
    }

    private function writeRawInternal(string $data, array $queryParams, int $attempts, int $retryInterval)
    {
        try {
            $this->post($data, "/api/v2/write", $queryParams);
        } catch (ApiException $e) {
            $code = $e->getCode();

            if ($code == null || ($code < 429) || $attempts > $this->writeOptions->maxRetries) {
                throw $e;
            }

            $headers = $e->getResponseHeaders();

            if (array_key_exists('Retry-After', $headers)) {
                $timeout = (int)$headers['Retry-After'][0] * 1000000.0;
            } else {
                $timeout = min($retryInterval, $this->writeOptions->maxRetryDelay) * 1000.0;
            }

            usleep($timeout);

            $this->writeRawInternal($data, $queryParams, $attempts + 1,
                $retryInterval * $this->writeOptions->exponentialBase);
        }
    }

    public function close()
    {
        $this->closed = true;

        $this->worker()->flush();
    }

    private function worker(): Worker
    {
        if (!isset($this->worker))
        {
            $this->worker = new Worker($this);
        }

        return $this->worker;
    }

    private function generatePayload($data, string $precision = null, string $bucket = null, string $org = null)
    {
        if ($data == null || empty($data)) {
            return null;
        }
        if (is_string($data)) {

            if (WriteType::BATCHING == $this->writeOptions->writeType) {
                return new BatchItem(new BatchItemKey($bucket, $org, $precision), $data);
            } else {
                return $data;
            }
        }
        if ($data instanceof Point) {
            return $this->generatePayload($data->toLineProtocol(), $data->getPrecision() !== null ?
                $data->getPrecision() : $precision, $bucket, $org);
        }
        if (is_array($data))
        {
            if (array_key_exists('name', $data))
            {
                return $this->generatePayload(Point::fromArray($data), $precision, $bucket, $org);
            }

            $payload = '';

            foreach ($data as $item)
            {
                if (isset($item)) {
                    $payload .= $this->generatePayload($item, $precision, $bucket, $org) . "\n";
                }
            }

            // remove last new line
            if (isset($payload) && trim($payload) !== '')
            {
                $payload = rtrim($payload, "\n");
            }

            return $payload;
        }

        return null;
    }

    private function getOption(string $optionName, string $precision = null): string
    {
        return isset($precision) ? $precision : $this->options["$optionName"];
    }
}

/**
 * Item for batching queue
 */
class BatchItem
{
    /** @var BatchItemKey */
    public $key;
    /** @var string */
    public $data;

    public function __construct($key, $data)
    {
        $this->key = $key;
        $this->data = $data;
    }
}

/**
 * Key for batch item
 */
class BatchItemKey
{
    /** @var string */
    public $bucket;
    /** @var string */
    public $org;
    /** @var WritePrecision */
    public $precision;

    public function __construct($bucket, $org, $precision)
    {
        $this->bucket = $bucket;
        $this->org = $org;
        $this->precision = $precision;
    }
}
