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

#### Note: This library is for use with InfluxDB 2.x. For connecting to InfluxDB 1.x instances, please use the [influxdb-php](https://github.com/influxdata/influxdb-php) client.
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
    "url" => "http://localhost:9999",
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
    "url" => "http://localhost:9999",
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
    "url" => "http://localhost:9999",
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

#### Query stream
Synchronously executes the Flux query and return stream of [FluxRecord](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/FluxRecord.php)
```php
$this->client = new Client([
    "url" => "http://localhost:9999",
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
$client = new InfluxDB2\Client(["url" => "http://localhost:9999", "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::NS
]);
$write_api = $client->createWriteApi();
$write_api->write('h2o,location=west value=33i 15');
```

<!--- TODO still in progress
#### Batching

The writes are processed in batches which are configurable by `WriteOptions`:

| Property | Description | Default Value |
| --- | --- | --- |
| **writeType** | type of write SYNCHRONOUS / BATCHING /  | SYNCHRONOUS |
| **batchSize** | the number of data point to collect in batch | 1000 |
| **flushInterval** | the number of milliseconds before the batch is written | 1000 |

```php
$client = new InfluxDB2\Client(["url" => "http://localhost:9999", "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::NS
]);

$writeApi = $client->createWriteApi(
    ["writeType"=>InfluxDB2\WriteType::BATCHING, 'batchSize'=>1000, "flushInterval" =>1000]);

$writeApi->write('h2o,location=west value=33i 15');
```
-->

#### Time precision

Configure default time precision:
```php
$client = new InfluxDB2\Client(["url" => "http://localhost:9999", "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => \InfluxDB2\Model\WritePrecision::NS
]);
```

Configure precision per write:
```php
$client = new InfluxDB2\Client([
    "url" => "http://localhost:9999",
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
    "url" => "http://localhost:9999",
    "token" => "my-token",
    "bucket" => "my-bucket",
]);
```

but there is also possibility to override configuration per write:

```php
$client = new InfluxDB2\Client(["url" => "http://localhost:9999", "token" => "my-token"]);

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
    "url" => "http://localhost:9999",
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
    ->time(microtime());

$writeApi->write($point);

//data in array structure
$dataArray = ['name' => 'cpu', 
    'tags' => ['host' => 'server_nl', 'region' => 'us'],
    'fields' => ['internal' => 5, 'external' => 6],
    'time' => microtime()];

$writeApi->write($dataArray);

//write lineprotocol
$writeApi->write('h2o,location=west value=33i 15');
```

## Advanced Usage

### Check the server status 

Server availability can be checked using the `$client->health();` method. That is equivalent of the [influx ping](https://v2.docs.influxdata.com/v2.0/reference/cli/influx/ping/).

## Local tests

```shell script
# run unit & integration tests
make test
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/influxdata/influxdb-client-php.

## License

The gem is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
