<?php

namespace InfluxDB2Test;

use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use InfluxDB2\UdpWriter;
use PHPUnit\Framework\TestCase;

/**
 * Class WriteUdpTest
 * @package InfluxDB2Test
 */
class WriteUdpTest extends TestCase
{
    protected $baseConfig = [
        "url" => "http://localhost:8086",
        "token" => "my-token",
        "bucket" => "my-bucket",
        "precision" => WritePrecision::NS,
        "org" => "my-org",
        "logFile" => "php://output",
    ];

    protected function getWriterMock()
    {
        $method = new \ReflectionMethod(UdpWriter::class, 'writeSocket');
        $method->setAccessible(true);
        return $this->getMockBuilder(UdpWriter::class)
            ->setMethods(['writeSocket'])
            ->setConstructorArgs([$this->baseConfig + ['udpPort' => 1000]])
            ->getMock();
    }

    public function testRequireOptions()
    {
        $client = new Client($this->baseConfig);
        $this->expectException(\Exception::class);
        $client->createUdpWriter();
    }

    public function testValidOptions()
    {
        $this->expectNotToPerformAssertions();
        $client = new Client($this->baseConfig + ['udpPort' => 1000]);
        $client->createUdpWriter();
    }

    public function testSocketError()
    {
        $writer = $this->getWriterMock();
        $writer->method('writeSocket')->willReturn(false);
        $this->expectException(\Exception::class);
        $writer->write('h2o,location=west value=33i 15');
    }

    public function testLineProtocol()
    {
        $writer = $this->getWriterMock();
        $buffer = '';
        $writer->method('writeSocket')->willReturnCallback(function ($data) use (&$buffer) {
            $buffer = $data;
        });
        $writer->write('h2o,location=west value=33i 15');
        $this->assertEquals('h2o,location=west value=33i 15', $buffer);
    }

    public function testWriteArray()
    {
        $array = [
            'name' => 'h2o',
            'tags' => ['host' => 'aws', 'region' => 'us'],
            'fields' => ['level' => 5, 'saturation' => '99%'],
            'time' => 123
        ];

        $writer = $this->getWriterMock();
        $buffer = '';
        $writer->method('writeSocket')->willReturnCallback(function ($data) use (&$buffer) {
            $buffer = $data;
        });
        $writer->write($array);
        $this->assertEquals('h2o,host=aws,region=us level=5i,saturation="99%" 123', $buffer);
    }

    public function testWriteCollection()
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

        $array = [
            'name' => 'h2o',
            'tags' => ['host' => 'aws', 'region' => 'us'],
            'fields' => ['level' => 5, 'saturation' => '99%'],
            'time' => 123
        ];

        $writer = $this->getWriterMock();
        $buffer = '';
        $writer->method('writeSocket')->willReturnCallback(function ($data) use (&$buffer) {
            $buffer = $data;
        });
        $writer->write(['h2o,location=west value=33i 15', null, $point, $array]);
        $expected = "h2o,location=west value=33i 15\n"
            . "h2o,location=europe level=2i\n"
            . "h2o,host=aws,region=us level=5i,saturation=\"99%\" 123";
        $this->assertEquals($expected, $buffer);
    }
}
