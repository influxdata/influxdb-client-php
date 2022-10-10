<?php

/**
 * How to use `FluxRecord.row` instead of `FluxRecord.values`
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;

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

foreach (range(1, 5) as $i) {
    $writeApi->write("point,table=my-table result=$i", InfluxDB2\Model\WritePrecision::MS, $bucket, $org);
}

$writeApi->close();

//
// Query data with pivot
//
$queryApi = $client->createQueryApi();

$result = $queryApi->query(
    "from(bucket: \"$bucket\") |> range(start: -1m) |> filter(fn: (r) => (r[\"_measurement\"] == \"point\"))
|> pivot(rowKey:[\"_time\"], columnKey: [\"_field\"], valueColumn: \"_value\")"
);

//
// Write data to output
//
printf("\n--------------------------------------- FluxRecord.values ----------------------------------------\n");
foreach ($result as $table) {
    foreach ($table->records as $record) {
        $values = implode(", ", $record->values);
        print "$values\n";
    }
}

printf("\n----------------------------------------- FluxRecord.row -----------------------------------------\n");
foreach ($result as $table) {
    foreach ($table->records as $record) {
        $row = implode(", ", $record->row);
        print "$row\n";
    }
}

$client->close();
