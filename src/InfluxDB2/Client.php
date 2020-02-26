<?php

namespace InfluxDB2;

class Client
{
    public $options;

    /**
     * Client constructor.
     *
     *      client = new Client([
     *          "url" => "http://localhost:9999",
     *          "token" => "my-token",
     *          "bucket" => "my-bucket",
     *          "precision" => WritePrecision::NS,
     *          "org" => "my-org",
     *          "debug" => false
     *          ]);
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * Write time series data into InfluxDB thought WriteApi.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *          'flushInterval' => flush data at least in this interval
     *      ]
     * @param array|null $writeOptions Array containing the write parameters (See above)
     * @return WriteApi
     */
    public function createWriteApi(array $writeOptions = null): WriteApi
    {
        return new WriteApi($this->options, $writeOptions);
    }

    /**
     * Get the Query client.
     *
     * @return QueryApi
     */
    public function createQueryApi(): QueryApi
    {
        return new QueryApi($this->options);
    }

    /**
     * Close all connections into InfluxDB
     */
    public function close()
    {

    }
}
