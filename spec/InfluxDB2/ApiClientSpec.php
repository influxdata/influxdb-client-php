<?php

namespace spec\InfluxDB2;

use InfluxDB2\ApiClient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApiClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ApiClient::class);
    }
}
