<?php

namespace spec\InfluxDB2;

use InfluxDB2\ApiClient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use InfluxDB2Generated\Configuration;

class ApiClientSpec extends ObjectBehavior
{
    function it_supports_creation_with_a_configuration()
    {
        $configuration = new Configuration();
        $configuration->setHost("my_host:9999");
        $configuration->setAccessToken("my_access_token");

        $this->beConstructedWith($configuration);

        $this->shouldHaveType(ApiClient::class);
        $this->getConfig()->shouldEqual($configuration);
    }
}
