<?php

namespace InfluxDB2\Drivers\Curl;

use InfluxDB2\HealthApi;

class CurlHealthApi extends HealthApi
{
    use CurlApiTrait;

    /**
     * HealthApi constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
    }
}
