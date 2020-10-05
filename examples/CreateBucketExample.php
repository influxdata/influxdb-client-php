<?php
/**
 * Shows how to use batching for more performance writes.
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Model\BucketRetentionRules;
use InfluxDB2\Model\Organization;
use InfluxDB2\Model\PostBucketRequest;
use InfluxDB2\Service\BucketsService;
use InfluxDB2\Service\OrganizationsService;

$organization = 'my-org';
$bucket = 'my-bucket';
$token = 'my-token';

$client = new Client([
    "url" => "http://localhost:8086",
    "token" => $token,
    "bucket" => $bucket,
    "org" => $organization,
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

function findMyOrg($client): ?Organization
{
    /** @var OrganizationsService $orgService */
    $orgService = $client->createService(OrganizationsService::class);
    $orgs = $orgService->getOrgs()->getOrgs();
    foreach ($orgs as $org) {
        if ($org->getName() == $client->options["org"]) {
            return $org;
        }
    }
    return null;
}

$bucketsService = $client->createService(BucketsService::class);

$rule = new BucketRetentionRules();
$rule->setEverySeconds(3600);

$bucketName = "example-bucket-" . microtime();
$bucketRequest = new PostBucketRequest();
$bucketRequest->setName($bucketName)
    ->setRetentionRules([$rule])
    ->setOrgId(findMyOrg($client)->getId());

//create bucket
$respBucket = $bucketsService->postBuckets($bucketRequest);
print $respBucket;

$client->close();
