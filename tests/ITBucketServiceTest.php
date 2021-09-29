<?php

use InfluxDB2\ApiException;
use InfluxDB2\Model\BucketRetentionRules;
use InfluxDB2\Model\PostBucketRequest;
use InfluxDB2\ObjectSerializer;
use InfluxDB2\Service\BucketsService;
use InfluxDB2\Service\HealthService;

require_once('IntegrationBaseTestCase.php');

/**
 * @group integration
 */
class ITBucketServiceTest extends IntegrationBaseTestCase
{
    public function testHealthService()
    {
        $healthService = $this->client->createService(HealthService::class);
        $healthCheck = $healthService->getHealth();
        self::assertEquals("influxdb", $healthCheck->getName());
        self::assertEquals("ready for queries and writes", $healthCheck->getMessage());
    }

    public function testFixNanosTimeSerialization()
    {
        self::assertEquals(
            "2020-09-18T08:03:48.12345Z",
            ObjectSerializer::fixDatetimeNanos("2020-09-18T08:03:48.12345Z")
        );

        self::assertEquals(
            "2020-09-18T08:03:48.123456Z",
            ObjectSerializer::fixDatetimeNanos("2020-09-18T08:03:48.123456Z")
        );

        self::assertEquals(
            "2020-09-18T08:03:48.1234567Z",
            ObjectSerializer::fixDatetimeNanos("2020-09-18T08:03:48.1234567Z")
        );

        self::assertEquals(
            "2020-09-18T08:03:48.12345678Z",
            ObjectSerializer::fixDatetimeNanos("2020-09-18T08:03:48.12345678Z")
        );

        self::assertEquals(
            "2020-09-18T08:03:48.12345678Z",
            ObjectSerializer::fixDatetimeNanos("2020-09-18T08:03:48.123456789Z")
        );

        self::assertEquals(
            "2020-09-18T08:03:48.12345678Z",
            ObjectSerializer::fixDatetimeNanos("2020-09-18T08:03:48.1234567899Z")
        );

        self::assertEquals(
            "2021-09-29T06:32:56Z",
            ObjectSerializer::fixDatetimeNanos("2021-09-29T06:32:56Z")
        );
    }

    public function testBucketService()
    {
        /** @var BucketsService $bucketsService */
        $bucketsService = $this->client->createService(BucketsService::class);
        $buckets = $bucketsService->getBuckets(null, null, 100, null)->getBuckets();
        foreach ($buckets as $bucket) {
            self::assertNotEmpty($bucket->getName());
            self::assertNotEmpty($bucket->getId());
        }
    }

    public function testBucketServiceCreateBucket()
    {
        /** @var BucketsService $bucketsService */
        $bucketsService = $this->client->createService(BucketsService::class);

        $rule = new BucketRetentionRules();
        $rule->setEverySeconds(3600);

        $bucketName = $this->generateBucketName();
        $bucketRequest = new PostBucketRequest();
        $bucketRequest->setName($bucketName)
            ->setRetentionRules([$rule])
            ->setOrgId($this->findMyOrg()->getId());

        //create bucket
        $respBucket = $bucketsService->postBuckets($bucketRequest);
        print $respBucket;
        self::assertEquals($bucketName, $respBucket->getName());

        //find bucket
        $buckets = $bucketsService->getBuckets(null, null, 100, null)->getBuckets();
        $findBucket = null;
        foreach ($buckets as $bucket) {
            self::assertNotEmpty($bucket->getName());
            self::assertNotEmpty($bucket->getId());
            if ($bucket->getId() == $respBucket->getId()) {
                $findBucket = $bucket;
            }
        }
        self::assertNotNull($findBucket);

        //delete bucket
        $bucketsService->deleteBucketsID($findBucket->getId());

        //verify bucket deleted
        $this->expectException(ApiException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage("bucket not found");
        $bucketsService->getBucketsID($findBucket->getId());
    }
}
