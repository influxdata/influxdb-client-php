<?php

namespace InfluxDB2;

use InfluxDB2\Model\Dialect;
use InfluxDB2\Model\Query;
use Psr\Http\Message\ResponseInterface;

/**
 * The client of the InfluxDB 2.x that implement Query HTTP API endpoint.
 *
 * @package InfluxDB2
 */
class QueryApi extends DefaultApi
{
    private $DEFAULT_DIALECT;

    /**
     * QueryApi constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->DEFAULT_DIALECT = new Dialect([
            'header' => true,
            'delimiter' => ',',
            'comment_prefix' => '#',
            'annotations' => ['datatype', 'group', 'default']
        ]);
    }

    /**
     * Executes the Flux query and returns the unparsed raw result
     *
     * @param string|Query $query flux query to execute. The data could be represent by string, Query
     * @param string|null $org specifies the source organization
     * @param Dialect|null $dialect csv dialect
     * @return string
     */
    public function queryRaw($query, ?string $org = null, ?Dialect $dialect = null): ?string
    {
        $result = $this->postQuery($query, $org, $dialect ?: $this->DEFAULT_DIALECT);

        if ($result == null) {
            return null;
        }

        return $result->getBody()->getContents();
    }

    /**
     * Executes the Flux query against the InfluxDB 2.x and synchronously map the whole response to FluxTable[]
     * NOTE: This method is not intended for large query results.
     *
     * @param string|Query $query
     * @param string|null $org
     * @param Dialect|null $dialect
     * @return  FluxTable[]
     */
    public function query($query, ?string $org = null, ?Dialect $dialect = null): ?array
    {
        if ($query instanceof Query) {
            $query->setDialect($this->DEFAULT_DIALECT);
        }

        $response = $this->postQuery($query, $org, $dialect ?: $this->DEFAULT_DIALECT);

        if ($response == null) {
            return null;
        }

        $parser = new FluxCsvParser($response->getBody());
        $parser->parse();

        return $parser->tables;
    }

    /**
     * Executes the Flux query against the InfluxDB 2.x and returns generator to stream the result.
     *
     * @param string| Query $query
     * @param string|null $org
     * @param Dialect|null $dialect
     *
     * @return FluxCsvParser generator
     */
    public function queryStream($query, ?string $org = null, ?Dialect $dialect = null): ?FluxCsvParser
    {
        if ($query instanceof Query) {
            $query->setDialect($this->DEFAULT_DIALECT);
        }

        $response = $this->postQuery($query, $org, $dialect ?: $this->DEFAULT_DIALECT);

        if ($response == null) {
            return null;
        }

        return new FluxCsvParser($response->getBody(), true);
    }

    private function postQuery($query, $org, $dialect): ?ResponseInterface
    {
        $orgParam = $org ?: $this->options["org"];
        $this->check("org", $orgParam);

        $payload = $this->generatePayload($query, $dialect);
        $queryParams = ["org" => $orgParam];

        if ($payload == null) {
            return null;
        }

        return $this->post($payload->__toString(), "/api/v2/query", $queryParams);
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
