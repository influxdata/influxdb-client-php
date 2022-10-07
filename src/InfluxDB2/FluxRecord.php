<?php


namespace InfluxDB2;

use ArrayAccess;
use RuntimeException;

/**
 * Class FluxRecord is a tuple of values. Each record in the table represents a single point in the series.
 * @see http://bit.ly/flux-spec#record
 * @package InfluxDB2
 */
class FluxRecord implements ArrayAccess
{
    public $table;
    public $values;
    public $row;

    /**
     * FluxRecord constructor.
     * @param $table int table index
     * @param $values array array with record values, key is the column name
     */
    public function __construct($table, $values = null, $row = null)
    {
        $this->table = $table;
        $this->values = $values;
        $this->row = $row;
    }

    /**
     * @return mixed record value for column named '_start'
     */
    public function getStart()
    {
        return $this->getRecordValue('_start');
    }

    /**
     * @return mixed record value for column named '_stop'
     */
    public function getStop()
    {
        return $this->getRecordValue('_stop');
    }

    /**
     * @return mixed record value for column named '_time'
     */
    public function getTime()
    {
        return $this->getRecordValue('_time');
    }

    /**
     * @return mixed record value for column named '_value'
     */
    public function getValue()
    {
        return $this->getRecordValue('_value');
    }

    /**
     * @return mixed record value for column named '_field'
     */
    public function getField()
    {
        return $this->getRecordValue('_field');
    }

    /**
     * @return mixed record value for column named '_measurement'
     */
    public function getMeasurement(): string
    {
        return $this->getRecordValue('_measurement');
    }

    /**
     * Get record value.
     *
     * @param $column string name of column to get
     * @return mixed the value of column
     * @throws RuntimeException when the record doesn't contain required column
     */
    private function getRecordValue(string $column)
    {
        if (array_key_exists($column, $this->values)) {
            return $this->values[$column];
        }

        $array_keys = join(", ", array_keys($this->values));

        throw new RuntimeException("Record doesn't contain column named '$column'. Columns: '$array_keys'.");
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->values[] = $value;
        } else {
            $this->values[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->values[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->values[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->values[$offset] ?? null;
    }
}
