<?php


namespace InfluxDB2;

/**
 * Class UdpWriter
 * @package InfluxDB2
 *
 * UDP Writer Requirements:
 * 1. Installed ext-sockets
 * 2. Since Influxdb 2.0+ does not support UDP protocol natively you need to install and configure Telegraf plugin:
 *    https://docs.influxdata.com/telegraf/v1.16/plugins/#socket_listener
 * 3. Extra config option passed to client: udpPort. Optionally you can specify udpHost, otherwise udpHost will parsed from url option
 *
 * Example:
 * $client = new InfluxDB2\Client(["url" => "http://localhost:8086", "token" => "my-token",
 *       "bucket" => "my-bucket",
 *       "org" => "my-org",
 *       "precision" => InfluxDB2\Model\WritePrecision::NS,
 *       "udpPort" => 8094,
 *   ]);
 *   $writer = $client->createUdpWriter();
 *   // Write parameter matches WriterApi, so you can write strings, Point objects, arrays
 *   $writer->write('h2o,location=west value=33i 15');
 */
class UdpWriter implements Writer
{
    public $options = [];

    /**
     * @var resource
     */
    protected $socket;

    /**
     * UdpWriter constructor.
     * @param array $options
     * @throws \Exception
     */
    public function __construct($options)
    {
        $this->options = $options;
        if (empty($this->options['udpPort'])) {
            throw new \Exception('udpPort option does not specified');
        }
        if (empty($this->options['udpHost'])) {
            $this->options['udpHost'] = parse_url($this->options['url'], PHP_URL_HOST);
        }
    }

    /**
     * @inheritDoc
     */
    public function write($data)
    {
        $payload = WritePayloadSerializer::generatePayload($data);
        if (empty($payload)) {
            return;
        }
        if ($payload instanceof BatchItem) {
            throw new \InvalidArgumentException("Batch mode not allowed for writing by UDP");
        }
        $bytesSent = $this->writeSocket($payload);
        if ($bytesSent === false) {
            throw new \Exception('Unable to write data');
        }
    }

    /**
     * @param string $payload
     * @return false|int
     * @throws \Exception
     */
    protected function writeSocket($payload)
    {
        $bytesSent = false;
        if ($socket = $this->getSocket()) {
            $bytesSent = socket_sendto($socket, $payload, strlen($payload), 0, $this->options['udpHost'], $this->options['udpPort']);
        }
        return $bytesSent;
    }

    /**
     * Create (if not exists) socket to write UDP datagrams
     * @return false|resource
     * @throws \Exception
     */
    protected function getSocket()
    {
        if (empty($this->socket)) {
            $this->socket = socket_create($this->getConfiguredInetVersion(), SOCK_DGRAM, SOL_UDP);
        }
        return $this->socket;
    }

    /**
     * @throws \Exception
     * @return int socket domain constant
     */
    private function getConfiguredInetVersion()
    {
        $configuredIpVersion = $this->options['ipVersion'] ?? 4;

        switch ($configuredIpVersion) {
            case 4:
                return AF_INET;
            case 6:
                return AF_INET6;
            default:
                throw new \Exception('ipVersion option invalid!');
        }
    }

    /**
     * Closes connection
     */
    public function close()
    {
        if (isset($this->socket)) {
            socket_close($this->socket);

            $this->socket = null;
        }
    }
}
