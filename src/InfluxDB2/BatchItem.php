<?php

namespace InfluxDB2;

/**
 * Item for batching queue
 */
class BatchItem
{
    public BatchItemKey $key;
    public string $data;

    public function __construct(BatchItemKey $key, string $data)
    {
        $this->key  = $key;
        $this->data = $data;
    }
}
