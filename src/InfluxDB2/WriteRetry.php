<?php

namespace InfluxDB2;

use Http\Client\Exception\NetworkException;

/**
 * Exponential random write retry.
 */
class WriteRetry
{
    private $maxRetries;
    private $retryInterval;
    private $maxRetryDelay;
    private $exponentialBase;
    private $jitterInterval;
    private $maxRetryTime;
    private $retryTimout;
    /**
     * @var array
     */
    private $options;

    /**
     * WriteRetry constructor.
     *
     * @param int $maxRetries max number of retries when write fails
     * @param int $retryInterval number of milliseconds to retry unsuccessful write,
     *      The retry interval is used when the InfluxDB server does not specify "Retry-After" header.
     * @param int $maxRetryDelay maximum delay when retrying write in milliseconds
     * @param int $exponentialBase the base for the exponential retry delay, the next delay is computed using
     *              random exponential backoff as a random value within the interval
     *              ``retryInterval * exponentialBase^(attempts-1)`` and
     *              ``retryInterval * exponentialBase^(attempts)``.
     *              Example for ``retryInterval=5000, exponentialBase=2, maxRetryDelay=125000, total=5``
     *              Retry delays are random distributed values within the ranges of
     *              ``[5000-10000, 10000-20000, 20000-40000, 40000-80000, 80000-125000]``
     *
     * @param int $maxRetryTime maximum total time when retrying write in milliseconds
     * @param int $jitterInterval the number of milliseconds before the data is written increased by a random amount
     * @param array $options Client options with logFile.
     */
    public function __construct(
        int $maxRetries = 5,
        int $retryInterval = 5000,
        int $maxRetryDelay = 125000,
        int $exponentialBase = 2,
        int $maxRetryTime = 180000,
        int $jitterInterval = 0,
        array $options = []
    ) {
        $this->maxRetries = $maxRetries;
        $this->retryInterval = $retryInterval;
        $this->maxRetryDelay = $maxRetryDelay;
        $this->maxRetryTime = $maxRetryTime;
        $this->exponentialBase = $exponentialBase;
        $this->jitterInterval = $jitterInterval;
        $this->options = $options;

        //retry timout
        $this->retryTimout = microtime(true) * 1000 + $maxRetryTime;
    }

    /**
     * @throws ApiException
     */
    public function retry($callable, $attempts = 0)
    {
        try {
            return call_user_func($callable);
        } catch (ApiException $e) {
            $error = $e->getResponseBody() ?? $e->getMessage();

            if (!$this->isRetryable($e)) {
                throw $e;
            }
            $attempts++;
            if ($attempts > $this->maxRetries) {
                DefaultApi::log("ERROR", "Maximum retry attempts reached", $this->options);
                throw $e;
            }

            // throws exception when max retry time is exceeded
            if (microtime(true) * 1000 > $this->retryTimout) {
                DefaultApi::log("ERROR", "Maximum retry time $this->maxRetryTime ms exceeded", $this->options);
                throw $e;
            }

            $headers = $e->getResponseHeaders();
            if ($headers != null && array_key_exists('Retry-After', $headers)) {
                //jitter add in microseconds
                $jitterMicro = rand(0, $this->jitterInterval) * 1000;
                $timeout = (int)$headers['Retry-After'][0] * 1000000.0 + $jitterMicro;
            } else {
                $timeout = $this->getBackoffTime($attempts) * 1000;
            }

            $timeoutInSec = $timeout / 1000000.0;

            $message = "The retryable error occurred during writing of data. Reason: '$error'. Retry in: {$timeoutInSec}s.";
            DefaultApi::log("WARNING", $message, $this->options);
            usleep($timeout);
            $this->retry($callable, $attempts);
        }
    }

    public function isRetryable(ApiException $e): bool
    {
        $code = $e->getCode();
        if (($code == null || $code < 429) &&
            !($e->getPrevious() instanceof NetworkException)) {
            return false;
        }
        return true;
    }

    public function getBackoffTime(int $attempt)
    {
        $range_start = $this->retryInterval;
        $range_stop = $this->retryInterval * $this->exponentialBase;

        $i = 1;
        while ($i < $attempt) {
            $i += 1;
            $range_start = $range_stop;
            $range_stop = $range_stop * $this->exponentialBase;
            if ($range_stop > $this->maxRetryDelay) {
                break;
            }
        }

        if ($range_stop > $this->maxRetryDelay) {
            $range_stop = $this->maxRetryDelay;
        }
        return $range_start + ($range_stop - $range_start) * (rand(0, 1000) / 1000);
    }
}
