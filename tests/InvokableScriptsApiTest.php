<?php

namespace InfluxDB2Test;

use InfluxDB2\InvokableScriptsApi;

require_once('BasicTest.php');

/**
 * Class InvokableScriptsApiTest
 * @package InfluxDB2Test
 */
class InvokableScriptsApiTest extends BasicTest
{
    public function testCreateInstance(): void
    {
        $invokableScriptsApi = $this->client->createInvokableScriptsApi();

        self::assertInstanceOf(InvokableScriptsApi::class, $invokableScriptsApi);
    }
}
