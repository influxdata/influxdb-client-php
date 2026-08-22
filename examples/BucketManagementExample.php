<?php

/**
 * Shows how to create, list and delete Buckets
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Model\Bucket;
use InfluxDB2\Model\BucketRetentionRules;
use InfluxDB2\Model\Buckets;
use InfluxDB2\Model\Organization;
use InfluxDB2\Model\Organizations;
use InfluxDB2\Model\PostBucketRequest;
use InfluxDB2\Service\BucketsService;
use InfluxDB2\Service\OrganizationsService;

$organization = 'my-org';
$bucket = 'my-bucket';
$token = 'my-token';

//
// Creating client
//
$client = new Client([
    "url" => "http://localhost:8086",
    "token" => $token,
    "bucket" => $bucket,
    "org" => $organization,
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

//
// Function for getting organization ID
//
function findMyOrg(Client $client): ?Organization
{
    $orgService = $client->createService(OrganizationsService::class);
    assert($orgService instanceof OrganizationsService);
    $orgs = $orgService->getOrgs();
    assert($orgs instanceof Organizations);
    foreach ($orgs->getOrgs() as $org) {
        assert($org instanceof Organization);
        if ($org->getName() === $client->options["org"]) {
            return $org;
        }
    }
    return null;
}

//
// Creating bucket service
//
$bucketsService = $client->createService(BucketsService::class);

//
// Creating bucket
//
print "\n\n----------------------------------------- Bucket create -----------------------------------------\n";
$rule = new BucketRetentionRules();
$rule->setEverySeconds(3600);

$bucketName = "example-bucket-" . microtime();
$bucketRequest = new PostBucketRequest();
$bucketRequest->setName($bucketName)
    ->setRetentionRules([$rule])
    ->setOrgId(findMyOrg($client)->getId());

$respBucket = $bucketsService->postBuckets($bucketRequest);
assert($respBucket instanceof Bucket);
$bucketName = $respBucket->getName();
$bucketId = $respBucket->getId();
$createdAt = $respBucket->getCreatedAt()->format('Y-m-d H:i:s');

print  "ID: $bucketId       Created: $createdAt     Name: $bucketName was created\n";

//
// Get all buckets
//
print "\n\n----------------------------------------- Bucket List -----------------------------------------\n";
$bucketList = $bucketsService->getBuckets();
assert($bucketList instanceof Buckets);

foreach ($bucketList->getBuckets() as $item) {
    assert($item instanceof Bucket);
    $bucketName = $item->getName();
    $bucketId = $item->getId();
    $createdAt = $item->getCreatedAt()->format('Y-m-d H:i:s');

    print  "ID: $bucketId       Created: $createdAt     Name: $bucketName \n";
}

//
// Delete all buckets contains 'example-bucket'
//
print "\n\n----------------------------------------- Bucket delete -----------------------------------------\n";
$bucketList = $bucketsService->getBuckets();
assert($bucketList instanceof Buckets);
foreach ($bucketList->getBuckets() as $item) {
    assert($item instanceof Bucket);
    $bucketName = $item->getName();
    if (strpos($bucketName, 'example-bucket') !== false) {
        $createdAt = $item->getCreatedAt()->format('Y-m-d H:i:s');

        $bucketsService->deleteBucketsID($item->getID());

        print  "Name: $bucketName     Created: $createdAt     was deleted \n";
    }
}

$client->close();
