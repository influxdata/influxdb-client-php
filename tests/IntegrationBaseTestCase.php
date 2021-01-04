<?php

use InfluxDB2\Client;
use InfluxDB2\Model\Organization;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Service\OrganizationsService;
use PHPUnit\Framework\TestCase;

class IntegrationBaseTestCase extends TestCase
{
    public $client;
    public $options;

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
        /** @var OrganizationsService $orgService */
        $orgService = $this->client->createService(OrganizationsService::class);
        $orgs = $orgService->getOrgs()->getOrgs();
        foreach ($orgs as $org) {
            if ($org->getName() == $this->options["org"]) {
                return $org;
            }
        }
        return null;
    }

    public function generateBucketName()
    {
        return "IT-php-bucket-" . microtime();
    }
}
