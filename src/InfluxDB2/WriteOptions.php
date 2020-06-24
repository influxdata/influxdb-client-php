<?php

namespace InfluxDB2;

class WriteOptions
{
    const DEFAULT_BATCH_SIZE = 10;
    const DEFAULT_FLUSH_INTERVAL = 1000;

    public $writeType;
    public $batchSize;
    public $flushInterval;

    /**
     * WriteOptions constructor.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *          'flushInterval' => flush data at least in this interval
     *      ]
     * @param array $writeOptions Array containing the write parameters (See above)
     */
    public function __construct(array $writeOptions = null)
    {
        //initialize with default values
        $this->writeType =  $writeOptions["writeType"] ?? WriteType::SYNCHRONOUS;
        $this->batchSize = $writeOptions["batchSize"] ??  self::DEFAULT_BATCH_SIZE;
        $this->flushInterval = $writeOptions["flushInterval"] ??  self::DEFAULT_FLUSH_INTERVAL;
    }
}

