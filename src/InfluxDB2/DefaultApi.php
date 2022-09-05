<?php

namespace InfluxDB2;

use GuzzleHttp\Client;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\Exception\HttpException;
use Http\Discovery\Psr17FactoryDiscovery;
use InfluxDB2\Internal\DebugHttpPlugin;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

class DefaultApi
{
    const DEFAULT_TIMEOUT = 10;
    public $options;
    /**
     * @var ClientInterface
     */
    public $http;

    /**
     * Holds GuzzleHttp timeout.
     *
     * @var int
     */
    private $timeout;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * DefaultApi constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
        $this->timeout = $this->options['timeout'] ?? self::DEFAULT_TIMEOUT;

        $client = new Client([
            'base_uri' => $this->options['url'],
            'timeout' => $this->timeout,
            'verify' => $this->options['verifySSL'] ?? true,
            'proxy' => $this->options['proxy'] ?? null
        ]);
        $this->http = $this->configuredClient($client);

        $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
    }

    /**
     * @param $payload
     * @param $uriPath
     * @param $queryParams
     * @param int|null $timeout - Float describing the timeout of the request in seconds.
     *                            Use 0 to wait indefinitely (the default behavior).
     * @return ResponseInterface
     */
    public function post($payload, $uriPath, $queryParams, int $timeout = null): ResponseInterface
    {
        return $this->request($payload, $uriPath, $queryParams, 'POST', $timeout);
    }

    public function get($payload, $uriPath, $queryParams, $timeout = null): ResponseInterface
    {
        return $this->request($payload, $uriPath, $queryParams, 'GET', $timeout);
    }

    /**
     * Configure client with defaults - UserAgent, Token, Redirects...
     *
     * @param ClientInterface $client to configure
     * @return ClientInterface
     */
    public function configuredClient(ClientInterface $client): ClientInterface
    {
        $plugins = [
            new Plugin\HeaderDefaultsPlugin([
                'User-Agent' => 'influxdb-client-php/' . \InfluxDB2\Client::VERSION,
                'Authorization' => "Token {$this->options['token']}",
            ]),
        ];

        $allow_redirects = $this->options['allow_redirects'] ?? true;
        if ($allow_redirects) {
            $plugins[] = new Plugin\RedirectPlugin(is_array($allow_redirects) ? $allow_redirects : []);
        }
        if ($this->options['debug'] ?? false) {
            $plugins[] = new DebugHttpPlugin($this->options);
        }
        return new PluginClient($client, $plugins);
    }

    /**
     * Create HTTP request.
     *
     * @param string $method The HTTP method associated with the request.
     * @param string $uriPath The URI associated with the request.
     * @param string $payload String content with which to populate the stream.
     * @param array<string, string> $headers Request headers
     * @param array<string, string> $queryParams The query string to use with the new instance.
     * @return RequestInterface
     */
    public function createRequest(
        string $method,
        string $uriPath,
        string $payload,
        array  $headers,
        array  $queryParams
    ): RequestInterface {
        $request = $this->requestFactory->createRequest($method, $uriPath);
        $request = $request->withBody($this->streamFactory->createStream($payload));
        foreach ($headers as $header => $value) {
            $request = $request->withAddedHeader($header, $value);
        }
        $uri = $request->getUri()->withQuery(http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986));
        return $request->withUri($uri);
    }

    /**
     * Sends a HTTP request and returns a HTTP response.
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            // TODO timeout
            // execute HTTP call
            $response = $this->http->sendRequest($request);

            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                $responseBody = $response->getBody()->getContents();
                $jsonBody = json_decode($responseBody);
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)(%s)',
                        $statusCode,
                        $request->getUri(),
                        $jsonBody ? ": {$jsonBody->message}" : ''
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $responseBody
                );
            }
            return $response;
        } catch (HttpException $e) {
            throw new ApiException(
                "[{$e->getCode()}] {$e->getMessage()}",
                $e->getCode(),
                $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null,
                $e
            );
        } catch (ClientExceptionInterface $e) {
            throw new ApiException(
                "[{$e->getCode()}] {$e->getMessage()}",
                $e->getCode(),
                null,
                null,
                $e
            );
        }
    }

    protected function check($key, $value)
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

    private function request($payload, $uriPath, $queryParams, $method, $timeout = null): ResponseInterface
    {
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $request = $this->createRequest($method, $uriPath, $payload, $headers, $queryParams);

        // TODO remove
        $options = [
            'headers' => [
                'Authorization' => "Token {$this->options['token']}",
                'User-Agent' => 'influxdb-client-php/' . \InfluxDB2\Client::VERSION,
                'Content-Type' => 'application/json'
            ],
            'query' => $queryParams,
            'body' => $payload,
            'timeout' => $timeout ?? $this->timeout
        ];

        return $this->sendRequest($request);
    }

    /**
     * Log the message with required severity.
     *
     * @param string $level LOG level
     * @param string $message Message to log
     * @param array $options Client options with logFile.
     * @return void
     */
    public static function log(string $level, string $message, array $options): void
    {
        $logDate = date('H:i:s d-M-Y');
        file_put_contents($options["logFile"] ?? "php://output", "[$logDate]: [$level] - $message" . PHP_EOL, FILE_APPEND);
    }

    /**
     * Log HTTP headers.
     *
     * @param MessageInterface $message HTTP request or response.
     * @param string $prefix LOG prefix
     * @return void
     */
    private function headers(MessageInterface $message, string $prefix): void
    {
        foreach ($message->getHeaders() as $key => $values) {
            $value = implode(', ', $values);
            if (strcasecmp($key, 'Authorization') == 0) {
                $value = '***';
            }
            DefaultApi::log("DEBUG", $prefix . " $key: " . $value, $this->options);
        }
        DefaultApi::log("DEBUG", $prefix . " Body: " . $message->getBody(), $this->options);
        $message->getBody()->rewind();
    }
}
