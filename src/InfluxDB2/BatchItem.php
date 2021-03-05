<?php

namespace InfluxDB2;

/**
 * Item for batching queue
 */
class BatchItem
{
    /** @var BatchItemKey */
    public $key;
    /** @var string */
    public $data;

    public function __construct($key, $data)
    {
        $this->key  = $key;
        $this->data = $data;
    }
}
