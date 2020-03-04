<?php

namespace InfluxDB2Test;

use InfluxDB2\FluxCsvParser;
use InfluxDB2\FluxRecord;
use PHPUnit\Framework\TestCase;

class FluxTableTest extends TestCase
{
    public function testMultipleValues()
    {

        $data = "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,string,string,string,string,long,long,string\n" .
            "#group,false,false,true,true,true,true,true,true,false,false,false\n" .
            "#default,_result,,,,,,,,,,\n" .
            ",result,table,_start,_stop,_field,_measurement,host,region,_value2,value1,value_str\n" .
            ",,0,1677-09-21T00:12:43.145224192Z,2018-07-16T11:21:02.547596934Z,free,mem,A,west,121,11,test\n" .
            ",,1,1677-09-21T00:12:43.145224192Z,2018-07-16T11:21:02.547596934Z,free,mem,B,west,484,22,test\n" .
            ",,2,1677-09-21T00:12:43.145224192Z,2018-07-16T11:21:02.547596934Z,usage_system,cpu,A,west,1444,38,test\n" .
            ',,3,1677-09-21T00:12:43.145224192Z,2018-07-16T11:21:02.547596934Z,user_usage,cpu,A,west,2401,49,test';

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;
        $columnHeaders = $tables[0]->columns;

        $this->assertEquals(11, sizeof($columnHeaders));
        $values = [false, false, true, true, true, true, true, true, false, false, false];
        $this->assertColumns($columnHeaders, $values);
        $this->assertEquals(4, sizeof($tables));

        $this->assertMultipleRecords($tables);
    }

    public function testParseShortCut()
    {
        $data = '#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,' .
            "dateTime:RFC3339,long,string,string,string,boolean\n" .
            "#group,false,false,false,false,false,false,false,false,false,true\n" .
            "#default,_result,,,,,,,,,true\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,true\n";

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;

        $this->assertEquals(1, sizeof($tables));
        $this->assertEquals(1, sizeof($tables[0]->records));

        $record = $tables[0]->records[0];
        $this->assertEquals($this->parseTime('1970-01-01T00:00:10Z'), $record->getStart());
        $this->assertEquals($this->parseTime('1970-01-01T00:00:20Z'), $record->getStop());
        $this->assertEquals($this->parseTime('1970-01-01T00:00:10Z'), $record->getTime());

        $this->assertEquals(10, sizeof($record->values));
        $this->assertEquals("free", $record->getField());
        $this->assertEquals("mem", $record->getMeasurement());

    }

    public function testMappingBoolean()
    {
        $data = '#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,' .
            "dateTime:RFC3339,long,string,string,string,boolean\n" .
            "#group,false,false,false,false,false,false,false,false,false,true\n" .
            "#default,_result,,,,,,,,,true\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,true\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,false\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,x\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,\n";

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;

        $this->assertEquals(1, sizeof($tables));
        $this->assertEquals(4, sizeof($tables[0]->records));

        $records = $tables[0]->records;

        $this->assertEquals(true, $records[0]->values['value']);
        $this->assertEquals(false, $records[1]->values['value']);
        $this->assertEquals(false, $records[2]->values['value']);
        $this->assertEquals(true, $records[3]->values['value']);
    }

    /**
     * TODO - PHP supports only signed 64bit integers
     */
    public function testMappingUnsignedLong()
    {

        $data = '#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,' .
            "dateTime:RFC3339,long,string,string,string,unsignedLong\n" .
            "#group,false,false,false,false,false,false,false,false,false,true\n" .
            "#default,_result,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,17916881237904312345\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,\n";

        //TODO this does not work due "overflow"
        $expected = intval("17916881237904312345");

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;

        $records = $tables[0]->records;
        $this->assertEquals($expected, $records[0]->values['value']);
        $this->assertNull($records[1]->values['value']);
    }

    private function assertColumns(array $columnHeaders, array $values)
    {
        $i = 0;
        foreach ($values as $value) {
            $this->assertEquals($value, $columnHeaders[$i]->group, "column assert '" . $columnHeaders[$i]->label . "'");
            $i++;
        }
    }

    private function assertMultipleRecords(array $tables)
    {
        #Record 1
        $tableRecords = $tables[0]->records;
        $this->assertEquals(1, sizeof($tableRecords));

        $values = ['table' => 0, 'host' => 'A', 'region' => 'west', 'value1' => 11, '_value2' => 121,
            'value_str' => 'test'];

        $this->assertRecord($tableRecords[0], $values, 11);

        #Record 2
        $tableRecords = $tables[1]->records;
        $this->assertEquals(1, sizeof($tableRecords));

        $values = ['table' => 1, 'host' => 'B', 'region' => 'west', 'value1' => 22, '_value2' => 484,
            'value_str' => 'test'];

        $this->assertRecord($tableRecords[0], $values, 11);

        #Record 3
        $tableRecords = $tables[2]->records;
        $this->assertEquals(1, sizeof($tableRecords));

        $values = ['table' => 2, 'host' => 'A', 'region' => 'west', 'value1' => 38, '_value2' => 1444,
            'value_str' => 'test'];

        $this->assertRecord($tableRecords[0], $values, 11);

        #Record 4
        $tableRecords = $tables[3]->records;
        $this->assertEquals(1, sizeof($tableRecords));

        $values = ['table' => 3, 'host' => 'A', 'region' => 'west', 'value1' => 49, '_value2' => 2401,
            'value_str' => 'test'];

        $this->assertRecord($tableRecords[0], $values, 11);

    }

    private function assertRecord(FluxRecord $fluxRecord, array $values, $size = 0, $value = null)
    {

        foreach ($values as $key => $val) {
            $this->assertEquals($values[$key], $fluxRecord->values[$key]);
        }

        if ($value == null) {
            $this->assertNull($value);
        } else {
            $this->assertEquals($value, $fluxRecord->getValue());
        }
        $this->assertEquals($size, sizeof($fluxRecord->values));
    }

    private function parseTime(string $timestamp)
    {
        //TODO datetime parsing
        return $timestamp;
    }

}
