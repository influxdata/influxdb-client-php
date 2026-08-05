<?php

namespace InfluxDB2Test;

use InfluxDB2\Client;
use InfluxDB2\Model\Organization;
use InfluxDB2\Model\Organizations;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Service\OrganizationsService;
use PHPUnit\Framework\TestCase;

class IntegrationBaseTestCase extends TestCase
{
    public Client $client;
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
     * } $options
     */
    public array $options;

    public function setUp(): void
    {
        $this->options = [
            "url" => "http://localhost:8086",
            "token" => "my-token",
            "bucket" => "my-bucket",
            "precision" => WritePrecision::NS,
            "org" => "my-org",
            "debug" => false
        ];
        $this->client = new Client($this->options);
    }


    public function findMyOrg(): ?Organization
    {
        $orgService = $this->client->createService(OrganizationsService::class);
        self::assertInstanceOf(OrganizationsService::class, $orgService);
        $orgs = $orgService->getOrgs();
        self::assertInstanceOf(Organizations::class, $orgs);
        foreach ($orgs->getOrgs() as $org) {
            if ($org->getName() === $this->options["org"]) {
                return $org;
            }
        }
        return null;
    }

    public function generateBucketName(): string
    {
        return "IT-php-bucket-" . microtime();
    }
}
