<?php

namespace InfluxDB2;

class WriteType
{
    const SYNCHRONOUS = 1;
    const BATCHING = 2;
}

class WriteOptions
{
    const DEFAULT_BATCH_SIZE = 10;
    const DEFAULT_FLUSH_INTERVAL = 1000;

    public $writeType;
    public $batchSize;
    public $flushInterval;

    /**
     * WriteOptions constructor.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *          'flushInterval' => flush data at least in this interval
     *      ]
     * @param array $writeOptions Array containing the write parameters (See above)
     */
    public function __construct(array $writeOptions = null)
    {
        //initialize with default values
        $this->writeType =  $writeOptions["writeType"] ?: WriteType::SYNCHRONOUS;
        $this->batchSize = $writeOptions["batchSize"] ?:  self::DEFAULT_BATCH_SIZE;
        $this->flushInterval = $writeOptions["flushInterval"] ?:  self::DEFAULT_FLUSH_INTERVAL;
    }
}

/**
 * Write time series data into InfluxDB.
 * @package InfluxDB2
 */
class WriteApi extends DefaultApi
{
    public $writeOptions;

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

        $payload = $this->generatePayload($data, $bucketParam, $orgParam, $precisionParam);

        if ($payload == null) {
            return;
        }

        if (WriteType::BATCHING == $this->writeOptions->writeType) {
            print ("TODO Not implemented yet");
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

        $this->post($data, "/api/v2/write", $queryParams);

    }

    private function generatePayload($data, string $precision = null, string $bucket = null, string $org = null): ?string
    {
        if ($data == null || empty($data)) {
            return null;
        }
        if (is_string($data)) {

            if (WriteType::BATCHING == $this->writeOptions->writeType) {
                print ("TODO implement batching");
                return $data;
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
                $payload .= $this->generatePayload($item, $precision, $bucket, $org) . "\n";
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
