<?php

namespace InfluxDB2Test;

use DateTime;
use DateTimeImmutable;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testToLineProtocol(): void
    {
        $pointArgs = new Point(
            'h2o',
            array('host' => 'aws', 'region' => 'us'),
            array('level' => 5, 'saturation' => '99%'),
            123
        );

        self::assertEquals(
            'h2o,host=aws,region=us level=5i,saturation="99%" 123',
            $pointArgs->toLineProtocol()
        );

        $pointArray = Point::fromArray(array('name' => 'h2o',
            'tags' => array('host' => 'aws', 'region' => 'us'),
            'fields' => array('level' => 5, 'saturation' => '99%'),
            'time' => 123));

        self::assertEquals(
            'h2o,host=aws,region=us level=5i,saturation="99%" 123',
            $pointArray->toLineProtocol()
        );
    }

    public function testMeasurementEscape(): void
    {
        $point = new Point('h2 o 2', array('location' => 'europe'), array('level' => 2));
        self::assertEquals('h2\\ o\\ 2,location=europe level=2i', $point->toLineProtocol());

        $point = new Point('h2,o', array('location' => 'europe'), array('level' => 2));
        self::assertEquals('h2\\,o,location=europe level=2i', $point->toLineProtocol());
    }

    public function testEmptyKey(): void
    {
        $point = Point::measurement('h2o')
            ->addField('level', 2)
            ->addTag('location', 'europe')
            ->addTag('', 'warn');

        self::assertEquals('h2o,location=europe level=2i', $point->toLineProtocol());
    }

    public function testEmptyValue(): void
    {
        $point = Point::measurement('h2o')
            ->addField('level', 2)
            ->addTag('location', 'europe')
            ->addTag('log', '');

        self::assertEquals('h2o,location=europe level=2i', $point->toLineProtocol());
    }

    public function testTagEscapingKeyAndValue(): void
    {
        $point = Point::measurement("h\n2\ro\t_data")
            ->addTag("new\nline", "new\nline")
            ->addTag("carriage\rreturn", "carriage\nreturn")
            ->addTag("t\tab", "t\tab")
            ->addField("level", 2);

        self::assertEquals(
            "h\\n2\\ro\\t_data,carriage\\rreturn=carriage\\nreturn,new\\nline=new\\nline,t\\tab=t\\tab level=2i",
            $point->toLineProtocol()
        );
    }

    public function testStringableTag(): void
    {
        // this is just a random native class, implementing __toString()
        $tag = new StringableClass();

        $point = new Point("data", ['test' => $tag], ['value' => 1]);

        self::assertStringStartsWith(
            "data,test=stringable",
            $point->toLineProtocol()
        );
    }

    public function testNonStringableTag(): void
    {
        $this->expectWarning();
        $this->expectWarningMessage('Tag value for key test cannot be converted to string');
        $point = new Point("data", ['test' => []]);

        $point->toLineProtocol();
    }

    public function testEqualSignEscaping(): void
    {
        $point = Point::measurement("h=2o")
            ->addTag("l=ocation", "e=urope")
            ->addField("l=evel", 2);

        self::assertEquals("h=2o,l\\=ocation=e\\=urope l\\=evel=2i", $point->toLineProtocol());
    }

    public function testOverrideTagAndField(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addTag('location', 'europe2')
            ->addField('level', 1)
            ->addField('level', 2)
            ->addField('level', 3);

        self::assertEquals('h2o,location=europe2 level=3i', $point->toLineProtocol());
    }

    public function testFieldTypes(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('tag_b', 'b')
            ->addTag('tag_a', 'a')
            ->addField('n1', -2)
            ->addField('n2', 10)
            ->addField('n3', 9223372036854775807)
            ->addField('n4', 5.5)
            ->addField('bool', true)
            ->addField('string', 'string value');

        $expected = 'h2o,tag_a=a,tag_b=b bool=true,n1=-2i,n2=10i,n3=9223372036854775807i,n4=5.5,string="string value"';
        self::assertEquals($expected, $point->toLineProtocol());
    }

    public function testFieldNullValue(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->addField('warning', null);

        self::assertEquals('h2o,location=europe level=2i', $point->toLineProtocol());
    }

    public function testFieldEscape(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 'string esc"ape value');

        self::assertEquals('h2o,location=europe level="string esc\"ape value"', $point->toLineProtocol());

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 'string esc\\ape value');

        self::assertEquals('h2o,location=europe level="string esc\\\\ape value"', $point->toLineProtocol());
    }

    public function testTime(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time(123, WritePrecision::NS);

        self::assertEquals('h2o,location=europe level=2i 123', $point->toLineProtocol());
    }

    /**
     * @dataProvider providerDateTime
     * @param DateTime|DateTimeImmutable $time
     */
    public function testTimeFormatting($time): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time($time, WritePrecision::MS);

        self::assertEquals('h2o,location=europe level=2i 1444897215000', $point->toLineProtocol());

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time($time, WritePrecision::S);

        self::assertEquals('h2o,location=europe level=2i 1444897215', $point->toLineProtocol());

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time($time, WritePrecision::US);

        self::assertEquals('h2o,location=europe level=2i 1444897215000000', $point->toLineProtocol());

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time($time, WritePrecision::NS);

        self::assertEquals('h2o,location=europe level=2i 1444897215000000000', $point->toLineProtocol());
    }

    /**
     * @return array<int, array{DateTime|DateTimeImmutable}>
     */
    public function providerDateTime(): array
    {
        return [
            [
                (new DateTime())
                    ->setDate(2015, 10, 15)
                    ->setTime(8, 20, 15)
            ],
            [
                (new DateTimeImmutable())
                    ->setDate(2015, 10, 15)
                    ->setTime(8, 20, 15)
            ],
        ];
    }

    public function testTimeFormattingDefault(): void
    {
        $time = new DateTime();
        $time->setDate(2015, 10, 15);
        $time->setTime(8, 20, 15);

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time($time);

        self::assertEquals('h2o,location=europe level=2i 1444897215000000000', $point->toLineProtocol());

        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time($time, null);

        self::assertEquals('h2o,location=europe level=2i 1444897215000000000', $point->toLineProtocol());
    }

    public function testTimeString(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time('123');

        self::assertEquals('h2o,location=europe level=2i 123', $point->toLineProtocol());
    }

    public function testTimeFloat(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2)
            ->time(102030405060.24);

        self::assertEquals('h2o,location=europe level=2i 102030405060', $point->toLineProtocol());
    }

    public function testUtf8(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'Přerov')
            ->addField('level', 2)
            ->time(123);

        self::assertEquals('h2o,location=Přerov level=2i 123', $point->toLineProtocol());
    }

    public function testWithoutTags(): void
    {
        $point = Point::measurement('h2o')
            ->addField('level', 2)
            ->time(123);

        self::assertEquals('h2o level=2i 123', $point->toLineProtocol());
    }

    public function testWithoutFields(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->time(123);

        self::assertNull($point->toLineProtocol());
    }

    public function testFromArrayWithoutName(): void
    {
        $pointArray = Point::fromArray(array(
            'tags' => array('host' => 'aws', 'region' => 'us'),
            'fields' => array('level' => 5, 'saturation' => '99%'),
            'time' => 123));

        self::assertNull($pointArray);
    }

    public function testTagNonString(): void
    {
        $point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addTag('tag_not_string', 4711)
            ->addTag('tag_not_null', null)
            ->addField('level', 2);

        self::assertEquals('h2o,location=europe,tag_not_string=4711 level=2i', $point->toLineProtocol());
    }
}
