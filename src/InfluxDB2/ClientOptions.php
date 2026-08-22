<?php

declare(strict_types=1);

namespace InfluxDB2;

use InfluxDB2\Model\WritePrecision;
use InvalidArgumentException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ClientOptions
{
    public string $url;
    public string $token;
    public ?string $bucket;
    public ?string $org;
    /** @var WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null $precision */
    public ?string $precision;
    /** @var array{
     *     'preserve_header'?: bool|string[],
     *     'use_default_for_multiple'?: bool,
     *     'strict'?: bool,
     *     'stream_factory'?:StreamFactoryInterface,
     * }|bool|null $allowRedirects */
    public $allowRedirects;
    public ?bool $debug;
    public ?string $logFile;
    public ?ClientInterface $httpClient;
    public ?bool $verifySSL;
    public ?int $timeout;
    public ?string $proxy;
    public ?ClientOptionsUdp $udp;
    /** @var array<string, string>|null $tags */
    public ?array $tags;

    public function __construct(
        string $url,
        string $token
    ) {
        $this->url = $url;
        $this->token = $token;
    }

    /**
     * @param array{
     *     url: string,
     *     token: string,
     *     bucket?: string,
     *     org?: string,
     *     precision?: WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS,
     *     allow_redirects?: array{
     *         'preserve_header'?: bool|string[],
     *         'use_default_for_multiple'?: bool,
     *         'strict'?: bool,
     *         'stream_factory'?: StreamFactoryInterface,
     *     }|bool,
     *     debug?: bool,
     *     logFile?: string,
     *     httpClient?: ClientInterface,
     *     verifySSL?: bool,
     *     timeout?: int,
     *     proxy?: string,
     *     udpHost?: string,
     *     udpPort?: int<1, 65535>,
     *     ipVersion?: 4|6,
     *     tags?: array<string, string>,
     * } $options
     */
    public static function fromArray(array $options): self
    {
        if (
            !array_key_exists('url', $options) ||
            !is_string($options['url']) ||
            filter_var($options['url'], FILTER_VALIDATE_URL) === false
        ) {
            throw new InvalidArgumentException('url is required and must be a string');
        }
        if (
            !array_key_exists('token', $options) ||
            !is_string($options['token'])
        ) {
            throw new InvalidArgumentException('token is required and must be a string');
        }
        if (
            array_key_exists('precision', $options) &&
            !in_array($options['precision'], WritePrecision::getAllowableEnumValues(), true)
        ) {
            throw new InvalidArgumentException('precision must be a valid WritePrecision value');
        }
        if (
            array_key_exists('httpClient', $options) &&
            !($options['httpClient'] instanceof ClientInterface)
        ) {
            throw new InvalidArgumentException('httpClient must be an instance of Psr\Http\Client\ClientInterface');
        }
        if (
            array_key_exists('ipVersion', $options) &&
            !in_array($options['ipVersion'], [4, 6], true)
        ) {
            throw new InvalidArgumentException('ipVersion must be 4, 6');
        }
        $clientOptions = new self(
            $options['url'],
            $options['token'],
        );
        $clientOptions->bucket = $options['bucket'] ?? null;
        $clientOptions->org = $options['org'] ?? null;
        $clientOptions->precision = $options['precision'] ?? null;
        $clientOptions->allowRedirects = $options['allow_redirects'] ?? null;
        $clientOptions->debug = $options['debug'] ?? null;
        $clientOptions->logFile = $options['logFile'] ?? null;
        $clientOptions->httpClient = $options['httpClient'] ?? null;
        $clientOptions->verifySSL = $options['verifySSL'] ?? null;
        $clientOptions->timeout = $options['timeout'] ?? null;
        $clientOptions->proxy = $options['proxy'] ?? null;
        if (array_key_exists('udpPort', $options)) {
            $clientOptions->udp = ClientOptionsUdp::fromArray($options);
        } else {
            $clientOptions->udp = null;
        }
        $clientOptions->tags = $options['tags'] ?? null;
        return $clientOptions;
    }

    /**
     * @return array{
     *     url: string,
     *     token: string,
     *     bucket?: string,
     *     org?: string,
     *     precision?: WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS,
     *     allow_redirects?: array{
     *         'preserve_header'?: bool|string[],
     *         'use_default_for_multiple'?: bool,
     *         'strict'?: bool,
     *         'stream_factory'?: StreamFactoryInterface,
     *     }|bool|null,
     *     debug?: bool,
     *     logFile?: string,
     *     httpClient?: ClientInterface,
     *     verifySSL?: bool,
     *     timeout?: int,
     *     proxy?: string,
     *     udpHost?: string,
     *     udpPort?: int<1, 65535>,
     *     ipVersion?: 4|6,
     *     tags?: array<string, string>,
     * }
     */
    public function toArray(): array
    {
        return array_merge(
            [
                'url' => $this->url,
                'token' => $this->token,
                'bucket' => $this->bucket,
                'org' => $this->org,
                'precision' => $this->precision,
                'allow_redirects' => $this->allowRedirects,
                'debug' => $this->debug,
                'logFile' => $this->logFile,
                'httpClient' => $this->httpClient,
                'verifySSL' => $this->verifySSL,
                'timeout' => $this->timeout,
                'proxy' => $this->proxy,
                'tags' => $this->tags,
            ],
            ($this->udp instanceof ClientOptionsUdp) ? $this->udp->toArray() : [],
        );
    }
}
