<?php

declare(strict_types=1);

namespace InfluxDB2;

use InfluxDB2\Model\WritePrecision;
use Psr\Http\Client\ClientInterface;

class ClientOptionsUdp
{
    public string $host;
    /** @var int<1, 65535> $udpPort */
    public int $port;
    /** @var 4|6 $ipVersion */
    public int $ipVersion;

    public function __construct(
        string $host,
        int $port,
        int $ipVersion
    ) {
        if (
            filter_var($host, FILTER_VALIDATE_IP) === false &&
            filter_var($host, FILTER_VALIDATE_DOMAIN) === false
        ) {
            throw new \InvalidArgumentException('UDP host must be a valid IP or domain name');
        }
        if ($port < 1 || $port > 65535) {
            throw new \InvalidArgumentException('UDP port must be an integer between 1 and 65535');
        }
        if (!in_array($ipVersion, [4, 6], true)) {
            throw new \InvalidArgumentException('IP version must be 4 or 6');
        }
        $this->host = $host;
        $this->port = $port;
        $this->ipVersion = $ipVersion;
    }

    /**
     * @param array{
     *     url: string,
     *     udpHost?: string,
     *     udpPort?: int<1, 65535>,
     *     ipVersion?: 4|6,
     * } $options
     */
    public static function fromArray(array $options): self
    {
        if (
            !array_key_exists('udpHost', $options) &&
            !array_key_exists('url', $options)
        ) {
            throw new \InvalidArgumentException('Either udpHost or url must be provided');
        }
        if (!array_key_exists('udpHost', $options)) {
            $host = parse_url($options['url'], PHP_URL_HOST);
            if ($host === false) {
                throw new \InvalidArgumentException('url must be a valid URL');
            }
        } else {
            $host = $options['udpHost'];
        }
        if (!array_key_exists('udpPort', $options)) {
            throw new \InvalidArgumentException('udpPort must be provided');
        }
        return new self(
            $host,
            $options['udpPort'],
            $options['ipVersion'] ?? 4
        );
    }

    /**
     * @return array{
     *     udpHost: string,
     *     udpPort: int<1, 65535>,
     *     ipVersion: 4|6,
     * }
     */
    public function toArray(): array
    {
        return [
            'udpHost' => $this->host,
            'udpPort' => $this->port,
            'ipVersion' => $this->ipVersion,
        ];
    }

    /**
     * Returns the socket domain for the UDP connection.
     *
     * @return int The socket domain (AF_INET or AF_INET6).
     * @throws \InvalidArgumentException When invalid IP version is provided
     */
    public function getSocketDomain(): int
    {
        if (!in_array($this->ipVersion, [4, 6], true)) {
            throw new \InvalidArgumentException('IP version must be 4 or 6');
        }
        return $this->ipVersion === 4 ? AF_INET : AF_INET6;
    }

}
