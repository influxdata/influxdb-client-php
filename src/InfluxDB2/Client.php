<?php

namespace InfluxDB2;

use InfluxDB2\Drivers\Curl\CurlHealthApi;
use InfluxDB2\Drivers\Curl\CurlQueryApi;
use InfluxDB2\Drivers\Curl\CurlWriteApi;
use InfluxDB2\Drivers\Guzzle\GuzzleHealthApi;
use InfluxDB2\Drivers\Guzzle\GuzzleQueryApi;
use InfluxDB2\Drivers\Guzzle\GuzzleWriteApi;
use InfluxDB2\Model\HealthCheck;
use ReflectionClass;
use ReflectionException;
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
        $writeApi = new GuzzleWriteApi($this->options, $writeOptions, $pointSettings);
        $this->autoCloseable[] = $writeApi;
        return $writeApi;
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
    public function createCurlWriteApi(array $writeOptions = null, array $pointSettings = null): WriteApi
    {
        $writeApi = new CurlWriteApi($this->options, $writeOptions, $pointSettings);
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
        return new GuzzleQueryApi($this->options);
    }

    /**
     * Get the Query client.
     *
     * @return QueryApi
     */
    public function createCurlQueryApi(): QueryApi
    {
        return new CurlQueryApi($this->options);
    }

    /**
     * Get the health of an instance.
     *
     * @return HealthCheck
     */
    public function health(): HealthCheck
    {
        return (new GuzzleHealthApi($this->options))->health();
    }

    /**
     * Get the health of an instance.
     *
     * @return HealthCheck
     */
    public function curlHealth(): HealthCheck
    {
        return (new CurlHealthApi($this->options))->health();
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
    public function createCurlService($serviceClass)
    {
        throw new RuntimeException('cURL services are unsupported');
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
        } catch (ReflectionException $e) {
            throw new RuntimeException($e);
        }
    }

    private function getGuzzleClient()
    {
        $defaultApi = new GuzzleQueryApi($this->options);
        return $defaultApi->http;
    }
}
