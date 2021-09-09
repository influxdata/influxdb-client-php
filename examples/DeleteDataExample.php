<?php
/**
 * Shows how to delete data from InfluxDB by client
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Model\DeletePredicateRequest;
use InfluxDB2\Point;
use InfluxDB2\Service\DeleteService;

$url = 'http://localhost:8086';
$token = 'my-token';
$org = 'my-org';
$bucket = 'my-bucket';

$client = new Client([
    "url" => $url,
    "token" => $token,
    "bucket" => $bucket,
    "org" => $org,
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

//
// Write data into InfluxDB
//
$writeApi = $client->createWriteApi();
$point1 = Point::measurement("mem")
    ->addTag("host", "host1")
    ->addField("used_percent", 24.43234543);
$point2 = Point::measurement("mem")
    ->addTag("host", "host2")
    ->addField("used_percent", 54.43234543);
$writeApi->write(array($point1, $point2));
$writeApi->close();

//
// Delete data by tag value: 'host = host2'
//
/** @var DeleteService $service */
$service = $client->createService(DeleteService::class);

$predicate = new DeletePredicateRequest();
$predicate->setStart(DateTime::createFromFormat('Y', '2020'));
$predicate->setStop(new DateTime());
$predicate->setPredicate("_measurement=\"mem\" AND host=\"host1\"");
$service->postDelete($predicate, null, $org, $bucket);

//
// Query Data
//
$queryApi = $client->createQueryApi();
$query = "from(bucket: \"{$bucket}\") |> range(start: -1h)";
$tables = $queryApi->query($query);

foreach ($tables as $table) {
    foreach ($table->records as $record) {
        $time = $record->getTime();
        $measurement = $record->getMeasurement();
        $value = $record->getValue();
        $host = $record->values["host"];
        print "$time $measurement is $value for host: $host\n";
    }
}

$client->close();
