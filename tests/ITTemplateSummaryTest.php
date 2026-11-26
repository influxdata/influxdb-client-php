<?php

namespace InfluxDB2Test;

use InfluxDB2\Model\CheckDiscriminator;
use InfluxDB2\Model\NotificationEndpointDiscriminator;
use InfluxDB2\Model\TemplateApply;
use InfluxDB2\Model\TemplateApplyTemplate;
use InfluxDB2\Model\TemplateSummary;
use InfluxDB2\Model\TelegrafRequest;
use InfluxDB2\Service\TemplatesService;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ITTemplateSummaryTest extends IntegrationBaseTestCase
{
    public function testDryRunSummary(): void
    {
        $org = $this->findMyOrg();
        self::assertNotNull($org);

        $contents = [
            [
                'apiVersion' => 'influxdata.com/v2alpha1',
                'kind' => 'CheckDeadman',
                'metadata' => ['name' => 'it-check'],
                'spec' => [
                    'name' => 'it-check',
                    'every' => '5m',
                    'level' => 'CRIT',
                    'query' => 'from(bucket: "my-bucket") |> range(start: -1m) |> filter(fn: (r) => r._field == "value")',
                    'statusMessageTemplate' => 'message',
                    'timeSince' => '90s',
                ],
            ],
            [
                'apiVersion' => 'influxdata.com/v2alpha1',
                'kind' => 'NotificationEndpointSlack',
                'metadata' => ['name' => 'it-endpoint'],
                'spec' => ['name' => 'it-endpoint', 'url' => 'http://localhost:1234'],
            ],
            [
                'apiVersion' => 'influxdata.com/v2alpha1',
                'kind' => 'Telegraf',
                'metadata' => ['name' => 'it-telegraf'],
                'spec' => ['name' => 'it-telegraf', 'config' => "[agent]\n  interval = \"10s\"\n"],
            ],
        ];

        /** @var TemplatesService $service */
        $service = $this->client->createService(TemplatesService::class);
        $summary = $service->applyTemplate(new TemplateApply([
            'dry_run' => true,
            'org_id' => $org->getId(),
            'template' => new TemplateApplyTemplate(['contents' => $contents]),
        ]));

        self::assertInstanceOf(TemplateSummary::class, $summary);
        $summarySummary = $summary->getSummary();
        self::assertNotNull($summarySummary);
        // InfluxDB nests the resources (e.g. {"kind": "CheckDeadman", "check": {...}}) unlike the OpenAPI
        // specification, so only the structure of the summary is checked
        self::assertCount(1, $summarySummary->getChecks());
        self::assertInstanceOf(CheckDiscriminator::class, $summarySummary->getChecks()[0]);
        self::assertCount(1, $summarySummary->getNotificationEndpoints());
        self::assertInstanceOf(NotificationEndpointDiscriminator::class, $summarySummary->getNotificationEndpoints()[0]);
        self::assertCount(1, $summarySummary->getTelegrafConfigs());
        self::assertInstanceOf(TelegrafRequest::class, $summarySummary->getTelegrafConfigs()[0]);
    }
}
