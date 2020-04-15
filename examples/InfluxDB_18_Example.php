<?php
/**
 * Shows how to use forward compatibility APIs from InfluxDB 1.8.
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Point;

$username = 'username';
$password = 'password';

$database = 'telegraf';
$retentionPolicy = 'autogen';

$bucket = "$database/$retentionPolicy";

$client = new Client([
    "url" => "http://localhost:8086",
    "token" => "$username:$password",
    "bucket" => $bucket,
    "org" => "-",
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

$writeApi = $client->createWriteApi();
$point = Point::measurement("mem")
    ->addTag("host", "host1")
    ->addField("used_percent", 24.43234543)
    ->time(microtime(true));
$writeApi->write($point);
$writeApi->close();

$queryApi = $client->createQueryApi();
$query = "from(bucket: \"{$bucket}\") |> range(start: -1h)";
$tables = $queryApi->query($query);

foreach ($tables as $table) {
    foreach ($table->records as $record) {
        $time = $record->getTime();
        $measurement = $record->getMeasurement();
        $value = $record->getValue();
        print "$time $measurement is $value\n";
    }
}
