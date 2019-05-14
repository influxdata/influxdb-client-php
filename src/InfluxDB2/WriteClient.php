<?php

namespace InfluxDB2;

use InfluxDB2Generated\ApiClient\DefaultApi;
use InfluxDB2Generated\Configuration;

class WriteClient  extends DefaultApi
{
    public function getClient()
    {
        return $this->client;
    }
}
