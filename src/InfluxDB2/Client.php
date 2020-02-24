<?php

namespace InfluxDB2;


use InfluxDB2\Model\WritePrecision;

class Client
{
    var $options;

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

    public function createWriteApi(WriteOptions $writeOptions = null):WriteApi
    {
        return new WriteApi($this->options, $writeOptions);
    }

    /**
     * Close ll connections into InfluxDB
     */
    public function close()
    {

    }
}
