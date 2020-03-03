<?php

namespace InfluxDB2Test;

use GuzzleHttp\Psr7\Response;

require_once('BasicTest.php');

class DefaultApiTest extends BasicTest
{
    public function testUserAgent()
    {
        $this->mockHandler->append(new Response(204));
        $this->writeApi->write('h2o,location=west value=33i 15');

        $request = $this->mockHandler->getLastRequest();

        $this->assertStringStartsWith('influxdb-client-php/',
            strval($request->getHeader("User-Agent")[0]));
    }
}
