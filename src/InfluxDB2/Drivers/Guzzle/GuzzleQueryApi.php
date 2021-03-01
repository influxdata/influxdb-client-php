<?php

namespace InfluxDB2\Drivers\Guzzle;

use InfluxDB2\QueryApi;

class GuzzleQueryApi extends QueryApi
{
    use GuzzleApiTrait;

    /**
     * QueryApi constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
    }
}
