<?php

namespace InfluxDB2;

use InfluxDB2\Model\Dialect;
use InfluxDB2\Model\Query;
use Psr\Http\Message\ResponseInterface;

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

        return $result->getBody()->getContents();
    }

    /**
     * @param $query
     * @param $org
     * @param $dialect
     * @return FluxTable[]
     */
    public function query($query, $org = null, $dialect = null)
    {
        $response = $this->postQuery($query, $org, $dialect ?: $this->DEFAULT_DIALECT);

        if ($response == null) {
            return null;
        }

        $parser = new FluxCsvParser($response->getBody());
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

    private function generatePayload($query, $dialect)
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
