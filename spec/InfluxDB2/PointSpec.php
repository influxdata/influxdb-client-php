<?php

namespace spec\InfluxDB2;

use InfluxDB2\Point;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PointSpec extends ObjectBehavior
{
    function it_can_be_constructed_with_tags_and_fields()
    {
        $measurement = "measurement";

        $tags = [
            "language" => "php",
        ];

        $fields = [
            "_value" => 1,
        ];

        $this->beConstructedWith($measurement, $tags, $fields);

        $this->shouldHaveType(Point::class);

        $this->getTags()->shouldEqual($tags);

        $this->getTag("language")->shouldEqual("php");
        $this->getTag("unknown")->shouldEqual(null);

        $this->getFields()->shouldEqual($fields);
        $this->getField("_value")->shouldEqual(1);
        $this->getField("unknown")->shouldEqual(null);
    }

    function it_can_produce_line_protocol_with_no_time()
    {
        $measurement = "measurement";

        $tags = [
            "language" => "php",
        ];

        $fields = [
            "_value" => 1,
        ];

        $this->beConstructedWith($measurement, $tags, $fields);

        $this->lineProtocol()->shouldEqual("measurement,language=php _value=1");
    }

    function it_can_produce_line_protocol_with_time()
    {
        $measurement = "measurement";

        $tags = [
            "language" => "php",
        ];

        $fields = [
            "_value" => 1,
        ];

        list($usec, $sec) = explode(' ', microtime());
        $timestamp = sprintf('%d%06d', $sec, $usec*1000000);

        $this->beConstructedWith($measurement, $tags, $fields, $timestamp);

        $this->lineProtocol()->shouldEqual("measurement,language=php _value=1 ${timestamp}");
    }
}
