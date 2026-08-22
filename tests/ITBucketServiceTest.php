<?php

namespace InfluxDB2Test;

use InfluxDB2\ApiException;
use InfluxDB2\Model\Bucket;
use InfluxDB2\Model\BucketRetentionRules;
use InfluxDB2\Model\Buckets;
use InfluxDB2\Model\HealthCheck;
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
    public function testHealthService(): void
    {
        $healthService = $this->client->createService(HealthService::class);
        $healthCheck = $healthService->getHealth();
        self::assertInstanceOf(HealthCheck::class, $healthCheck);
        self::assertEquals("influxdb", $healthCheck->getName());
        self::assertEquals("ready for queries and writes", $healthCheck->getMessage());
    }

    public function testFixNanosTimeSerialization(): void
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

    public function testBucketService(): void
    {
        $bucketsService = $this->client->createService(BucketsService::class);
        self::assertInstanceOf(BucketsService::class, $bucketsService);
        $buckets = $bucketsService->getBuckets(null, null, 100, null);
        self::assertInstanceOf(Buckets::class, $buckets);
        foreach ($buckets->getBuckets() as $bucket) {
            self::assertNotEmpty($bucket->getName());
            self::assertNotEmpty($bucket->getId());
        }
    }

    public function testBucketServiceCreateBucket(): void
    {
        $bucketsService = $this->client->createService(BucketsService::class);
        self::assertInstanceOf(BucketsService::class, $bucketsService);

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
        self::assertInstanceOf(Bucket::class, $respBucket);
        self::assertEquals($bucketName, $respBucket->getName());

        //find bucket
        $buckets = $bucketsService->getBuckets(null, null, 100, null);
        self::assertInstanceOf(Buckets::class, $buckets);
        $findBucket = null;
        foreach ($buckets->getBuckets() as $bucket) {
            self::assertInstanceOf(Bucket::class, $bucket);
            self::assertNotEmpty($bucket->getName());
            self::assertNotEmpty($bucket->getId());
            if ($bucket->getId() === $respBucket->getId()) {
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
