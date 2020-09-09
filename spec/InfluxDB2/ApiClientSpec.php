<?php

namespace spec\InfluxDB2;

use InfluxDB2\Client;
use InfluxDB2\WriteApi;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use InfluxDB2Generated\Configuration;

class ApiClientSpec extends ObjectBehavior
{
    function it_supports_creation_with_a_configuration()
    {
        $configuration = new Configuration();
        $configuration->setHost("my_host:8086");
        $configuration->setAccessToken("my_access_token");

        $this->beConstructedWith($configuration);

        $this->shouldHaveType(Client::class);
        $this->getConfig()->shouldEqual($configuration);
    }

    function it_supports_creation_from_environment()
    {
        $configuration = new Configuration();
        $configuration->setHost("my_host:8086");
        $configuration->setUsername("user");
        $configuration->setPassword("password");

        putenv("INFLUXDB_CLIENT_HOST=my_host:8086");
        putenv("INFLUXDB_CLIENT_USERNAME=user");
        putenv("INFLUXDB_CLIENT_PASSWORD=password");

        $this->beConstructedThrough("createFromEnvironment", []);

        $this->shouldHaveType(Client::class);
        $this->getConfig()->shouldBeLike($configuration);
    }

    function it_supports_creation_with_credentials()
    {
        $configuration = new Configuration();
        $configuration->setHost("my_host:8086");
        $configuration->setUsername("username");
        $configuration->setPassword("password");

        $this->beConstructedThrough("createWithCredentials", ["my_host:8086", "username", "password"]);

        $this->shouldHaveType(Client::class);
        $this->getConfig()->shouldBeLike($configuration);
    }

    function it_creates_a_write_client()
    {
        $configuration = new Configuration();
        $configuration->setHost("my_host:8086");
        $configuration->setAccessToken("my_access_token");

        $this->beConstructedWith($configuration);

        $this->getWriteClient()->shouldHaveType(WriteApi::class);
        $this->getWriteClient()->getConfig()->shouldBeLike($configuration);
    }
}
