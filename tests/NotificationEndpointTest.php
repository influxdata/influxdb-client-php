<?php

namespace InfluxDB2Test;

use InfluxDB2\Model\HTTPNotificationEndpoint;
use InfluxDB2\Model\NotificationEndpoint;
use InfluxDB2\Model\NotificationEndpointType;
use InfluxDB2\Model\PagerDutyNotificationEndpoint;
use InfluxDB2\Model\SlackNotificationEndpoint;
use InfluxDB2\Model\TelegramNotificationEndpoint;
use InfluxDB2\ObjectSerializer;
use PHPUnit\Framework\TestCase;

class NotificationEndpointTest extends TestCase
{
    /**
     * @return array<string, array{NotificationEndpoint, string}>
     */
    public function endpointProvider(): array
    {
        return [
            'slack' => [new SlackNotificationEndpoint(['name' => 'my-endpoint', 'url' => 'http://localhost']), NotificationEndpointType::SLACK],
            'http' => [new HTTPNotificationEndpoint(['name' => 'my-endpoint', 'url' => 'http://localhost', 'method' => 'POST', 'auth_method' => 'none']), NotificationEndpointType::HTTP],
            'pagerduty' => [new PagerDutyNotificationEndpoint(['name' => 'my-endpoint', 'routing_key' => 'my-key']), NotificationEndpointType::PAGERDUTY],
            'telegram' => [new TelegramNotificationEndpoint(['name' => 'my-endpoint', 'token' => 'my-token', 'channel' => 'my-channel']), NotificationEndpointType::TELEGRAM],
        ];
    }

    /**
     * @dataProvider endpointProvider
     */
    public function testDefaultType(NotificationEndpoint $endpoint, string $type): void
    {
        self::assertSame($type, $endpoint->getType());
        self::assertSame([], $endpoint->listInvalidProperties());
        $json = json_encode(ObjectSerializer::sanitizeForSerialization($endpoint));
        self::assertIsString($json);
        self::assertStringContainsString('"type":"' . $type . '"', $json);
    }

    public function testExplicitType(): void
    {
        $endpoint = new SlackNotificationEndpoint(['name' => 'my-endpoint', 'type' => NotificationEndpointType::HTTP]);

        self::assertSame(NotificationEndpointType::HTTP, $endpoint->getType());
    }
}
