<?php
/**
 * Shows how to use batching for more performance writes.
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\WriteType as WriteType;

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

print  "*** Write by batching ***\n";

$writeApi = $client->createWriteApi(
    ["writeType" => WriteType::BATCHING, 'batchSize' => 1000]
);

foreach (range(1, 10000) as $number) {
    $writeApi->write("mem,host=aws_europe,type=batch value=1i $number");
}

// flush remaining data
$client->close();

print  "*** Check result ***\n";

$queryApi = $client->createQueryApi();
$query = "from(bucket: \"$bucket\")
    |> range(start: 0)
    |> filter(fn: (r) => r[\"_measurement\"] == \"mem\")
    |> filter(fn: (r) => r[\"host\"] == \"aws_europe\")
    |> count()";
$tables = $queryApi->query($query);
$record = $tables[0]->records[0];
$value = $record->getValue();
print "Count: $value\n";

$client->close();
