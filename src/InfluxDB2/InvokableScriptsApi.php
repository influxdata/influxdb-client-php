<?php

namespace InfluxDB2;

use InfluxDB2\Model\Script;
use InfluxDB2\Model\ScriptCreateRequest;
use InfluxDB2\Model\ScriptInvocationParams;
use InfluxDB2\Model\ScriptUpdateRequest;
use InfluxDB2\Service\InvokableScriptsService;
use Psr\Http\Message\StreamInterface;

/**
 * Use API invokable scripts to create custom InfluxDB API endpoints that query, process, and shape data.
 *
 * API invokable scripts let you assign scripts to API endpoints and then execute them as standard REST operations
 * in InfluxDB Cloud.
 *
 * @package InfluxDB2
 */
class InvokableScriptsApi extends DefaultApi
{
    private $service;

    /**
     * InvokableScriptsApi constructor.
     *
     * @param array $options default array options
     * @param InvokableScriptsService $service HTTP API for Invokable Scripts
     */
    public function __construct(array $options, InvokableScriptsService $service)
    {
        parent::__construct($options);
        $this->service = $service;
    }

    /**
     * Create a script.
     *
     * @param ScriptCreateRequest $createRequest The script to create.
     * @return Script The created script.
     */
    public function createScript(ScriptCreateRequest $createRequest): Script
    {
        return $this->service->postScripts($createRequest);
    }

    /**
     * Update a script.
     *
     * @param string $scriptId The ID of the script to update. (required)
     * @param ScriptUpdateRequest $updateRequest Script updates to apply (required)
     * @return Script The updated script.
     */
    public function updateScript(string $scriptId, ScriptUpdateRequest $updateRequest): Script
    {
        return $this->service->patchScriptsID($scriptId, $updateRequest);
    }

    /**
     * Delete a script.
     *
     * @param string $scriptId The ID of the script to delete. (required)
     * @return void
     */
    public function deleteScript(string $scriptId)
    {
        $this->service->deleteScriptsID($scriptId);
    }

    /**
     * List scripts.
     *
     * @param int|null $limit The number of scripts to return.
     * @param int|null $offset The offset for pagination.
     *
     * @return Script[]
     */
    public function findScripts(int $limit = null, int $offset = null): array
    {
        return $this->service->getScripts($limit, $offset)->getScripts();
    }

    /**
     * Invoke synchronously a script and return result as a FluxTable[].
     *
     * @param string $scriptId The ID of the script to invoke. (required)
     * @param array<string,object>|null $params Represent key/value pairs parameters to be injected into script
     * @return FluxTable[]
     */
    public function invokeScript(string $scriptId, array $params = null): ?array
    {
        $response = $this->invokeScriptRaw($scriptId, $params);

        $parser = new FluxCsvParser($response, false, 'only_names');
        $parser->parse();

        return $parser->tables;
    }

    /**
     * Invoke synchronously a script and return result as a stream of FluxRecord.
     *
     * @param string $scriptId The ID of the script to invoke. (required)
     * @param array<string,object>|null $params Represent key/value pairs parameters to be injected into script
     * @return FluxCsvParser generator of FluxRecords
     */
    public function invokeScriptStream(string $scriptId, array $params = null): FluxCsvParser
    {
        $invocation_params = new ScriptInvocationParams();
        $invocation_params->setParams($params);

        $response = $this->_invokeScript($invocation_params, $scriptId);

        return new FluxCsvParser($response, true, 'only_names');
    }

    /**
     * Invoke synchronously a script and return result as a String.
     *
     * @param string $scriptId The ID of the script to invoke. (required)
     * @param array|null $params Represent key/value pairs parameters to be injected into script
     * @return string
     */
    public function invokeScriptRaw(string $scriptId, array $params = null): ?string
    {
        $invocation_params = new ScriptInvocationParams();
        $invocation_params->setParams($params);

        $response = $this->_invokeScript($invocation_params, $scriptId);

        return $response->getContents();
    }

    private function _invokeScript(ScriptInvocationParams $invocation_params, string $scriptId): StreamInterface
    {
        return $this->post($invocation_params->__toString(), "/api/v2/scripts/{$scriptId}/invoke", [])->getBody();
    }
}
