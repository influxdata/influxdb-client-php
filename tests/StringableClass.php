<?php

namespace InfluxDB2Test;

class StringableClass
{
    public function __toString(): string
    {
        return "stringable";
    }
}
