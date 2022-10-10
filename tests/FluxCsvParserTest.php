<?php

namespace InfluxDB2Test;

use Exception;
use InfluxDB2\FluxCsvParser;
use InfluxDB2\FluxCsvParserException;
use InfluxDB2\FluxQueryError;
use InfluxDB2\FluxRecord;
use PHPUnit\Framework\TestCase;

class FluxCsvParserTest extends TestCase
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

    public function testMappingDouble()
    {
        $data = '#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,' .
            "dateTime:RFC3339,long,string,string,string,double\n" .
            "#group,false,false,false,false,false,false,false,false,false,true\n" .
            "#default,_result,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,12.25\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,\n";

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;

        $records = $tables[0]->records;

        $this->assertEquals(12.25, $records[0]->values['value']);
        $this->assertNull($records[1]->values['value']);
    }

    public function testMappingBase64Binary()
    {
        $binaryData = 'test value';
        $encodedData = base64_encode($binaryData);

        $data = '#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,' .
            "dateTime:RFC3339,long,string,string,string,base64Binary\n" .
            "#group,false,false,false,false,false,false,false,false,false,true\n" .
            "#default,_result,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ',,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,' . $encodedData . "\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,\n";

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;

        $records = $tables[0]->records;

        $this->assertEquals($binaryData, $records[0]->values['value']);
        $this->assertNull($records[1]->values['value']);
    }

    public function testMappingDuration()
    {
        $data = '#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339' .
            ",dateTime:RFC3339,long,string,string,string,duration\n" .
            "#group,false,false,false,false,false,false,false,false,false,true\n" .
            "#default,_result,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,125\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,\n";

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;

        $records = $tables[0]->records;

        $this->assertEquals(125, $records[0]->values['value']);
        $this->assertNull($records[1]->values['value']);
    }

    public function testGroupKey()
    {
        $data = '#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,' .
            "dateTime:RFC3339,long,string,string,string,duration\n" .
            "#group,false,false,false,false,true,false,false,false,false,true\n" .
            "#default,_result,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,125\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,\n";

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;

        $this->assertEquals(10, count($tables[0]->columns));
        $this->assertEquals(2, count($tables[0]->getGroupKey()));
    }

    public function testUnknownTypeAsString()
    {
        $data = '#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,' .
            "dateTime:RFC3339,long,string,string,string,unknown\n" .
            "#group,false,false,false,false,false,false,false,false,false,true\n" .
            "#default,_result,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,12.25\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,\n";

        $fluxCsvParser = new FluxCsvParser($data);
        $tables = $fluxCsvParser->parse()->tables;

        $records = $tables[0]->records;

        $this->assertEquals('12.25', $records[0]->values['value']);
        $this->assertNull($records[1]->values['value']);
    }

    public function testError()
    {
        $data = "#datatype,string,string\n" .
            "#group,true,true\n" .
            "#default,,\n" .
            ",error,reference\n" .
            ',failed to create physical plan: invalid time bounds from procedure from: bounds contain zero time,897';

        $fluxCsvParser = new FluxCsvParser($data);

        try {
            $fluxCsvParser->parse();
            $this->fail();
        } catch (FluxQueryError $e) {
            $this->assertEquals(
                'failed to create physical plan: invalid time bounds from procedure from: bounds contain zero time',
                $e->getMessage()
            );
            $this->assertEquals(897, $e->getCode());
        } catch (Exception $e) {
            $this->fail();
        }
    }

    public function testErrorWithoutReference()
    {
        $data = "#datatype,string,string\n" .
            "#group,true,true\n" .
            "#default,,\n" .
            ",error,reference\n" .
            ',failed to create physical plan: invalid time bounds from procedure from: bounds contain zero time,';

        $fluxCsvParser = new FluxCsvParser($data);

        try {
            $fluxCsvParser->parse();
            $this->fail();
        } catch (FluxQueryError $e) {
            $this->assertEquals(
                'failed to create physical plan: invalid time bounds from procedure from: bounds contain zero time',
                $e->getMessage()
            );
            $this->assertEquals(0, $e->getCode());
        } catch (Exception $e) {
            $this->fail();
        }
    }

    public function testWithoutTableReference()
    {
        $data = ",result,table,_start,_stop,_time,_value,_field,_measurement,host,value\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,12.25\n" .
            ",,0,1970-01-01T00:00:10Z,1970-01-01T00:00:20Z,1970-01-01T00:00:10Z,10,free,mem,A,\n";

        $fluxCsvParser = new FluxCsvParser($data);

        try {
            $fluxCsvParser->parse();
            $this->fail();
        } catch (FluxCsvParserException $e) {
            $this->assertEquals(
                'Unable to parse CSV response. FluxTable definition was not found.',
                $e->getMessage()
            );
        } catch (Exception $e) {
            $this->fail();
        }
    }

    public function testParserErrorUndefinedOffset()
    {
        $data = "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,dateTime:RFC3339,double,string,string,string,string,string\n" .
            "#group,false,false,true,true,false,false,true,true,true,true,true\n" .
            "#default,_result,,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,channel,device_eui,sensor_eui\n" .
            ",,0,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:17:43.775791768Z,23.4,value,4097,1,2CF7F1201470029C,vs\n" .
            ",,0,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:27:45.894980937Z,22.5,value,4097,1,2CF7F1201470029C,vs\n" .
            ",,0,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:37:50.278735828Z,21.4,value,4097,1,2CF7F1201470029C,vs\n" .
            ",,0,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:47:51.766261407Z,20.3,value,4097,1,2CF7F1201470029C,vs\n" .
            ",,0,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:57:57.475875729Z,18.9,value,4097,1,2CF7F1201470029C,vs\n" .
            ",,0,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T16:07:59.413550698Z,17.8,value,4097,1,2CF7F1201470029C,vs\n" .
            "\n" .
            "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,dateTime:RFC3339,double,string,string,string,string,string\n" .
            "#group,false,false,true,true,false,false,true,true,true,true,true\n" .
            "#default,_result,,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,channel,device_eui,sensor_eui\n" .
            ",,1,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:43:49.398558429Z,12.3,value,4102,1,2CF7F12014700247,vs\n" .

            "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,dateTime:RFC3339,double,string,string,string,string,string\n" .
            "#group,false,false,true,true,false,false,true,true,true,true,true\n" .
            "#default,_result,,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,channel,device_eui,sensor_eui\n" .
            ",,2,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:17:43.772929338Z,43.1,value,4098,1,2CF7F1201470029C,vs\n" .
            ",,2,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:27:45.897608471Z,49,value,4098,1,2CF7F1201470029C,vs\n" .
            ",,2,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:37:50.27543528Z,48.2,value,4098,1,2CF7F1201470029C,vs\n" .
            ",,2,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:47:51.769665096Z,44.7,value,4098,1,2CF7F1201470029C,vs\n" .
            ",,2,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:57:57.47339818Z,48.5,value,4098,1,2CF7F1201470029C,vs\n" .
            ",,2,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T16:07:59.40946618Z,52.3,value,4098,1,2CF7F1201470029C,vs\n" .
            "\n" .
            "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,dateTime:RFC3339,double,string,string,string,string,string\n" .
            "#group,false,false,true,true,false,false,true,true,true,true,true\n" .
            "#default,_result,,,,,,,,,,\n" .
            ",result,table,_start,_stop,_time,_value,_field,_measurement,channel,device_eui,sensor_eui\n" .
            ",,3,2020-03-27T15:17:00.64917903Z,2020-03-27T16:17:00.64917903Z,2020-03-27T15:43:49.39609423Z,30.7,value,4103,1,2CF7F12014700247,vs\n";

        $parser = new FluxCsvParser($data);
        $tables = $parser->parse()->tables;

        $this->assertEquals(4, sizeof($tables));
        $this->assertEquals(6, sizeof($tables[0]->records));
        $this->assertEquals(1, sizeof($tables[1]->records));
        $this->assertEquals(6, sizeof($tables[2]->records));
        $this->assertEquals(1, sizeof($tables[3]->records));
    }

    public function testResponseWithError()
    {
        $data = "#datatype,string,long,string,string,dateTime:RFC3339,dateTime:RFC3339,dateTime:RFC3339,double,string\n" .
            "#group,false,false,true,true,true,true,false,false,true\n" .
            "#default,t1,,,,,,,,\n" .
            ",result,table,_field,_measurement,_start,_stop,_time,_value,tag\n" .
            ",,0,value,python_client_test,2010-02-27T04:48:32.752600083Z,2020-02-27T16:48:32.752600083Z,2020-02-27T16:20:00Z,2,test1\n" .
            ",,0,value,python_client_test,2010-02-27T04:48:32.752600083Z,2020-02-27T16:48:32.752600083Z,2020-02-27T16:21:40Z,2,test1\n" .
            ",,0,value,python_client_test,2010-02-27T04:48:32.752600083Z,2020-02-27T16:48:32.752600083Z,2020-02-27T16:23:20Z,2,test1\n" .
            ",,0,value,python_client_test,2010-02-27T04:48:32.752600083Z,2020-02-27T16:48:32.752600083Z,2020-02-27T16:25:00Z,2,test1\n" .
            "\n" .
            "#datatype,string,string\n" .
            "#group,true,true\n" .
            "#default,,\n" .
            ",error,reference\n" .
            ",\"engine: unknown field type for value: xyz\",";

        $fluxCsvParser = new FluxCsvParser($data);

        try {
            $fluxCsvParser->parse();
            $this->fail();
        } catch (FluxQueryError $e) {
            $this->assertEquals(
                'engine: unknown field type for value: xyz',
                $e->getMessage()
            );
            $this->assertEquals(0, $e->getCode());
        } catch (Exception $e) {
            $this->fail();
        }
    }

    public function testParseExportFromUserInterface()
    {
        $data = "#group,false,false,true,true,true,true,true,true,false,false\n" .
            "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,string,string,string,string,double,dateTime:RFC3339\n" .
            "#default,mean,,,,,,,,,\n" .
            ",result,table,_start,_stop,_field,_measurement,city,location,_value,_time\n" .
            ",,0,1754-06-26T11:30:27.613654848Z,2040-10-27T12:13:46.485Z,temperatureC,weather,London,us-midwest,30,1975-09-01T16:59:54.5Z\n" .
            ",,1,1754-06-26T11:30:27.613654848Z,2040-10-27T12:13:46.485Z,temperatureF,weather,London,us-midwest,86,1975-09-01T16:59:54.5Z\n";

        $parser = new FluxCsvParser($data);
        $tables = $parser->parse()->tables;

        $this->assertEquals(2, sizeof($tables));
        $this->assertEquals(1, sizeof($tables[0]->records));
        $this->assertFalse($tables[0]->columns[0]->group);
        $this->assertFalse($tables[0]->columns[1]->group);
        $this->assertTrue($tables[0]->columns[2]->group);
        $this->assertEquals(1, sizeof($tables[1]->records));
    }

    public function testParseWithoutDatatype()
    {
        $data = ",result,table,_start,_stop,_field,_measurement,host,region,_value2,value1,value_str\n" .
            ",,0,1677-09-21T00:12:43.145224192Z,2018-07-16T11:21:02.547596934Z,free,mem,A,west,121,11,test\n" .
            ",,1,1677-09-21T00:12:43.145224192Z,2018-07-16T11:21:02.547596934Z,free,mem,A,west,121,11,test\n";

        $parser = new FluxCsvParser($data, false, "only_names");
        $tables = $parser->parse()->tables;

        $this->assertEquals(2, sizeof($tables));
        $this->assertEquals(11, sizeof($tables[0]->columns));
        $this->assertEquals(1, sizeof($tables[0]->records));
        $this->assertEquals(11, sizeof($tables[0]->records[0]->values));
        $this->assertEquals("0", $tables[0]->records[0]->values['table']);
        $this->assertEquals("11", $tables[0]->records[0]->values['value1']);
        $this->assertEquals("west", $tables[0]->records[0]->values['region']);
    }

    public function testRecordDoesntContainsKey()
    {
        $data = "#group,false,false,true,true,true,true,true,true,false,false\n" .
            "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,string,string,string,string,double,dateTime:RFC3339\n" .
            "#default,mean,,,,,,,,,\n" .
            ",result,table,_start,_stop,_field,_measurement,city,location,value,_time\n" .
            ",,0,1754-06-26T11:30:27.613654848Z,2040-10-27T12:13:46.485Z,temperatureC,weather,London,us-midwest,30,1975-09-01T16:59:54.5Z\n";

        $parser = new FluxCsvParser($data);
        $tables = $parser->parse()->tables;
        $record = $tables[0]->records[0];

        try {
            $record->getValue();
            $this->fail("Expected exception");
        } catch (Exception $e) {
            $this->assertEquals("Record doesn't contain column named '_value'. " .
                "Columns: 'result, table, _start, _stop, _field, _measurement, city, location, value, _time'.", $e->getMessage());
        }
    }

    public function testParseInfinity()
    {
        $data = "#group,false,false,true,true,true,true,true,true,true,true,false,false
#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,string,string,string,string,string,string,double,double
#default,_result,,,,,,,,,,,
,result,table,_start,_stop,_field,_measurement,language,license,name,owner,le,_value
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,0,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,10,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,20,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,30,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,40,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,50,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,60,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,70,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,80,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,90,0
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,+Inf,15
,,0,2021-06-23T06:50:11.897825012Z,2021-06-25T06:50:11.897825012Z,stars,github_repository,C#,MIT License,influxdb-client-csharp,influxdata,-Inf,15

";

        $parser = new FluxCsvParser($data);
        $tables = $parser->parse()->tables;

        $this->assertEquals(1, sizeof($tables));
        $this->assertEquals(12, sizeof($tables[0]->records));
        $this->assertEquals(INF, $tables[0]->records[10]->values['le']);
        $this->assertEquals(-INF, $tables[0]->records[11]->values['le']);
    }

    public function testParseDuplicateColumnNames()
    {
        $data = "#datatype,string,long,dateTime:RFC3339,dateTime:RFC3339,dateTime:RFC3339,string,string,double
#group,false,false,true,true,false,true,true,false
#default,_result,,,,,,,
 ,result,table,_start,_stop,_time,_measurement,location,result
,,0,2022-09-13T06:14:40.469404272Z,2022-09-13T06:24:40.469404272Z,2022-09-13T06:24:33.746Z,my_measurement,Prague,25.3
,,0,2022-09-13T06:14:40.469404272Z,2022-09-13T06:24:40.469404272Z,2022-09-13T06:24:39.299Z,my_measurement,Prague,25.3
,,0,2022-09-13T06:14:40.469404272Z,2022-09-13T06:24:40.469404272Z,2022-09-13T06:24:40.454Z,my_measurement,Prague,25.3
";

        $parser = new FluxCsvParser($data);
        $tables = $parser->parse()->tables;

        $this->assertEquals(1, sizeof($tables));
        $this->assertEquals(3, sizeof($tables[0]->records));
        $this->assertEquals(8, sizeof($tables[0]->columns));
        $this->assertEquals(7, sizeof($tables[0]->records[0]->values));
        $this->assertEquals(8, sizeof($tables[0]->records[0]->row));
        $this->assertEquals(25.3, $tables[0]->records[0]->row[7]);
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
