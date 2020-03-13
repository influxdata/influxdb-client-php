<?php

namespace InfluxDB2;

class Client
{
    /**
     * Client version updated by: 'make release VERSION=1.5.0'
     */
    const VERSION = '1.1.0';

    public $options;
    public $closed = false;
    private $autoCloseable = array();

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
        $writeApi = new WriteApi($this->options, $writeOptions);
        $this->autoCloseable[] = $writeApi;
        return $writeApi;
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
        $this->closed = true;

        foreach ($this->autoCloseable as $ac)
        {
            $ac->close();
        }
    }
}
