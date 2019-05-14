<?php

namespace InfluxDB2;

class Point
{
    /** @var string */
    protected $measurement;
    /** @var int */
    protected $time;
    /** @var array */
    protected $tags;
    /** @var array */
    protected $fields;

    public function __construct($measurement, $tags, $fields, $time = null)
    {
        if(is_null($fields)) {
            throw new \Exception("No fields specified");
        }

        $this->measurement =$measurement;
        $this->tags = $tags;
        $this->fields = $fields;
        $this->time = $time;
    }

    public function getMeasuremnt()
    {
        return $this->measurement;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getTag(string $name)
    {
        return $this->tags[$name] ?? null;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getField(string $name)
    {
        return $this->fields[$name] ?? null;
    }

    public function lineProtocol()
    {
        $lineProtocol = $this->measurement;

        foreach ($this->tags as $name => $value) {
            $lineProtocol .= ",${name}=${value}";
        }

        $lineProtocol .= " ";

        foreach ($this->fields as $name => $value) {
            $lineProtocol .= "${name}=${value},";
        }

        // Trim last comma
        $lineProtocol = rtrim($lineProtocol, ",");

        if(is_null($this->time)) {
            return $lineProtocol;
        }

        return $lineProtocol .= " " . $this->time;
    }
}
