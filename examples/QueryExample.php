<?php

/**
 * Shows how to query data into `FluxTable`
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Model\DeletePredicateRequest;
use InfluxDB2\Point;
use InfluxDB2\Service\DeleteService;

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
// Delete data from influxDB
//
$service = $client->createService(DeleteService::class);

$predicate = new DeletePredicateRequest();
$predicate->setStart(DateTime::createFromFormat('Y', '1900'));
$predicate->setStop(new DateTime());
$predicate->setPredicate("_measurement=\"weather\"");
$service->postDelete($predicate, null, $org, $bucket);

//
// Write test data into InfluxDB
//
$writeApi = $client->createWriteApi();
$pointArray = [];

$dateNow = new DateTime('NOW');
for ($i = 1; $i <= 10; $i++) {
    $point = Point::measurement("weather")
        ->addTag("location", "London")
        ->addField("temperature", rand(-5, 20))
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
// Synchronously executes query and return result as an Array of FluxTables
//
$result = $queryApi->query(
    'from(bucket: "my-bucket")
                |> range(start: -8d)
                |> filter(fn: (r) => r["_measurement"] == "weather")'
);

//
// Encoding to JSON with json_encode
//
printf("\n\n----------------------- Query (JsonEncode) -----------------------\n\n");
echo json_encode($result, JSON_PRETTY_PRINT);

//
// Working with returned data in FluxTables
//
printf("\n\n----------------------- Query (FluxTables) -----------------------\n\n");
foreach ($result as $table) {
    foreach ($table->records as $record) {
        $location = $record["location"];
        $temperature = $record->getValue();
        try {
            $time = (new DateTime($record->getTime()))->format('d.m.Y');
        } catch (Exception $e) {
            $time = $record->getTime();
        }
        $measurement = $record->getMeasurement();
        print "$measurement in $location at $time - Temperature is $temperature °C\n";
    }
}

$client->close();
