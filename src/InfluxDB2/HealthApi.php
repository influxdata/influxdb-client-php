<?php

namespace InfluxDB2;

use Exception;
use InfluxDB2\Model\HealthCheck;

class HealthApi extends DefaultApi
{
    /**
     * HealthApi constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
    }

    /**
     * Get the health of an instance.
     *
     * @return HealthCheck
     */
    public function health(): HealthCheck
    {
        try {
            $response = $this->get('', "/health", []);
            return ObjectSerializer::deserialize($response->getBody()->getContents(), '\InfluxDB2\Model\HealthCheck');
        } catch (Exception $e) {
            return new HealthCheck([
                "name" => "influxdb",
                "message" => $e->getMessage(),
                "status" => "fail",
            ]);
        }
    }
}
