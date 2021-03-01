<?php

namespace InfluxDB2\Drivers\Curl;

use InfluxDB2\QueryApi;

class CurlQueryApi extends QueryApi
{
    use CurlApiTrait;

    /**
     * QueryApi constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
    }
}
