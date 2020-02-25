<?php

namespace InfluxDB2;

class WriteType
{
    const SYNCHRONOUS = 1;
    const BATCHING = 2;
}

class WriteOptions
{
    var $writeType;
    var $batchSize;
    var $flushInterval;

    /**
     * WriteOptions constructor.
     * @param int $writeType
     * @param $batchSize
     * @param $flushInterval
     */
    public function __construct(int $writeType = WriteType::SYNCHRONOUS,
                                $batchSize = 1000, $flushInterval = 1000)
    {
        $this->writeType = $writeType;
        $this->batchSize = $batchSize;
        $this->flushInterval = $flushInterval;
    }
}

class WriteApi extends DefaultApi
{
    var $options;
    var $writeOptions;

    /**
     * WriteApi constructor.
     * @param $options
     * @param $writeOptions
     */
    public function __construct($options,WriteOptions $writeOptions = null)
    {
        parent::__construct($options);
        $this->writeOptions = $writeOptions ?: new WriteOptions(WriteType::SYNCHRONOUS);
    }

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

    private function generatePayload($data, string $precision = null, string $bucket = null, string $org = null): string
    {
        if ($data == null || empty($data)) {
            return null;
        }
        if (is_string($data)) {

            if (WriteType::BATCHING == $this->writeOptions->writeType) {
                print ("TODO implement batching");
            } else {
                return $data;
            }
        }
        if ($data instanceof Point) {
            return $this->generatePayload($data->toLineProtocol(), $data->getPrecision() !== null ?
                $data->getPrecision() : $precision, $bucket, $org);
        }
        if (is_array($data)) {
            return $this->generatePayload(Point::fromArray($data), $precision, $bucket, $org);
        }
        return null;
    }

    /**
     * @param string $precision
     * @param string $optionName
     * @return string
     */
    private function getOption(string $optionName, string $precision = null): string
    {
        return isset($precision) ? $precision : $this->options["$optionName"];
    }


}
