<?php

namespace InfluxDB2\Drivers\Guzzle;

use InfluxDB2\HealthApi;

class GuzzleHealthApi extends HealthApi
{
    use GuzzleApiTrait;

    /**
     * HealthApi constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
    }
}
