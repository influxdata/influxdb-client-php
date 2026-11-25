<?php

namespace InfluxDB2Test;

use InfluxDB2\Model\Check;
use InfluxDB2\Model\DashboardColor;
use InfluxDB2\Model\DashboardQuery;
use InfluxDB2\Model\NotificationEndpoint;
use InfluxDB2\Model\NotificationRule;
use InfluxDB2\Model\TelegrafRequest;
use InfluxDB2\Model\TemplateSummarySummary;
use InfluxDB2\ObjectSerializer;
use PHPUnit\Framework\TestCase;

class GeneratedModelsTest extends TestCase
{
    public function testDeserializeTemplateSummary(): void
    {
        $summary = ObjectSerializer::deserialize(
            json_decode('{"checks": [{"type": "deadman", "name": "check"}],'
                . ' "notificationEndpoints": [{"type": "slack", "name": "endpoint"}],'
                . ' "telegrafConfigs": [{"name": "telegraf", "config": "[agent]"}]}'),
            '\InfluxDB2\Model\TemplateSummarySummary'
        );

        self::assertInstanceOf(TemplateSummarySummary::class, $summary);
        self::assertSame('check', $summary->getChecks()[0]->getName());
        self::assertSame('endpoint', $summary->getNotificationEndpoints()[0]->getName());
        $telegraf = $summary->getTelegrafConfigs()[0];
        self::assertInstanceOf(TelegrafRequest::class, $telegraf);
        self::assertSame('[agent]', $telegraf->getConfig());
    }

    public function testDeserializeEmptyEnumValue(): void
    {
        $query = ObjectSerializer::deserialize(
            json_decode('{"text": "buckets()", "editMode": ""}'),
            '\InfluxDB2\Model\DashboardQuery'
        );

        self::assertInstanceOf(DashboardQuery::class, $query);
        self::assertSame('buckets()', $query->getText());
        self::assertNull($query->getEditMode());
        self::assertSame('advanced', ObjectSerializer::deserialize('advanced', '\InfluxDB2\Model\QueryEditMode'));

        $this->expectException(\InvalidArgumentException::class);
        ObjectSerializer::deserialize('unknown', '\InfluxDB2\Model\QueryEditMode');
    }

    public function testDashboardColorWithoutHex(): void
    {
        $color = new DashboardColor();

        // only "can't be null" is reported, length of null is not validated
        self::assertContains("'hex' can't be null", $color->listInvalidProperties());
        foreach ($color->listInvalidProperties() as $message) {
            self::assertStringNotContainsString('character length', $message);
        }

        $color->setHex('#ff0000');
        self::assertNotContains("'hex' can't be null", $color->listInvalidProperties());
    }

    /**
     * @return array<string, array{class-string<\ArrayAccess<mixed, mixed>>}>
     */
    public function discriminatorModelProvider(): array
    {
        return [
            'Check' => [Check::class],
            'NotificationEndpoint' => [NotificationEndpoint::class],
            'NotificationRule' => [NotificationRule::class],
        ];
    }

    /**
     * @dataProvider discriminatorModelProvider
     * @param class-string<\ArrayAccess<mixed, mixed>> $class
     */
    public function testModelWithoutDiscriminatorProperty(string $class): void
    {
        $model = new $class();

        self::assertFalse(isset($model[0]));
        self::assertNull($model[0]);
    }

    public function testDeserializeFileWithoutHeaders(): void
    {
        $stream = \GuzzleHttp\Psr7\Utils::streamFor('file content');

        $file = ObjectSerializer::deserialize($stream, '\SplFileObject');

        self::assertInstanceOf(\SplFileObject::class, $file);
        self::assertSame('file content', $file->fread(100));
        unlink($file->getPathname());
    }
}
