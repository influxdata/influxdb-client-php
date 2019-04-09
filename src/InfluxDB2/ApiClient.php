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

        $influxdbHost = getenv("INFLUXDB_CLIENT_HOST") ?: "localhost:9999";
        $configuration->setHost($influxdbHost);

        $influxdbUsername = getenv("INFLUXDB_CLIENT_USERNAME") ?: null;
        $influxdbPassword = getenv("INFLUXDB_CLIENT_PASSWORD") ?: null;

        if ($influxdbUsername && $influxdbPassword) {
            $configuration->setUsername($influxdbUsername);
            $configuration->setPassword($influxdbPassword);

            return new Self($configuration);
        }

        $influxdbAccessToken = getenv("INFLUXDB_CLIENT_ACCESS_TOKEN") ?: null;
        if ($influxdbAccessToken) {
            $configuration->setAccessToken($influxdbAccessToken);

            return new Self($configuration);
        }

        throw new \Exception("Not Enough Configuration");
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
