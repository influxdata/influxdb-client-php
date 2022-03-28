<?php

namespace InfluxDB2;

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
}
