<?php


namespace InfluxDB2;

class FluxCsvParserException extends \RuntimeException
{
    /**
     * FluxCsvParserException constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
