<?php

namespace InfluxDB2;

use InfluxDB2\Model\HealthCheck;
use ReflectionClass;
use RuntimeException;

/**
 * @template T
 */
class Client
{
    /**
     * Client version updated by: 'make release VERSION=1.5.0'
     */
    const VERSION = 'dev';

    public $options;
    public $closed = false;
    private $autoCloseable = array();

    /**
     * Client constructor.
     *
     *      client = new Client([
     *          "url" => "http://localhost:8086",
     *          "token" => "my-token",
     *          "bucket" => "my-bucket",
     *          "precision" => WritePrecision::NS,
     *          "org" => "my-org",
     *          "debug" => false,
     *          "logFile" => "php://output",
     *          "tags" => ['id' => '1234',
     *              'hostname' => '${env.Hostname}']
     *          ]);
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * Write time series data into InfluxDB thought WriteApi.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *      ]
     * @param array|null $writeOptions Array containing the write parameters (See above)
     * @param array|null $pointSettings Array of default tags
     * @return WriteApi
     */
    public function createWriteApi(array $writeOptions = null, array $pointSettings = null): WriteApi
    {
        $writeApi = new WriteApi($this->options, $writeOptions, $pointSettings);
        $this->autoCloseable[] = $writeApi;
        return $writeApi;
    }

    /**
     * @return UdpWriter
     * @throws \Exception
     */
    public function createUdpWriter()
    {
        return new UdpWriter($this->options);
    }

    /**
     * Get the Query client.
     *
     * @return QueryApi
     */
    public function createQueryApi(): QueryApi
    {
        return new QueryApi($this->options);
    }

    /**
     * Get the health of an instance.
     *
     * @return HealthCheck
     */
    public function health(): HealthCheck
    {
        return (new HealthApi($this->options))->health();
    }

    /**
     * Close all connections into InfluxDB
     */
    public function close()
    {
        $this->closed = true;

        foreach ($this->autoCloseable as $ac) {
            $ac->close();
        }
    }

    public function getConfiguration()
    {

        $config = Configuration::getDefaultConfiguration()
            ->setUserAgent('influxdb-client-php/' . Client::VERSION)
            ->setDebug(isset($this->options['debug']) ? $this->options['debug'] : null)
            ->setHost(null);

        return $config;
    }

    /**
     * Creates the instance of api service
     *
     * @param  $serviceClass
     * @return object service instance
     */
    public function createService($serviceClass)
    {
        try {
            $class = new ReflectionClass($serviceClass);
            $args = array($this->getGuzzleClient(), $this->getConfiguration());
            return $class->newInstanceArgs($args);
        } catch (\ReflectionException $e) {
            throw new RuntimeException($e);
        }
    }

    private function getGuzzleClient()
    {
        $defaultApi = new DefaultApi($this->options);
        return $defaultApi->http;
    }
}
