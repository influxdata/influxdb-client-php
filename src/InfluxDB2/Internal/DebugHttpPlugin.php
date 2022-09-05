<?php

namespace InfluxDB2\Internal;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use InfluxDB2\DefaultApi;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DebugHttpPlugin implements Plugin
{
    private $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        // -> Request
        DefaultApi::log("DEBUG", "-> "
            . $request->getMethod()
            . " "
            . $request->getUri(), $this->options);
        $this->headers($request, "->");

        return $next($request)->then(function (ResponseInterface $response) {
            // <- Response
            DefaultApi::log("DEBUG", "<- HTTP/"
                . $response->getProtocolVersion()
                . " "
                . $response->getStatusCode()
                . " "
                . $response->getReasonPhrase(), $this->options);
            $this->headers($response, "<-");
            return $response;
        });
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
