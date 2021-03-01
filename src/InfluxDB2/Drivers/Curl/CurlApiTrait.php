<?php

namespace InfluxDB2\Drivers\Curl;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use InfluxDB2\ApiException;

trait CurlApiTrait
{
    protected function setUpClient()
    {
        throw new \RuntimeException('Not implemented');
    }

    protected function request($payload, $uriPath, $queryParams, $method, $timeout = self::DEFAULT_TIMEOUT, bool $stream = false): string
    {
        throw new \RuntimeException('Not implemented');
    }
}
