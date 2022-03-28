<?php

namespace InfluxDB2;

use InfluxDB2\Model\Script;
use InfluxDB2\Model\ScriptCreateRequest;
use InfluxDB2\Model\ScriptUpdateRequest;
use InfluxDB2\Service\InvocableScriptsService;

/**
 * Use API invokable scripts to create custom InfluxDB API endpoints that query, process, and shape data.
 *
 * API invokable scripts let you assign scripts to API endpoints and then execute them as standard REST operations
 * in InfluxDB Cloud.
 *
 * @package InfluxDB2
 */
class InvocableScriptsApi
{
    private $service;

    /**
     * InvocableScriptsApi constructor.
     * @param InvocableScriptsService $service HTTP API for Invocable Scripts
     */
    public function __construct(InvocableScriptsService $service)
    {
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
}
