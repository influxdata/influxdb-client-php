<?php

namespace InfluxDB2\Drivers\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use InfluxDB2\ApiException;

trait GuzzleApiTrait
{
    protected function setUpClient()
    {
        $this->http = new Client([
                         'base_uri' => $this->options['url'],
                         'timeout' => self::DEFAULT_TIMEOUT,
                         'verify' => $this->options['verifySSL'] ?? true,
                         'headers' => [
                             'Authorization' => "Token {$this->options['token']}"
                         ],
                     ]);
    }

    protected function request($payload, $uriPath, $queryParams, $method, $timeout = self::DEFAULT_TIMEOUT, bool $stream = false): string
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
                'stream' => $stream,
                'timeout' => $timeout
            ];

            // enable debug
            if (array_key_exists("debug", $this->options)) {
                $options['debug'] = $this->options["debug"];
            }

            //execute post call
            $response = $this->http->request($method, $uriPath, $options);

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
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            throw new ApiException(
                "[{$e->getCode()}] {$e->getMessage()}",
                $e->getCode(),
                $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null,
                $e
            );
        } catch (TransferException $e) {
            throw new ApiException(
                "[{$e->getCode()}] {$e->getMessage()}",
                $e->getCode(),
                null,
                null,
                $e
            );
        }
    }
}
