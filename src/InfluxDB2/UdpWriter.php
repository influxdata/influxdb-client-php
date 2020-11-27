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
        $payload = null;
        if (is_string($data)) {
            $payload = $data;
        }
        if ($data instanceof Point) {
            $payload = $data->toLineProtocol();
        }
        if (is_array($data)) {
            if (!array_key_exists('name', $data)) {
                foreach ($data as $item) {
                    if (isset($item)) {
                        $this->write($item);
                    }
                }
                return;
            }
            $payload = Point::fromArray($data)->toLineProtocol();
        }
        if (empty($payload)) {
            throw new \InvalidArgumentException("Data passed in unknown format");
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
     */
    protected function getSocket()
    {
        if (empty($this->socket)) {
            $this->socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        }
        return $this->socket;
    }

}
