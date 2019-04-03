<?php

namespace InfluxDB2;

use InfluxDB2Generated\ApiClient\DefaultApi;
use InfluxDB2Generated\Configuration;

class ApiClient extends DefaultApi
{
    public function __construct(Configuration $configuration)
    {
        parent::__construct(new \GuzzleHttp\Client(), $configuration);
    }

    public static function createFromEnvironment()
    {
        $configuration = new Configuration();

        $configuration->setHost(getenv("INFLUXDB_CLIENT_HOST", "localhost"));

        if (array_key_exists("INFLUXDB_CLIENT_USERNAME", $_ENV)) {
            $configuration->setUsername(getenv("INFLUXDB_CLIENT_USERNAME"));
            $configuration->setPassword(getenv("INFLUXDB_CLIENT_PASSWORD"));

            return new Self($configuration);
        }

        if (array_key_exists("INFLUXDB_CLIENT_ACCESS_TOKEN", $_ENV)) {
            $configuration->setAccessToken(getenv("INFLUXDB_CLIENT_ACCESS_TOKEN"));

            return new Self($configuration);
        }

        throw new Exception("Not Enough Configuration");
    }

    public static function createWithCredentials(string $host, string $username, string $password)
    {
        $configuration = new Configuration();

        $configuration->setHost($host);
        $configuration->setUsername($username);
        $configuration->setPassword($password);

        return new Self($configuration);
    }
}
