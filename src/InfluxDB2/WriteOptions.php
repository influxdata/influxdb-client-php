<?php

namespace InfluxDB2;

class WriteOptions
{
    const DEFAULT_BATCH_SIZE = 10;
    const DEFAULT_RETRY_INTERVAL = 1000;
    const DEFAULT_MAX_RETRIES = 5;
    const DEFAULT_MAX_RETRY_DELAY = 180000;
    const DEFAULT_EXPONENTIAL_BASE = 5;

    public $writeType;
    public $batchSize;
    public $retryInterval;
    public $maxRetries;
    public $maxRetryDelay;
    public $exponentialBase;

    /**
     * WriteOptions constructor.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *          'retryInterval' => number of milliseconds to retry unsuccessful write
     *          'maxRetries' => max number of retries when write fails
     *              The retry interval is used when the InfluxDB server does not specify "Retry-After" header.
     *          'maxRetryDelay' => maximum delay when retrying write
     *          'exponentialBase' => the base for the exponential retry delay, the next delay is computed as
     *              `retry_interval * exponential_base^(attempts - 1) + random(jitter_interval)`
     *      ]
     * @param array $writeOptions Array containing the write parameters (See above)
     */
    public function __construct(array $writeOptions = null)
    {
        //initialize with default values
        $this->writeType =  $writeOptions["writeType"] ?? WriteType::SYNCHRONOUS;
        $this->batchSize = $writeOptions["batchSize"] ??  self::DEFAULT_BATCH_SIZE;
        $this->retryInterval = $writeOptions["retryInterval"] ?? self::DEFAULT_RETRY_INTERVAL;
        $this->maxRetries = $writeOptions["maxRetries"] ?? self::DEFAULT_MAX_RETRIES;
        $this->maxRetryDelay = $writeOptions["maxRetryDelay"] ?? self::DEFAULT_MAX_RETRY_DELAY;
        $this->exponentialBase = $writeOptions["exponentialBase"] ?? self::DEFAULT_EXPONENTIAL_BASE;
    }
}

