<?php

namespace InfluxDB2\Drivers\Curl;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use InfluxDB2\ApiException;
use InfluxDB2\DefaultApi;

class CurlApi extends DefaultApi
{
    protected $client;

    protected $base_uri;

    protected $verify_ssl;

    protected function setUpClient()
    {
        $this->client = curl_init();
        $this->base_uri = $this->options['url'];
        $this->verify_ssl = $this->options['verifySSL'] ?? true;
    }

    public function __destruct()
    {
        curl_close($this->client);
    }

    protected function request($payload, $uriPath, $queryParams, $method, $timeout = self::DEFAULT_TIMEOUT, bool $stream = false): string
    {
        curl_setopt_array($this->client, [
            CURLOPT_RETURNTRANSFER => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_POST => !is_null($payload),
            CURLOPT_CONNECTTIMEOUT => $timeout,
            CURLOPT_SSL_VERIFYPEER => $this->verify_ssl,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_URL => $this->base_uri . $uriPath . '?' . http_build_query($queryParams),
            CURLOPT_HTTPHEADER => [
                "Authorization: Token {$this->options['token']}",
                'User-Agent: influxdb-client-php/' . \InfluxDB2\Client::VERSION,
                'Content-Type: application/json'
            ],
        ]);

        if ($payload !== null)
        {
            curl_setopt($this->client, CURLOPT_POSTFIELDS, $payload);
        }

        if (array_key_exists("debug", $this->options)) {
            curl_setopt($this->client, CURLOPT_VERBOSE, true);
        }

        //execute post call
        $response = curl_exec($this->client);

        $errno      = curl_errno($this->client);
        $info       = curl_getinfo($this->client);
        $statusCode = curl_getinfo($this->client,  CURLINFO_RESPONSE_CODE);

        if ($errno !== CURLE_OK)
        {
            $message = curl_error($this->client);
            throw new ApiException(
                "[{$errno}] {$message}",
                $errno,
                is_string($response) ? $info['request_header'] : null,
                is_string($response) ? $response : null
            );
        }

        if ($statusCode < 200 || $statusCode > 299) {
            throw new ApiException(
                sprintf(
                    '[%d] Error connecting to the API (%s)',
                    $statusCode,
                    $uriPath
                ),
                $statusCode,
                $info['request_header'],
                $response
            );
        }

        return $response;
    }
}
