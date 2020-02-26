<?php

namespace InfluxDB2;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;

class DefaultApi
{
    const DEFAULT_TIMEOUT = 10;
    public $options;

    /**
     * DefaultApi constructor.
     * @param $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
        if (!array_key_exists("debug", $options)) {
            $this->options["debug"] = false;
        }
    }

    /**
     * @param $payload
     * @param $uriPath
     * @param $queryParams
     * @param $limit
     */
    public function post($payload, $uriPath, $queryParams, $limit = self::DEFAULT_TIMEOUT)
    {
        $http = new Client([
            'base_uri' => $this->options["url"],
            'timeout' => self::DEFAULT_TIMEOUT
        ]);

        try {
            $options = [
                'headers' => [
                    'Authorization' => "Token {$this->options['token']}",
                ],
                'query' => $queryParams,
                'body' => $payload,
            ];

            // enable debug
            if (array_key_exists("debug", $this->options)) {
                $options['debug'] = $this->options["debug"];
            }

            //execute post call
            $response = $http->post($uriPath, $options);

        } catch (RequestException $e) {
            throw new ApiException(
                "[{$e->getCode()}] {$e->getMessage()}",
                $e->getCode(),
                $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
            );
        }

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

    }

    function check($key, $value)
    {
        if ($value == null) {
            throw new InvalidArgumentException("The '${key}' should be defined as argument or default option: {$this->options}");
        }
    }
}

