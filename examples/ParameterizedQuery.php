<?php
/**
 * Shows how to use parameterized queries
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Model\Query;
use InfluxDB2\Point;
use InfluxDB2\WriteType as WriteType;

$url = "https://us-west-2-1.aws.cloud2.influxdata.com";
$organization = 'my-org';
$bucket = 'my-bucket';
$token = 'my-token';

$client = new Client([
    "url" => $url,
    "token" => $token,
    "bucket" => $bucket,
    "org" => $organization,
    "precision" => InfluxDB2\Model\WritePrecision::NS,
    "debug" => false
]);

$writeApi = $client->createWriteApi(["writeType" => WriteType::SYNCHRONOUS]);
$queryApi = $client->createQueryApi();

$today = new DateTime("now");
$yesterday = $today->sub(new DateInterval("P1D"));

$p = new Point("temperature");
$p->addTag("location", "north")->addField("value", 60)->time($yesterday);
$writeApi->write($p);
$writeApi->close();

//
// Query range start parameter using duration
//
$parameterizedQuery = "from(bucket: params.bucketParam) |> range(start: duration(v: params.startParam))";
$query = new Query();
$query->setQuery($parameterizedQuery);
$query->setParams(["bucketParam" => "my-bucket", "startParam" => "-1d"]);
$tables = $queryApi->query($query);

foreach ($tables as $table) {
    foreach ($table->records as $record) {
        var_export($record->values);
    }
}

//
// Query range start parameter using DateTime
//
$parameterizedQuery = "from(bucket: params.bucketParam) |> range(start: time(v: params.startParam))";
$query->setParams(["bucketParam" => "my-bucket", "startParam" => $yesterday]);
$query->setQuery($parameterizedQuery);
$tables = $queryApi->query($query);

foreach ($tables as $table) {
    foreach ($table->records as $record) {
        var_export($record->values);
    }
}

$client->close();
