<?php

namespace InfluxDB2;

class WriteOptions
{
    public const DEFAULT_BATCH_SIZE = 10;
    public const DEFAULT_RETRY_INTERVAL = 5000;
    public const DEFAULT_MAX_RETRIES = 5;
    public const DEFAULT_MAX_RETRY_DELAY = 125000;
    public const DEFAULT_MAX_RETRY_TIME = 180000;
    public const DEFAULT_EXPONENTIAL_BASE = 2;
    public const DEFAULT_JITTER_INTERVAL = 0;

    /** @var WriteType::SYNCHRONOUS|WriteType::BATCHING $writeType */
    public int $writeType;
    public int $batchSize;
    public int $retryInterval;
    public int $maxRetries;
    public int $maxRetryDelay;
    public int $exponentialBase;
    public int $jitterInterval;
    public int $maxRetryTime;

    /**
     * WriteOptions constructor.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *          'retryInterval' => number of milliseconds to retry unsuccessful write
     *          'maxRetries' => max number of retries when write fails
     *              The retry interval is used when the InfluxDB server does not specify "Retry-After" header.
     *          'maxRetryDelay' => maximum delay when retrying write in milliseconds
     *          'maxRetryTime' => maximum total time when retrying write in milliseconds
     *          'exponentialBase' => the base for the exponential retry delay, the next delay is computed using
     *              random exponential backoff as a random value within the interval
     *              ``retryInterval * exponentialBase^(attempts-1)`` and
     *              ``retryInterval * exponentialBase^(attempts)``.
     *              Example for ``retryInterval=5000, exponentialBase=2, maxRetryDelay=125000, total=5``
     *              Retry delays are random distributed values within the ranges of
     *              ``[5000-10000, 10000-20000, 20000-40000, 40000-80000, 80000-125000]``
     *          'jitterInterval' => the number of milliseconds before the data is written increased by a random amount
     *      ]
     * @param array{
     *     writeType?: WriteType::SYNCHRONOUS|WriteType::BATCHING,
     *     batchSize?: int,
     *     retryInterval?: int,
     *     maxRetries?: int,
     *     maxRetryDelay?: int,
     *     maxRetryTime?: int,
     *     exponentialBase?: int,
     *     jitterInterval?: int,
     * }|null $writeOptions Array containing the write parameters (See above)
     */
    public function __construct(?array $writeOptions = null)
    {
        //initialize with default values
        $this->writeType =  $writeOptions["writeType"] ?? WriteType::SYNCHRONOUS;
        $this->batchSize = $writeOptions["batchSize"] ??  self::DEFAULT_BATCH_SIZE;
        $this->retryInterval = $writeOptions["retryInterval"] ?? self::DEFAULT_RETRY_INTERVAL;
        $this->maxRetries = $writeOptions["maxRetries"] ?? self::DEFAULT_MAX_RETRIES;
        $this->maxRetryDelay = $writeOptions["maxRetryDelay"] ?? self::DEFAULT_MAX_RETRY_DELAY;
        $this->maxRetryTime = $writeOptions["maxRetryTime"] ?? self::DEFAULT_MAX_RETRY_TIME;
        $this->exponentialBase = $writeOptions["exponentialBase"] ?? self::DEFAULT_EXPONENTIAL_BASE;
        $this->jitterInterval = $writeOptions["jitterInterval"] ?? self::DEFAULT_JITTER_INTERVAL;
    }
}
