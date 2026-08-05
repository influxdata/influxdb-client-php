<?php

namespace InfluxDB2Test;

use DateInterval;
use DateTime;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\FluxTable;
use InfluxDB2\Model\Query;

require_once('BasicTest.php');

/**
 * Class QueryApiTest
 * @package InfluxDB2Test
 */
class QueryApiTest extends BasicTest
{
    private const SUCCESS_DATA =
        "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,dateTime:RFC3339,long,string,string,string,string\n"
        . "#group,false,false,false,false,false,false,false,false,false,true\n" . "#default,_result,,,,,,,,,\n"
        . ",result,table,_start,_stop,_time,_value,_field,_measurement,host,region\n"
        . ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,west\n"
        . ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,20,free,mem,B,west\n"
        . ",,0,1970-01-01T00:00:20Z,1970-01-01T00:00:30Z,1970-01-01T00:00:20Z,11,free,mem,A,west\n"
        . ",,0,1970-01-01T00:00:20Z,1970-01-01T00:00:30Z,1970-01-01T00:00:20Z,22,free,mem,B,west";

    public function testQueryRaw(): void
    {
        $this->mockHandler->append(new Response(204, [], QueryApiTest::SUCCESS_DATA));

        $result = $this->queryApi->queryRaw(
            'from(bucket:"my-bucket") |> range(start: 1970-01-01T00:00:00.000000001Z) |> last()'
        );

        self::assertEquals(QueryApiTest::SUCCESS_DATA, $result);
    }

    public function testQuery(): void
    {
        $this->mockHandler->append(new Response(204, [], QueryApiTest::SUCCESS_DATA));

        $bucket = 'my-bucket';
        $result = $this->queryApi->query('from(bucket:"' . $bucket
            . '") |> range(start: 1970-01-01T00:00:00.000000001Z) |> last()');

        self::assertCount(1, $result);
        self::assertCount(4, $result[0]->records);

        $record = $result[0]->records[0];

        self::assertEquals('1970-01-01T00:00:10Z', $record->getTime());
        self::assertEquals('mem', $record->getMeasurement());
        self::assertEquals(10, $record->getValue());
        self::assertEquals('free', $record->getField());
    }

    public function testQueryParameterized(): void
    {
        $this->mockHandler->append(new Response(204, [], QueryApiTest::SUCCESS_DATA));
        $q = new Query();

        $q->setQuery('from(bucket: params.bucketParam) |> range(start: time(v: params.startParam)) |> last()');

        $today = new DateTime("2021-12-15T11:33:28+00:00");
        $yesterday = $today->sub(new DateInterval("P1D"));

        $q->setParams([
            "bucketParam" => "my-bucket",
            "startParam" => $yesterday
        ]);

        $result = $this->queryApi->query($q);
        $contents = $this->mockHandler->getLastRequest()->getBody()->getContents();
        $json = json_decode($contents, true);

        self::assertEquals("my-bucket", $json["params"]["bucketParam"]);
        self::assertEquals('2021-12-14T11:33:28+00:00', $json["params"]["startParam"]);

        self::assertCount(1, $result);
        self::assertCount(4, $result[0]->records);

        $record = $result[0]->records[0];

        self::assertEquals('1970-01-01T00:00:10Z', $record->getTime());
        self::assertEquals('mem', $record->getMeasurement());
        self::assertEquals(10, $record->getValue());
        self::assertEquals('free', $record->getField());
    }

    public function testQueryRawEmptyData(): void
    {
        $result = $this->queryApi->queryRaw('');

        self::assertNull($result);
    }

    public function testQueryEmptyData(): void
    {
        $result = $this->queryApi->query(null);

        self::assertNull($result);
    }
}
