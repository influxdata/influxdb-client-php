<?php

namespace InfluxDB2;

use InfluxDB2\Drivers\Curl\CurlApi;
use InfluxDB2\Drivers\Guzzle\GuzzleApi;
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
    private $api = null;

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

    public function setApi(DefaultApi $api): void
    {
        $this->api = $api;
    }

    public function getApi(): DefaultApi
    {
        if ($this->api === null) {
            $this->api = new GuzzleApi($this->options);
        }

        return $this->api;
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
        $writeApi = new WriteApi($this->options, $writeOptions, $pointSettings, $this->getApi());
        $this->autoCloseable[] = $writeApi;
        return $writeApi;
    }

    /**
     * @return UdpWriter
     * @throws \Exception
     */
    public function createUdpWriter(): UdpWriter
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
        return new QueryApi($this->options, $this->getApi());
    }

    /**
     * Get the health of an instance.
     *
     * @return HealthCheck
     */
    public function health(): HealthCheck
    {
        return (new HealthApi($this->getApi()))->health();
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

    public function getConfiguration(): Configuration
    {
        return Configuration::getDefaultConfiguration()
                            ->setUserAgent('influxdb-client-php/' . Client::VERSION)
                            ->setDebug(isset($this->options['debug']) ? $this->options['debug'] : null)
                            ->setHost(null);
    }

    /**
     * Creates the instance of api service
     *
     * @param  $serviceClass
     * @return object service instance
     */
    public function createService($serviceClass)
    {
        if (!($this->getApi() instanceof GuzzleApi)) {
            throw new RuntimeException('Only Guzzle API is supported!');
        }

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
        return (new GuzzleApi($this->options))->http;
    }
}
