<?php

namespace InfluxDB2;

class WriteOptions
{
    const DEFAULT_BATCH_SIZE = 10;
    const DEFAULT_FLUSH_INTERVAL = 1000;
    const DEFAULT_RETRY_INTERVAL = 1000;
    const DEFAULT_MAX_RETRIES = 3;

    public $writeType;
    public $batchSize;
    public $flushInterval;
    public $retryInterval;
    public $maxRetries;

    /**
     * WriteOptions constructor.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *          'flushInterval' => flush data at least in this interval
     *          'retryInterval' => number of milliseconds to retry unsuccessful write
     *          'maxRetries' => max number of retries when write fails
     *              The retry interval is used when the InfluxDB server does not specify "Retry-After" header.
     *      ]
     * @param array $writeOptions Array containing the write parameters (See above)
     */
    public function __construct(array $writeOptions = null)
    {
        //initialize with default values
        $this->writeType =  $writeOptions["writeType"] ?? WriteType::SYNCHRONOUS;
        $this->batchSize = $writeOptions["batchSize"] ??  self::DEFAULT_BATCH_SIZE;
        $this->flushInterval = $writeOptions["flushInterval"] ??  self::DEFAULT_FLUSH_INTERVAL;
        $this->retryInterval = $writeOptions["retryInterval"] ?? self::DEFAULT_RETRY_INTERVAL;
        $this->maxRetries = $writeOptions["maxRetries"] ?? self::DEFAULT_MAX_RETRIES;
    }
}

