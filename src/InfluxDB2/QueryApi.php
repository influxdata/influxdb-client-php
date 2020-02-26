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
     * @param $query  query the flux query to execute. The data could be represent by string, Query
     * @param null $org specifies the source organization
     * @param null $dialect csv dialect
     * @return string
     */
    public function queryRaw(string $query, $org = null, $dialect = null): string
    {
        return $this->postQuery($query, $org, $dialect ?: $this->DEFAULT_DIALECT)->getBody()->getContents();
    }


    private function postQuery($query, $org, $dialect): ResponseInterface
    {
        $orgParam = $org ?: $this->options["org"];
        $this->check("org", $orgParam);

        $payload = $this-> generatePayload($query, $dialect);
        $queryParams = ["org" => $orgParam];

        return $this->post($payload->__toString(), "/api/v2/query",$queryParams);
    }

    private function generatePayload($query, $dialect)
    {
        if ($query == null) {
            return null;
        }

        if ($query instanceof Query) {
            return $query;
        }
        return new Query([
            'query'=>$query,
            'dialect'=>$dialect,
            'type'=>null
        ]);
    }

}

