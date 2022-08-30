<?php

namespace InfluxDB2;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\RedirectMiddleware;
use Http\Discovery\Psr17FactoryDiscovery;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
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
     * @var Client
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
        $handler = HandlerStack::create();

        if ($this->options['debug'] ?? false) {
            $handler->push(Middleware::mapRequest(function (RequestInterface $request) {
                DefaultApi::log("DEBUG", "-> "
                    . $request->getMethod()
                    . " "
                    . $request->getUri(), $this->options);
                $this->headers($request, "->");
                return $request;
            }));
            $handler->push(Middleware::mapResponse(function (ResponseInterface $response) {
                DefaultApi::log("DEBUG", "<- HTTP/"
                    . $response->getProtocolVersion()
                    . " "
                    . $response->getStatusCode()
                    . " "
                    . $response->getReasonPhrase(), $this->options);
                $this->headers($response, "<-");
                return $response;
            }));
        }

        $this->http = new Client([
            'base_uri' => $this->options['url'],
            'timeout' => $this->timeout,
            'verify' => $this->options['verifySSL'] ?? true,
            'headers' => [
                'Authorization' => "Token {$this->options['token']}"
            ],
            'proxy' => $this->options['proxy'] ?? null,
            'allow_redirects' => $this->options['allow_redirects'] ?? RedirectMiddleware::$defaultSettings,
            'handler' => $handler
        ]);

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

    private function request($payload, $uriPath, $queryParams, $method, $timeout = null): ResponseInterface
    {
        try {
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

            //execute HTTP call
            $request = $this->requestFactory->createRequest($method, $uriPath);
            $request = $request->withBody($this->streamFactory->createStream($payload));
            $request = $request->withAddedHeader('Authorization', "Token {$this->options['token']}");
            $request = $request->withAddedHeader('User-Agent', 'influxdb-client-php/' . \InfluxDB2\Client::VERSION);
            $request = $request->withAddedHeader('Content-Type', 'application/json');
            $uri = $request->getUri()->withQuery(http_build_query($queryParams, '', '&', PHP_QUERY_RFC3986));
            $request = $request->withUri($uri);
            // TODO timeout
            $response = $this->http->sendRequest($request);

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $uriPath
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }
            return $response;
        } catch (RequestException $e) {
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
