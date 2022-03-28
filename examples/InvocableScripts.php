<?php
/**
 * Show to use Invocable scripts Cloud API to create custom endpoints that query data
 *
 * Invocable Scripts are supported only in InfluxDB Cloud, currently there is no support in InfluxDB OSS.
 */

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;

$organization = 'my-org';
$bucket = 'my-bucket';
$token = 'my-token';

//
// Creating client
//
$client = new Client([
    "url" => "https://us-west-2-1.aws.cloud2.influxdata.com",
    "token" => $token,
    "bucket" => $bucket,
    "org" => $organization,
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

//
// Creating InvocableScripts Api
//
$invocableScriptsApi = $client->createInvocableScriptsApi();


$client->close();
