<?php

namespace InfluxDB2;

use Exception;
use InfluxDB2\Model\HealthCheck;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Service\InvokableScriptsService;
use InfluxDB2\Service\PingService;
use ReflectionClass;
use ReflectionException;
use RuntimeException;

class Client
{
    /**
     * Client version updated by: 'make release VERSION=1.5.0'
     */
    public const VERSION = 'dev';

    public ClientOptions $options;
    public bool $closed = false;
    /** @var array<WriteApi> */
    private array $autoCloseable = array();

    /**
     * Client constructor.
     *
     * Example how to create a client:
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
     *              'hostname' => '${env.Hostname}'],
     *          "timeout" => 2,
     *          "ipVersion" => 6,
     *          ]);
     *
     * Client can be configured with following properties:
     *
     * - url: InfluxDB server API url (ex. http://localhost:8086).
     * - token: auth token
     * - bucket: destination bucket for writes
     * - org: organization bucket for writes
     * - precision: precision for the unix timestamps within the body line-protocol
     * - verifySSL: Turn on/off SSL certificate verification. Set to `false` to disable certificate verification.
     * - debug: enable verbose logging of http requests
     * - logFile: log output
     * - tags: default tags
     * - timeout: The number of seconds to wait while trying to connect to a server. Use 0 to wait indefinitely.
     * - proxy: Pass a string to specify an HTTP proxy, or an array to specify different proxies for different protocols.
     * - allow_redirects: Describes the redirect behavior for requests.
     * - ipVersion: Specifies which version of IP to use, supports 4 and 6 as possible values (UDP Writer).
     *
     * @param array{
     *      url: string,
     *      token: string,
     *      bucket?: string,
     *      org?: string,
     *      precision?: WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS,
     *      allow_redirects?: bool,
     *      debug?: bool,
     *      logFile?: string,
     *      httpClient?: \Psr\Http\Client\ClientInterface,
     *      verifySSL?: bool,
     *      timeout?: int,
     *      proxy?: string,
     *      udpHost?: string,
     *      udpPort?: int<1, 65535>,
     *      ipVersion?: 4|6,
     *      tags?: array<string, string>,
     *  }|ClientOptions $options Client options
     */
    public function __construct($options)
    {
        if (!is_array($options) && !$options instanceof ClientOptions) {
            throw new \InvalidArgumentException('Options must be an array or ClientOptions');
        }
        $this->options = is_array($options) ? ClientOptions::fromArray($options) : $options;
    }

    /**
     * Write time series data into InfluxDB through the WriteApi.
     *      $writeOptions = [
     *          'writeType' => methods of write (WriteType::SYNCHRONOUS - default, WriteType::BATCHING)
     *          'batchSize' => the number of data point to collect in batch
     *      ]
     * @param array{
     *      writeType?: WriteType::SYNCHRONOUS|WriteType::BATCHING,
     *      batchSize?: int,
     *      retryInterval?: int,
     *      maxRetries?: int,
     *      maxRetryDelay?: int,
     *      maxRetryTime?: int,
     *      exponentialBase?: int,
     *      jitterInterval?: int,
     *  }|null $writeOptions Array containing the write parameters (See above)
     * @param array<string, string>|null $pointSettings Array of default tags
     * @return WriteApi
     */
    public function createWriteApi(?array $writeOptions = null, ?array $pointSettings = null): WriteApi
    {
        $writeApi = new WriteApi($this->options, $writeOptions, $pointSettings);
        $this->autoCloseable[] = $writeApi;
        return $writeApi;
    }

    /**
     * @return UdpWriter
     * @throws Exception
     */
    public function createUdpWriter(): UdpWriter
    {
        if ($this->options->udp === null) {
            throw new Exception('UDP options are not set');
        }
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
     * Create an InvokableScripts API instance.
     *
     * @return InvokableScriptsApi
     */
    public function createInvokableScriptsApi(): InvokableScriptsApi
    {
        /** @var InvokableScriptsService $service */
        $service = $this->createService(InvokableScriptsService::class);
        return new InvokableScriptsApi($this->options, $service);
    }

    /**
     * Get the health of an instance.
     *
     * @deprecated Use `ping()` instead
     * @return HealthCheck
     */
    public function health(): HealthCheck
    {
        return (new HealthApi($this->options))->health();
    }

    /**
     * Checks the status of InfluxDB instance and version of InfluxDB.
     *
     * @return array with response headers: 'X-Influxdb-Build', 'X-Influxdb-Version'
     */
    public function ping(): array
    {
        $service = $this->createService(PingService::class);
        $pingWithHttpInfo = $service->getPingWithHttpInfo();
        return $pingWithHttpInfo[2];
    }

    /**
     * Close all connections into InfluxDB
     */
    public function close(): void
    {
        $this->closed = true;

        foreach ($this->autoCloseable as $ac) {
            $ac->close();
        }
        $this->autoCloseable = [];
    }

    /**
     * Creates the instance of api service
     *
     * @template C of object
     * @param class-string<C> $serviceClass
     * @return C service instance
     */
    public function createService(string $serviceClass): object
    {
        try {
            $class = new ReflectionClass($serviceClass);
            $args = array(new DefaultApi($this->options));
            return $class->newInstanceArgs($args);
        } catch (ReflectionException $e) {
            throw new RuntimeException($e);
        }
    }
}
