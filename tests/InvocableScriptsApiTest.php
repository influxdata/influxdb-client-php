<?php

namespace InfluxDB2Test;

require_once('BasicTest.php');

/**
 * Class InvocableScriptsApiTest
 * @package InfluxDB2Test
 */
class InvocableScriptsApiTest extends BasicTest
{
    public function testCreateInstance()
    {
        $invocableScriptsApi = $this->client->createInvocableScriptsApi();

        $this->assertNotNull($invocableScriptsApi);
    }
}
