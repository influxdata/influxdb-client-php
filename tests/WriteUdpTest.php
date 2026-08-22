<?php

namespace InfluxDB2Test;

use InfluxDB2\Client;
use InfluxDB2\ClientOptions;
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
    /**
     * @var array{
     *     url: string,
     *     token: string,
     *     bucket?: string,
     *     org?: string,
     *     precision?: WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS,
     *     allow_redirects?: bool,
     *     debug?: bool,
     *     logFile?: string,
     *     httpClient?: \Psr\Http\Client\ClientInterface,
     *     verifySSL?: bool,
     *     timeout?: int,
     *     proxy?: string,
     *     udpPort?: int<1, 65535>,
     *     ipVersion?: 4|6,
     *     tags?: array<string, string>,
     * } $baseConfig
     */
    protected $baseConfig = [
        "url" => "http://localhost:8086",
        "token" => "my-token",
        "bucket" => "my-bucket",
        "precision" => WritePrecision::NS,
        "org" => "my-org",
        "logFile" => "php://output",
    ];

    /**
     * @return (UdpWriter&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected function getWriterMock()
    {
        $method = new \ReflectionMethod(UdpWriter::class, 'writeSocket');
        if (PHP_VERSION_ID < 80100) {
            $method->setAccessible(true);
        }
        return $this->getMockBuilder(UdpWriter::class)
            ->onlyMethods(['writeSocket'])
            ->setConstructorArgs([
                ClientOptions::fromArray($this->baseConfig + ['udpPort' => 1000]),
            ])
            ->getMock();
    }

    public function testRequireOptions(): void
    {
        $client = new Client($this->baseConfig);
        $this->expectException(\Exception::class);
        $client->createUdpWriter();
    }

    public function testValidOptions(): void
    {
        $this->expectNotToPerformAssertions();
        $client = new Client($this->baseConfig + ['udpPort' => 1000]);
        $client->createUdpWriter();
    }

    public function testSocketError(): void
    {
        $writer = $this->getWriterMock();
        $writer->method('writeSocket')->willReturn(false);
        $this->expectException(\Exception::class);
        $writer->write('h2o,location=west value=33i 15');
    }

    public function testLineProtocol(): void
    {
        $writer = $this->getWriterMock();
        $buffer = '';
        $writer->method('writeSocket')->willReturnCallback(function ($data) use (&$buffer): void {
            $buffer = $data;
        });
        $writer->write('h2o,location=west value=33i 15');
        self::assertEquals('h2o,location=west value=33i 15', $buffer);
    }

    public function testWriteArray(): void
    {
        $array = [
            'name' => 'h2o',
            'tags' => ['host' => 'aws', 'region' => 'us'],
            'fields' => ['level' => 5, 'saturation' => '99%'],
            'time' => 123
        ];

        $writer = $this->getWriterMock();
        $buffer = '';
        $writer->method('writeSocket')->willReturnCallback(function ($data) use (&$buffer): void {
            $buffer = $data;
        });
        $writer->write($array);
        self::assertEquals('h2o,host=aws,region=us level=5i,saturation="99%" 123', $buffer);
    }

    public function testWriteCollection(): void
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
        self::assertEquals($expected, $buffer);
    }
}
