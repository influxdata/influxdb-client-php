<?php

namespace InfluxDB2;

use Exception;
use InfluxDB2\Model\HealthCheck;

class HealthApi
{
    /**
     * @var DefaultApi
     */
    public $api;

    /**
     * HealthApi constructor.
     *
     * @param DefaultApi $defaultAPI
     */
    public function __construct(DefaultApi $defaultAPI)
    {
        $this->api = $defaultAPI;
    }

    /**
     * Get the health of an instance.
     *
     * @return HealthCheck
     */
    public function health(): HealthCheck
    {
        try {
            $response = $this->api->get(NULL, "/health", []);
            return ObjectSerializer::deserialize($response, '\InfluxDB2\Model\HealthCheck');
        } catch (Exception $e) {
            return new HealthCheck([
                "name" => "influxdb",
                "message" => $e->getMessage(),
                "status" => "fail",
            ]);
        }
    }
}
