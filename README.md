# influxdb-client-php

[![CircleCI](https://circleci.com/gh/influxdata/influxdb-client-php.svg?style=svg)](https://circleci.com/gh/influxdata/influxdb-client-php)
[![codecov](https://codecov.io/gh/influxdata/influxdb-client-php/branch/master/graph/badge.svg)](https://codecov.io/gh/influxdata/influxdb-client-php)
[![Packagist Version](https://img.shields.io/packagist/v/influxdata/influxdb-client-php)](https://packagist.org/packages/influxdata/influxdb-client-php)
[![License](https://img.shields.io/github/license/influxdata/influxdb-client-php.svg)](https://github.com/influxdata/influxdb-client-php/blob/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues-raw/influxdata/influxdb-client-php.svg)](https://github.com/influxdata/influxdb-client-php/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/influxdata/influxdb-client-php.svg)](https://github.com/influxdata/influxdb-client-php/pulls)
![PHP from Packagist](https://img.shields.io/packagist/php-v/influxdata/influxdb-client-php)
[![Slack Status](https://img.shields.io/badge/slack-join_chat-white.svg?logo=slack&style=social)](https://www.influxdata.com/slack)

This repository contains the reference PHP client for the InfluxDB 2.0.

#### Note: Use this client library with InfluxDB 2.x and InfluxDB 1.8+ ([see details](#influxdb-18-api-compatibility)). For connecting to InfluxDB 1.7 or earlier instances, use the [influxdb-php](https://github.com/influxdata/influxdb-php) client library.

#### Disclaimer: This library is a work in progress and should not be considered production ready yet.

## Installation

The InfluxDB 2 client is bundled and hosted on [https://packagist.org/](https://packagist.org/packages/influxdata/influxdb-client-php).

### Install the library

The client can be installed with composer.

```
composer require influxdata/influxdb-client-php
```

## Usage

### Creating a client

Use `InfluxDB2\Client` to create a client connected to a running InfluxDB 2 instance.

```php
$client = new InfluxDB2\Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::NS
]);
```

#### Client Options

| Option | Description | Type | Default |
|---|---|---|---|
| bucket | Default destination bucket for writes | String | none |
| org | Default organization bucket for writes | String | none |
| precision | Default precision for the unix timestamps within the body line-protocol | String | none |


<!--- TODO
| open_timeout | Number of seconds to wait for the connection to open | Integer | 10 |
| write_timeout | Number of seconds to wait for one block of data to be written | Integer | 10 |
| read_timeout | Number of seconds to wait for one block of data to be read | Integer | 10 |
-->

### Queries

The result retrieved by [QueryApi](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/QueryApi.php) could be formatted as a:

   1. Raw query response
   2. Flux data structure: [FluxTable](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/FluxTable.php), [FluxColumn](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/FluxColumn.php) and [FluxRecord](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/FluxRecord.php)
   3. Stream of [FluxRecord](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/FluxRecord.php)

#### Query raw

Synchronously executes the Flux query and return result as unprocessed String
```php
$this->client = new Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "precision" => WritePrecision::NS,
    "org" => "my-org",
    "debug" => false
]);

$this->queryApi = $this->client->createQueryApi();

$result = $this->queryApi->queryRaw(
            'from(bucket:"my-bucket") |> range(start: 1970-01-01T00:00:00.000000001Z) |> last()');
```
#### Synchronous query
Synchronously executes the Flux query and return result as a Array of [FluxTables](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/FluxTable.php)
```php
$this->client = new Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "precision" => WritePrecision::NS,
    "org" => "my-org",
    "debug" => false
]);

$this->queryApi = $this->client->createQueryApi();

$result = $this->queryApi->query(
            'from(bucket:"my-bucket") |> range(start: 1970-01-01T00:00:00.000000001Z) |> last()');
```
This can then easily be encoded to JSON with [json_encode](https://www.php.net/manual/en/function.json-encode.php)
```php
header('Content-type:application/json;charset=utf-8');
echo json_encode( $result, JSON_PRETTY_PRINT ) ;
```

#### Query stream
Synchronously executes the Flux query and return stream of [FluxRecord](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/FluxRecord.php)
```php
$this->client = new Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "precision" => WritePrecision::NS,
    "org" => "my-org",
    "debug" => false
]);

$this->queryApi = $this->client->createQueryApi();

$parser = $this->queryApi->queryStream(
            'from(bucket:"my-bucket") |> range(start: 1970-01-01T00:00:00.000000001Z) |> last()');

foreach ($parser->each() as $record)
{
    ...
}
```

### Writing data

The [WriteApi](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/WriteApi.php) supports 
synchronous and batching writes into InfluxDB 2.0. In default api uses synchronous write. To enable batching you 
can use WriteOption.

```php
$client = new InfluxDB2\Client(["url" => "http://localhost:8086", "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::NS
]);
$write_api = $client->createWriteApi();
$write_api->write('h2o,location=west value=33i 15');
```
#### Writing via UDP

UDP Writer Requirements:
1. Installed ext-sockets
1. Since Influxdb 2.0+ does not support UDP protocol natively you need to install and configure Telegraf plugin: https://docs.influxdata.com/telegraf/v1.16/plugins/#socket_listener
1. Extra config option passed to client: udpPort. Optionally you can specify udpHost, otherwise udpHost will parsed from url option
 
```php
$client = new InfluxDB2\Client(["url" => "http://localhost:8086", "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::NS,
    "udpPort" => 8094,
]);
$writer = $client->createUdpWriter();
$writer->write('h2o,location=west value=33i 15');
 ```
#### Batching

The writes are processed in batches which are configurable by `WriteOptions`:

| Property | Description | Default Value |
| --- | --- | --- |
| **writeType** | type of write SYNCHRONOUS / BATCHING /  | SYNCHRONOUS |
| **batchSize** | the number of data point to collect in batch | 10 |
| **retryInterval** | the number of milliseconds to retry unsuccessful write. The retry interval is "exponentially" used when the InfluxDB server does not specify "Retry-After" header. | 5000 |
| **jitterInterval** | the number of milliseconds before the data is written increased by a random amount | 0 |
| **maxRetries** | the number of max retries when write fails | 5 |
| **maxRetryDelay** | maximum delay when retrying write in milliseconds | 180000 |
| **exponentialBase** | the base for the exponential retry delay, the next delay is computed as `retryInterval * exponentialBase^(attempts-1)` | 5 | 
```php
use InfluxDB2\Client;
use InfluxDB2\WriteType as WriteType;

$client = new Client(["url" => "http://localhost:8086", "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::NS
]);

$writeApi = $client->createWriteApi(
    ["writeType" => WriteType::BATCHING, 'batchSize' => 1000]);

foreach (range(1, 10000) as $number) {
    $writeApi->write("mem,host=aws_europe,type=batch value=1i $number");
}

// flush remaining data
$writeApi->close();
```

#### Time precision

Configure default time precision:
```php
$client = new InfluxDB2\Client(["url" => "http://localhost:8086", "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => \InfluxDB2\Model\WritePrecision::NS
]);
```

Configure precision per write:
```php
$client = new InfluxDB2\Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
]);

$writeApi = $client->createWriteApi();
$writeApi->write('h2o,location=west value=33i 15', \InfluxDB2\Model\WritePrecision::MS);
```
Allowed values for precision are:

- `WritePrecision::NS` for nanosecond
- `WritePrecision::US`   for microsecond
- `WritePrecision::MS`  for millisecond
- `WritePrecision::S` for second

#### Configure destination

Default `bucket` and `organization` destination are configured via `InfluxDB2\Client`:

```php
$client = new InfluxDB2\Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
]);
```

but there is also possibility to override configuration per write:

```php
$client = new InfluxDB2\Client(["url" => "http://localhost:8086", "token" => "my-token"]);

$writeApi = $client->createWriteApi();
$writeApi->write('h2o,location=west value=33i 15', \InfluxDB2\Model\WritePrecision::MS, "production-bucket", "customer-1");
```

#### Data format

The data could be written as:

1. `string` that is formatted as a InfluxDB's line protocol
1. `array` with keys: name, tags, fields and time
1. [Data Point](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/Point.php) structure
1. `Array` of above items

```php
$client = new InfluxDB2\Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::US
]);

$writeApi = $client->createWriteApi();

//data in Point structure
$point=InfluxDB2\Point::measurement("h2o")
    ->addTag("location", "europe")
    ->addField("level",2)
    ->time(microtime(true));

$writeApi->write($point);

//data in array structure
$dataArray = ['name' => 'cpu', 
    'tags' => ['host' => 'server_nl', 'region' => 'us'],
    'fields' => ['internal' => 5, 'external' => 6],
    'time' => microtime(true)];

$writeApi->write($dataArray);

//write lineprotocol
$writeApi->write('h2o,location=west value=33i 15');
```

#### Default Tags

Sometimes is useful to store same information in every measurement e.g. `hostname`, `location`, `customer`. 
The client is able to use static value, app settings or env variable as a tag value.

The expressions:
- `California Miner` - static value
- `${env.hostname}` - environment property

##### Via API

```php
$this->client = new Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "precision" => WritePrecision::NS,
    "org" => "my-org",
    "tags" => ['id' => '132-987-655', 
        'hostname' => '${env.Hostname}']
]);

$writeApi = $this->client->createWriteApi(null, ['data_center' => '${env.data_center}']);
    
$writeApi->pointSettings->addDefaultTag('customer', 'California Miner');

$point = Point::measurement('h2o')
            ->addTag('location', 'europe')
            ->addField('level', 2);

$this->writeApi->write($point);
```

## Advanced Usage

### Check the server status 

Server availability can be checked using the `$client->health();` method. That is equivalent of the [influx ping](https://v2.docs.influxdata.com/v2.0/reference/cli/influx/ping/).

### InfluxDB 1.8 API compatibility

[InfluxDB 1.8.0 introduced forward compatibility APIs](https://docs.influxdata.com/influxdb/latest/tools/api/#influxdb-2-0-api-compatibility-endpoints) for InfluxDB 2.0. This allow you to easily move from InfluxDB 1.x to InfluxDB 2.0 Cloud or open source.

The following forward compatible APIs are available:

| API | Endpoint | Description |
|:----------|:----------|:----------|
| [QueryApi.php](src/InfluxDB2/QueryApi.php) | [/api/v2/query](https://docs.influxdata.com/influxdb/latest/tools/api/#api-v2-query-http-endpoint) | Query data in InfluxDB 1.8.0+ using the InfluxDB 2.0 API and [Flux](https://docs.influxdata.com/flux/latest/) _(endpoint should be enabled by [`flux-enabled` option](https://docs.influxdata.com/influxdb/latest/administration/config/#flux-enabled-false))_ |
| [WriteApi.php](src/InfluxDB2/WriteApi.php) | [/api/v2/write](https://docs.influxdata.com/influxdb/latest/tools/api/#api-v2-write-http-endpoint) | Write data to InfluxDB 1.8.0+ using the InfluxDB 2.0 API |
| [HealthApi.php](src/InfluxDB2/HealthApi.php) | [/health](https://docs.influxdata.com/influxdb/latest/tools/api/#health-http-endpoint) | Check the health of your InfluxDB instance |    

For detail info see [InfluxDB 1.8 example](examples/InfluxDB_18_Example.php).

### InfluxDB 2.0 management API

InfluxDB 2.0 API client is generated using [`influxdb-clients-apigen`](https://github.com/bonitoo-io/influxdb-clients-apigen). Sources are in `InfluxDB2\Service\`  and `InfluxDB2\Model\` packages.

The following example shows how to use `OrganizationService` and `BucketService` to create a new bucket.  

```php

require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Model\BucketRetentionRules;
use InfluxDB2\Model\Organization;
use InfluxDB2\Model\PostBucketRequest;
use InfluxDB2\Service\BucketsService;
use InfluxDB2\Service\OrganizationsService;

$organization = 'my-org';
$bucket = 'my-bucket';
$token = 'my-token';

$client = new Client([
    "url" => "http://localhost:8086",
    "token" => $token,
    "bucket" => $bucket,
    "org" => $organization,
    "precision" => InfluxDB2\Model\WritePrecision::S
]);

function findMyOrg($client): ?Organization
{
    /** @var OrganizationsService $orgService */
    $orgService = $client->createService(OrganizationsService::class);
    $orgs = $orgService->getOrgs()->getOrgs();
    foreach ($orgs as $org) {
        if ($org->getName() == $client->options["org"]) {
            return $org;
        }
    }
    return null;
}

$bucketsService = $client->createService(BucketsService::class);

$rule = new BucketRetentionRules();
$rule->setEverySeconds(3600);

$bucketName = "example-bucket-" . microtime();
$bucketRequest = new PostBucketRequest();
$bucketRequest->setName($bucketName)
    ->setRetentionRules([$rule])
    ->setOrgId(findMyOrg($client)->getId());

//create bucket
$respBucket = $bucketsService->postBuckets($bucketRequest);
print $respBucket;

$client->close();


```

## Local tests

```shell script
# run unit & integration tests
make test
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/influxdata/influxdb-client-php.

## License

The gem is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
