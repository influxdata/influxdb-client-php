<?php

/**
 * Shows how to query data with profilers
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
        ->addTag("location", "New York")
        ->addField("temperature", rand(10, 25))
        ->time($dateNow->getTimestamp());
    $pointArray[] = $point;
    $dateNow->sub(new DateInterval('P1D'));
}

$writeApi->write($pointArray);
$writeApi->close();

//
// Executes query with profilers and return result as an Array of FluxTables
//
$queryApi = $client->createQueryApi();
$query = "import \"profiler\"
          option profiler.enabledProfilers = [\"query\", \"operator\"]

          from(bucket: \"my-bucket\")
                |> range(start: 0)
                |> filter(fn: (r) => r[\"_measurement\"] == \"weather\"
                                 and r[\"_field\"] == \"temperature\"
                                 and r[\"location\"] == \"New York\")";

$result = $queryApi->query($query);

printf("\n\n----------------------------- query result -------------------------------\n\n");
foreach ($result as $table) {
    foreach ($table->records as $record) {
        $measurement = $record->getMeasurement();

        // Get Query profiler
        if (strpos($measurement, 'profiler/query') !== false) {
            $totalDuration = $record["TotalDuration"];
            $queueDuration = $record["QueueDuration"];
            $compileDuration = $record["CompileDuration"];
            $executeDuration = $record["ExecuteDuration"];

            print"\n---------------------------- $measurement -----------------------------\n
                   Total Duration:     $totalDuration
                   Queue Duration:     $queueDuration
                   Compile Duration:   $compileDuration
                   Execute Duration:   $executeDuration\n";
        }
        // Get Operator profiler
        elseif (strpos($measurement, 'profiler/operator') !== false) {
            $minDuration = $record["MinDuration"];
            $maxDuration = $record["MaxDuration"];
            $durationSum = $record["DurationSum"];
            $meanDuration = $record["MeanDuration"];

            print"\n-------------------------- $measurement ----------------------------\n
                   Min Duration:       $minDuration
                   Max Duration:       $maxDuration
                   Duration Sum:       $durationSum
                   Mean Duration:      $meanDuration\n";
        }
        //Get query data
        else {
            $location = $record["location"];
            $temperature = $record->getValue();
            $time = $record->getTime();
            $measurement = $record->getMeasurement();
            print "\t$measurement in $location at $time - Temperature is $temperature °C\n";
        }
    }
}

$client->close();
