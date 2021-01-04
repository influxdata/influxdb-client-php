<?php

namespace InfluxDB2;

/**
 * Class FluxColumn represents a column header specification of FluxTable.
 * @package InfluxDB2
 */
class FluxColumn
{
    public $index;
    public $label;
    public $dataType;
    public $group;
    public $defaultValue;

    /**
     * FluxColumn constructor.
     * @param $index int column number
     * @param $label string column label
     * @param $dataType string data type
     * @param $group bool is group column
     * @param $defaultValue string default empty value
     */
    public function __construct($index = null, $label = null, $dataType = null, $group = null, $defaultValue = null)
    {
        $this->index = $index;
        $this->label = $label;
        $this->dataType = $dataType;
        $this->group = $group;
        $this->defaultValue = $defaultValue;
    }
}
