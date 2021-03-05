<?php

namespace InfluxDB2;

use InfluxDB2\Model\Dialect;
use InfluxDB2\Model\Query;

class QueryApi
{
    private $DEFAULT_DIALECT;

    private $api;
    private $options;

    /**
     * QueryApi constructor.
     *
     * @param array      $options
     * @param DefaultApi $defaultApi
     */
    public function __construct(array $options, DefaultApi $defaultApi)
    {
        $this->api = $defaultApi;
        $this->options = $options;

        $this->DEFAULT_DIALECT = new Dialect([
            'header' => true,
            'delimiter' => ',',
            'comment_prefix' => '#',
            'annotations' => ['datatype', 'group', 'default']
        ]);
    }

    /**
     *
     * @param string $query query the flux query to execute. The data could be represent by string, Query
     * @param null $org specifies the source organization
     * @param null $dialect csv dialect
     * @return string
     */
    public function queryRaw(string $query, $org = null, $dialect = null): ?string
    {
        $result = $this->postQuery($query, $org, $dialect ?: $this->DEFAULT_DIALECT);

        if ($result == null) {
            return null;
        }

        return $result;
    }

    /**
     * @param $query
     * @param $org
     * @param $dialect
     * @return FluxTable[]
     */
    public function query($query, $org = null, $dialect = null): ?array
    {
        $response = $this->postQuery($query, $org, $dialect ?: $this->DEFAULT_DIALECT);

        if ($response == null) {
            return null;
        }

        $parser = new FluxCsvParser($response);
        $parser->parse();

        return $parser->tables;
    }

    /**
     * @param $query
     * @param $org
     * @param $dialect
     * @return FluxCsvParser generator
     */
    public function queryStream($query, $org = null, $dialect = null): ?FluxCsvParser
    {
        $response = $this->postQuery($query, $org, $dialect ?: $this->DEFAULT_DIALECT);

        if ($response == null) {
            return null;
        }

        return new FluxCsvParser($response, true);
    }

    private function postQuery($query, $org, $dialect): ?string
    {
        $orgParam = $org ?: $this->options["org"];
        $this->api->check("org", $orgParam);

        $payload = $this->generatePayload($query, $dialect);
        $queryParams = ["org" => $orgParam];

        if ($payload == null) {
            return null;
        }

        return $this->api->post($payload->__toString(), "/api/v2/query", $queryParams);
    }

    private function generatePayload($query, $dialect): ?Query
    {
        if ((!isset($query) || trim($query) === '')) {
            return null;
        }

        if ($query instanceof Query) {
            return $query;
        }
        return new Query([
            'query' => $query,
            'dialect' => $dialect,
            'type' => null
        ]);
    }
}
