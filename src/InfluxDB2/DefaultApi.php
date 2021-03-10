<?php

namespace InfluxDB2;

use InvalidArgumentException;

abstract class DefaultApi
{
    const DEFAULT_TIMEOUT = 10;

    public $options;

    /**
     * DefaultApi constructor.
     * @param $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;

        $this->setUpClient();
    }

    /**
     * @param $payload
     * @param $uriPath
     * @param $queryParams
     * @param int $timeout - Float describing the timeout of the request in seconds. Use 0 to wait indefinitely (the default behavior).
     * @param bool $stream - use streaming
     * @return string response body
     */
    public function post($payload, $uriPath, $queryParams, $timeout = self::DEFAULT_TIMEOUT, bool $stream = false): string
    {
        return $this->request($payload, $uriPath, $queryParams, 'POST', $timeout, $stream);
    }

    public function get($payload, $uriPath, $queryParams, $timeout = self::DEFAULT_TIMEOUT): string
    {
        return $this->request($payload, $uriPath, $queryParams, 'GET', $timeout, false);
    }

    abstract protected function setUpClient();

    abstract protected function request($payload, $uriPath, $queryParams, $method, $timeout = self::DEFAULT_TIMEOUT, bool $stream = false): string;

    public function check($key, $value)
    {
        if ((!isset($value) || trim($value) === '')) {
            $options = implode(', ', array_map(
                function ($v, $k) {
                    if (is_array($v)) {
                        return $k.'[]='.implode('&'.$k.'[]=', $v);
                    } else {
                        return $k.'='.$v;
                    }
                },
                $this->options,
                array_keys($this->options)
            ));
            throw new InvalidArgumentException("The '${key}' should be defined as argument or default option: {$options}");
        }
    }

    /**
     * Log message with specified severity to log file defined by: 'options['logFile']'.
     *
     * @param string $level log severity
     * @param string $message log message
     */
    public function log(string $level, string $message): void
    {
        $logFile = isset($this->options['logFile']) ? $this->options['logFile'] : "php://output";
        $logDate = date('H:i:s d-M-Y');

        file_put_contents($logFile, "[{$logDate}]: [{$level}] - {$message}", FILE_APPEND);
    }
}
