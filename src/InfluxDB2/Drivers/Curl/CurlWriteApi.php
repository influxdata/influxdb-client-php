<?php

namespace InfluxDB2\Drivers\Curl;

use InfluxDB2\WriteApi;

/**
 * Write time series data into InfluxDB.
 * @package InfluxDB2
 */
class CurlWriteApi extends WriteApi
{
    use CurlApiTrait;

    /**
     * WriteApi constructor.
     * @param $options
     * @param array $writeOptions
     * @param array|null $pointSettings
     */
    public function __construct($options, array $writeOptions = null, array $pointSettings = null)
    {
        parent::__construct($options, $writeOptions, $pointSettings);
    }
}
