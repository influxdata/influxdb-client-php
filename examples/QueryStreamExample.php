<?php

/**
 * Shows how to query data into `Stream`
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Point;

$org = 'my-org';
$bucket = 'my-bucket';
$token = 'my-token';

//
// Creating client
//
$client = new Client([
    "url" => "http://localhost:8086",
    "token" => $token,
    "bucket" => $bucket,
    "org" => $org,
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

//
// Write test data into InfluxDB
//
$writeApi = $client->createWriteApi();
$pointArray = [];

$dateNow = new DateTime('NOW');
for ($i = 1; $i <= 10; $i++) {
    $point = Point::measurement("weather")
        ->addTag("location", "San Francisco")
        ->addField("temperature", rand(5, 25))
        ->time($dateNow->getTimestamp());
    $pointArray[] = $point;
    $dateNow->sub(new DateInterval('P1D'));
}

$writeApi->write($pointArray);
$writeApi->close();

//
// Get query client
//
$queryApi = $client->createQueryApi();

//
// Synchronously executes the Flux query and return stream of FluxRecord
//
$queryApi = $client->createQueryApi();
$query = "from(bucket: \"my-bucket\")
            |> range(start: 0)
            |> filter(fn: (r) => r[\"_measurement\"] == \"weather\"
                             and r[\"_field\"] == \"temperature\")";
$result = $queryApi->queryStream($query);

//
// Working with returned data into Stream
//
printf("\n\n----------------------------- Query Stream -------------------------------\n\n");
foreach ($result->each() as $record) {
    $location = $record["location"];
    $temperature = $record->getValue();
    $time = $record->getTime();
    $measurement = $record->getMeasurement();
    print " $measurement in $location at $time - Temperature is $temperature °C\n";
}

$client->close();
