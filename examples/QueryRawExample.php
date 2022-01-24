<?php

/**
 * Shows how to query data into `string`
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
        ->addTag("location", "Sydney")
        ->addField("temperature", rand(15, 30))
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
// Synchronously executes query and return result as unprocessed String
//
$result = $queryApi->queryRaw(
    "from(bucket: \"my-bucket\")
                |> range(start: 0)
                |> filter(fn: (r) => r[\"_measurement\"] == \"weather\"
                                 and r[\"_field\"] == \"temperature\"
                                 and r[\"location\"] == \"Sydney\")"
);

printf("\n\n-------------------------- Query Raw ----------------------------\n\n");
printf($result);

$client->close();
