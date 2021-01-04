<?php


namespace InfluxDB2;

/**
 * Class FluxRecord is a tuple of values. Each record in the table represents a single point in the series.
 * @see http://bit.ly/flux-spec#record
 * @package InfluxDB2
 */
class FluxRecord
{
    public $table;
    public $values;

    /**
     * FluxRecord constructor.
     * @param $table int table index
     * @param $values array array with record values, key is the column name
     */
    public function __construct($table, $values=null)
    {
        $this->table = $table;
        $this->values = $values;
    }

    public function getStart()
    {
        return $this->values['_start'];
    }

    public function getStop()
    {
        return $this->values['_stop'];
    }

    public function getTime()
    {
        return $this->values['_time'];
    }

    public function getValue()
    {
        return $this->values['_value'];
    }

    public function getField()
    {
        return $this->values['_field'];
    }

    public function getMeasurement():string
    {
        return $this->values['_measurement'];
    }
}
