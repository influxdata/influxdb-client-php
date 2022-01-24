<?php

/**
 * Shows how to use a Flux query defined in a separate file
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
        ->addTag("location", "Prague")
        ->addField("temperature", rand(-5, 15))
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
// Executes Flux query defined in a separate file
//
$filename = "query.flux";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$result = $queryApi->query($contents);

//
// Working with returned data in FluxTables
//
printf("\n\n------------------------------- Query -------------------------------\n\n");
foreach ($result as $table) {
    foreach ($table->records as $record) {
        $day = getDayName($record["weekDay"]);
        $location = $record["location"];
        $temperature = $record["temperature"];
        $measurement = $record->getMeasurement();
        print "Temperature in $location at $day is $temperature °C\n";
    }
}

function getDayName(int $weekDay): string
{
    switch ($weekDay) {
        case "1":
            return "Monday";
        case "2":
            return "Tuesday";
        case "3":
            return "Wednesday";
        case "4":
            return "Thursday";
        case "5":
            return "Friday";
        case "6":
            return "Saturday";
        case "0":
            return "Sunday";
    }
    return "";
}

$client->close();
