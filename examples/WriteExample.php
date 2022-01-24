<?php

/**
 * Shows how to write data to InfluxDB via default API using Point structure or line protocol
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Point;

//
// Creating client
//
$client = new Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

//
// Function for checking results
//
function checkResult(string  $filterName, Client  $client, string $comment)
{
    $query = "from(bucket: \"my-bucket\")
    |> range(start: 0)
    |> filter(fn: (r) => r[\"location\"] == \"$filterName\")";
    $queryApi = $client->createQueryApi();
    $result = $queryApi->query($query);
    printf("\n\n----------------------- $comment -----------------------\n\n");
    foreach ($result as $table) {
        foreach ($table->records as $record) {
            $location = $record["location"];
            $temperature = $record->getValue();
            $measurement = $record->getMeasurement();
            $dateTime = $record->getTime();
            print "$measurement:   Temperature in $location at $dateTime is $temperature °C\n";
        }
    }
}

//
// Write data to InfluxDB using point structure
//
$writeApi = $client->createWriteApi();

$dateTimeNow = new DateTime('NOW');
$point = Point::measurement("weather")
        ->addTag("location", "Denver")
        ->addField("temperature", rand(0, 20))
        ->time($dateTimeNow->getTimestamp());
$writeApi->write($point);

checkResult("Denver", $client, "Write using point structure");

//
// Write data to InfluxDB using line protocol
//
$seconds = time();
$temp = rand(-5, 15)."i";

$writeApi->write("weather,location=Berlin temperature=$temp $seconds");
$writeApi->close();

checkResult("Berlin", $client, "Write using line protocol");

$client->close();
