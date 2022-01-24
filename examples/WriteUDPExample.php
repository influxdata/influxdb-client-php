<?php

/**
 * Shows how to write data to InfluxDB via UDP
 *
 *  UDP Writer Requirements:
 *      1. Installed ext-sockets
 *      2. Since Influxdb 2.0+ does not support UDP protocol natively you need to install and configure
 *         Telegraf plugin: https://docs.influxdata.com/telegraf/v1.16/plugins/#socket_listener
 *      3. Extra config option passed to client: udpPort. Optionally you can specify udpHost,
 *         otherwise udpHost will parse from url option
 *      4. Extra config option passed to client: ipVersion. Optionally you can specify the ip version,
 *         defaults to IPv4
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;

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
// Write data to InfluxDB via UDP Writer
//
try {
    $seconds = time();
    $temp = rand(5, 25)."i";

    $writeApi = $client->createUdpWriter();
    $writeApi->write("weather,location=Tokio temperature=$temp $seconds");
    $writeApi->close();

    //
    // Check result
    //
    $query = "from(bucket: \"my-bucket\")
    |> range(start: 0)
    |> filter(fn: (r) => r[\"location\"] == \"Tokio\")";
    $queryApi = $client->createQueryApi();
    $result = $queryApi->query($query);
    foreach ($result as $table) {
        foreach ($table->records as $record) {
            $location = $record["location"];
            $temperature = $record->getValue();
            $measurement = $record->getMeasurement();
            $dateTime = $record->getTime();
            print "$measurement:   Temperature in $location at $dateTime is $temperature °C\n";
        }
    }
} catch (Exception|Throwable $e) {
    print "\n\n $e \n\n";
}

$client->close();
