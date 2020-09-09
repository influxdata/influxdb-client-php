<?php

namespace spec\InfluxDB2;

use InfluxDB2\WriteApi;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use InfluxDB2Generated\Configuration;

class WriteClientSpec extends ObjectBehavior
{
    function it_supports_creation_with_a_client_and_config()
    {
        $client = new \GuzzleHttp\Client();

        $configuration = new Configuration();
        $configuration->setHost("my_host:8086");
        $configuration->setAccessToken("my_access_token");

        $this->beConstructedWith($client, $configuration);

        $this->shouldHaveType(WriteApi::class);
        $this->getClient()->shouldEqual($client);
        $this->getConfig()->shouldEqual($configuration);
    }

    function it_can_write_a_single_point()
    {
        // ???
    }
}
