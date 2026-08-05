<?php

namespace InfluxDB2;

use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\Exception\HttpException;
use Http\Discovery\ClassDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use InfluxDB2\Internal\DebugHttpPlugin;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class DefaultApi
{
    public ClientOptions $options;
    public ClientInterface $http;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;
    private UriFactoryInterface $uriFactory;

    /**
     * DefaultApi constructor.
     * @param ClientOptions $options
     */
    public function __construct(ClientOptions $options)
    {
        $this->options = $options;

        $guzzleHttp = "GuzzleHttp\Client";
        if ($this->options->httpClient instanceof ClientInterface) {
            $client = $this->options->httpClient;
        } elseif (ClassDiscovery::safeClassExists($guzzleHttp)) {
            $client = new $guzzleHttp([
                'timeout' => $this->options->timeout ?? 10,
                'verify' => $this->options->verifySSL ?? true,
                'proxy' => $this->options->proxy ?? null
            ]);
        } else {
            $client = Psr18ClientDiscovery::find();
        }
        $this->http = $this->configuredClient($client);

        $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        $this->uriFactory = Psr17FactoryDiscovery::findUriFactory();
    }

    /**
     * @param string $payload String content with which to populate the stream.
     * @param string $uriPath The URI associated with the request.
     * @param array<string, string> $queryParams The query string to use with the new instance.
     * @return ResponseInterface
     */
    public function post(string $payload, string $uriPath, array $queryParams): ResponseInterface
    {
        return $this->request($payload, $uriPath, $queryParams, 'POST');
    }

    /**
     * @param string $payload String content with which to populate the stream.
     * @param string $uriPath The URI associated with the request.
     * @param array<string, string> $queryParams The query string to use with the new instance.
     * @return ResponseInterface
     */
    public function get(string $payload, string $uriPath, array $queryParams): ResponseInterface
    {
        return $this->request($payload, $uriPath, $queryParams, 'GET');
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
                'User-Agent' => 'influxdb-client-php/' . Client::VERSION,
                'Authorization' => "Token {$this->options->token}",
            ]),
        ];

        $allow_redirects = $this->options->allowRedirects ?? true;
        if ($allow_redirects !== false) {
            $plugins[] = new Plugin\RedirectPlugin(is_array($allow_redirects) ? $allow_redirects : []);
        }
        if ($this->options->debug ?? false) {
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
        $uri = $this->uriFactory
            ->createUri($this->options->url)
            ->withPath($uriPath)
            ->withQuery(http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986));
        $request = $this->requestFactory->createRequest($method, $uri);
        $request = $request->withBody($this->streamFactory->createStream($payload));
        foreach ($headers as $header => $value) {
            $request = $request->withAddedHeader($header, $value);
        }
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
            // execute HTTP call
            $response = $this->http->sendRequest($request);

            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                $responseBody = $response->getBody()->getContents();
                $jsonBody = json_decode($responseBody);
                $errorMessage = $responseBody;
                if (isset($jsonBody->message)) {
                    $errorMessage = $jsonBody->message;
                }
                if (isset($jsonBody->error)) {
                    $errorMessage = $jsonBody->error;
                }
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)(%s)',
                        $statusCode,
                        $request->getUri(),
                        $errorMessage
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
                $e->getResponse() instanceof ResponseInterface ? $e->getResponse()->getHeaders() : null,
                $e->getResponse() instanceof ResponseInterface ? $e->getResponse()->getBody()->getContents() : null,
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

    protected function check(string $key, $value): void
    {
        $optionsArray = $this->options->toArray();
        if (!isset($value) || trim($value) === '') {
            $options = implode(', ', array_map(
                function ($v, $k) {
                    if (is_array($v)) {
                        return $k . '[]=' . implode('&' . $k . '[]=', $v);
                    } else {
                        return $k . '=' . $v;
                    }
                },
                $optionsArray,
                array_keys($optionsArray)
            ));
            throw new InvalidArgumentException("The '{$key}' should be defined as argument or default option: {$options}");
        }
    }

    /**
     * @param string $payload String content with which to populate the stream.
     * @param string $uriPath The URI associated with the request.
     * @param array<string, string> $queryParams The query string to use with the new instance.
     * @param string $method The HTTP method associated with the request.
     * @return ResponseInterface
     */
    private function request(string $payload, string $uriPath, array $queryParams, string $method): ResponseInterface
    {
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $request = $this->createRequest($method, $uriPath, $payload, $headers, $queryParams);

        return $this->sendRequest($request);
    }

    /**
     * Log the message with required severity.
     *
     * @param string $level LOG level
     * @param string $message Message to log
     * @param ClientOptions|null $options Client options with logFile.
     * @return void
     */
    public static function log(string $level, string $message, ?ClientOptions $options): void
    {
        $logDate = date('H:i:s d-M-Y');
        $logFileName = ($options instanceof ClientOptions) ? $options->logFile : null;
        file_put_contents($logFileName ?? "php://output", "[$logDate]: [$level] - $message" . PHP_EOL, FILE_APPEND);
    }
}
