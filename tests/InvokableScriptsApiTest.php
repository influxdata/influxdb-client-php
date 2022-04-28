<?php

namespace InfluxDB2Test;

require_once('BasicTest.php');

/**
 * Class InvokableScriptsApiTest
 * @package InfluxDB2Test
 */
class InvokableScriptsApiTest extends BasicTest
{
    public function testCreateInstance()
    {
        $invokableScriptsApi = $this->client->createInvokableScriptsApi();

        $this->assertNotNull($invokableScriptsApi);
    }
}
