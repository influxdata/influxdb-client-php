# influxdb-client-php

[![CircleCI](https://circleci.com/gh/influxdata/influxdb-client-php.svg?style=svg)](https://circleci.com/gh/influxdata/influxdb-client-php)
[![codecov](https://codecov.io/gh/influxdata/influxdb-client-php/branch/master/graph/badge.svg)](https://codecov.io/gh/influxdata/influxdb-client-php)
[![Packagist Version](https://img.shields.io/packagist/v/influxdata/influxdb-client-php)](https://packagist.org/packages/influxdata/influxdb-client-php)
[![License](https://img.shields.io/github/license/influxdata/influxdb-client-php.svg)](https://github.com/influxdata/influxdb-client-php/blob/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues-raw/influxdata/influxdb-client-php.svg)](https://github.com/influxdata/influxdb-client-php/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/influxdata/influxdb-client-php.svg)](https://github.com/influxdata/influxdb-client-php/pulls)
![PHP from Packagist](https://img.shields.io/packagist/php-v/influxdata/influxdb-client-php)
[![Slack Status](https://img.shields.io/badge/slack-join_chat-white.svg?logo=slack&style=social)](https://www.influxdata.com/slack)

This repository contains the reference PHP client for the InfluxDB 2.x.

#### Note: Use this client library with InfluxDB 2.x and InfluxDB 1.8+ ([see details](#influxdb-18-api-compatibility)). For connecting to InfluxDB 1.7 or earlier instances, use the [influxdb-php](https://github.com/influxdata/influxdb-php) client library.

- [Installation](#installation)
    - [Install the library](#install-the-library)
- [Usage](#usage)
    - [Creating a client](#creating-a-client)
    - [Querying data](#queries)
    - [Writing data](#writing-data)
    - [Default Tags](#default-tags)
- [Advanced Usage](#advanced-usage)
    - [Check the server status](#check-the-server-status)
    - [InfluxDB 1.8 API compatibility](#influxdb-18-api-compatibility)
    - [InfluxDB 2.x management API](#influxdb-2x-management-api)
    - [Writing via UDP](#writing-via-udp)
    - [Delete data](#delete-data)
    - [Proxy and redirects](#proxy-and-redirects)
- [Contributing](#contributing)
- [License](#license)

## Documentation

This section contains links to the client library documentation.

* [Product documentation](https://docs.influxdata.com/influxdb/latest/tools/client-libraries/), [Getting Started](#usage)
* [Examples](examples)
* [API Reference](https://influxdata.github.io/influxdb-client-php/) 
* [Changelog](CHANGELOG.md)

## Installation

The client is not hard coupled to HTTP client library like Guzzle, Buzz or something else. 
The client uses general abstractions ([PSR-7 - HTTP messages](https://www.php-fig.org/psr/psr-18/),
[PSR-17 - HTTP factories](https://www.php-fig.org/psr/psr-18/), [PSR-18 - HTTP client](https://www.php-fig.org/psr/psr-18/)) which give you
freedom to use your favorite one.

### Install the library

The InfluxDB 2 client is bundled and hosted on [https://packagist.org/](https://packagist.org/packages/influxdata/influxdb-client-php) and can be installed with composer:

```
composer require influxdata/influxdb-client-php guzzlehttp/guzzle
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

| Option           | Description                                                                                               | Note                                    | Type                              | Default      |
|------------------|-----------------------------------------------------------------------------------------------------------|-----------------------------------------|-----------------------------------|--------------|
| **url**          | InfluxDB server API url (e.g. http://localhost:8086)                                                      | **required**                            | String                            | none         |
| **token**        | Token to use for the authorization                                                                        | **required**                            | String                            | none         |
| bucket           | Default destination bucket for writes                                                                     |                                         | String                            | none         |
| org              | Default destination organization for writes                                                               |                                         | String                            | none         |
| precision        | Default precision for the unix timestamps within the body line-protocol                                   |                                         | String                            | none         |
| allow_redirects  | Enable HTTP redirects                                                                                     |                                         | bool                              | true         |
| debug            | Enable verbose logging of http requests                                                                   |                                         | bool                              | false        |
| logFile          | Default output for logs                                                                                   |                                         | bool                              | php://output |
| httpClient       | Configured HTTP client to use for communication with InfluxDB                                             |                                         | `Psr\Http\Client\ClientInterface` | none         |
| verifySSL        | Turn on/off SSL certificate verification. Set to `false` to disable certificate verification.             | :warning: required `Guzzle` HTTP client | bool                              | true         |
| timeout          | Describing the number of seconds to wait while trying to connect to a server. Use 0 to wait indefinitely. | :warning: required `Guzzle` HTTP client | int                               | 10           |
| proxy            | specify an HTTP proxy, or an array to specify different proxies for different protocols.                  | :warning: required `Guzzle` HTTP client | string                            | none         |

#### Custom HTTP client

The following code shows how to use and configure [cURL](https://github.com/php-http/curl-client) HTTP client:

##### Install dependencies via composer

```
composer require influxdata/influxdb-client-php nyholm/psr7 php-http/curl-client
```

##### Configure cURL client

```php
$curlOptions = [
    CURLOPT_CONNECTTIMEOUT => 30, // The number of seconds to wait while trying to connect.
];
$curlClient = new Http\Client\Curl\Client(
    Http\Discovery\Psr17FactoryDiscovery::findRequestFactory(),
    Http\Discovery\Psr17FactoryDiscovery::findStreamFactory(),
    $curlOptions
);
```

##### Initialize InfluxDB client

```php
$client = new Client([
    "url" => "http://localhost:8086",
    "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "httpClient" => $curlClient
]);
```

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
### Parameterized queries
InfluxDB Cloud supports [Parameterized Queries](https://docs.influxdata.com/influxdb/cloud/query-data/parameterized-queries/)
that let you dynamically change values in a query using the InfluxDB API. Parameterized queries make Flux queries more
reusable and can also be used to help prevent injection attacks.

InfluxDB Cloud inserts the params object into the Flux query as a Flux record named `params`. Use dot or bracket
notation to access parameters in the `params` record in your Flux query. Parameterized Flux queries support only `int`
, `float`, and `string` data types. To convert the supported data types into
other [Flux basic data types, use Flux type conversion functions](https://docs.influxdata.com/influxdb/cloud/query-data/parameterized-queries/#supported-parameter-data-types).

Parameterized query example:
> :warning: Parameterized Queries are supported only in InfluxDB Cloud, currently there is no support in InfluxDB OSS.

```php
<?php
require __DIR__ . '/../vendor/autoload.php';

use InfluxDB2\Client;
use InfluxDB2\Model\Query;
use InfluxDB2\Point;
use InfluxDB2\WriteType as WriteType;

$url = "https://us-west-2-1.aws.cloud2.influxdata.com";
$organization = 'my-org';
$bucket = 'my-bucket';
$token = 'my-token';

$client = new Client([
    "url" => $url,
    "token" => $token,
    "bucket" => $bucket,
    "org" => $organization,
    "precision" => InfluxDB2\Model\WritePrecision::NS,
    "debug" => false
]);

$writeApi = $client->createWriteApi(["writeType" => WriteType::SYNCHRONOUS]);
$queryApi = $client->createQueryApi();

$today = new DateTime("now");
$yesterday = $today->sub(new DateInterval("P1D"));

$p = new Point("temperature");
$p->addTag("location", "north")->addField("value", 60)->time($yesterday);
$writeApi->write($p);
$writeApi->close();

//
// Query range start parameter using duration
//
$parameterizedQuery = "from(bucket: params.bucketParam) |> range(start: duration(v: params.startParam))";
$query = new Query();
$query->setQuery($parameterizedQuery);
$query->setParams(["bucketParam" => "my-bucket", "startParam" => "-1d"]);
$tables = $queryApi->query($query);

foreach ($tables as $table) {
    foreach ($table->records as $record) {
        var_export($record->values);
    }
}

//
// Query range start parameter using DateTime
//
$parameterizedQuery = "from(bucket: params.bucketParam) |> range(start: time(v: params.startParam))";
$query->setParams(["bucketParam" => "my-bucket", "startParam" => $yesterday]);
$query->setQuery($parameterizedQuery);
$tables = $queryApi->query($query);

foreach ($tables as $table) {
    foreach ($table->records as $record) {
        var_export($record->values);
    }
}

$client->close();
```

### Writing data

The [WriteApi](https://github.com/influxdata/influxdb-client-php/blob/master/src/InfluxDB2/WriteApi.php) supports 
synchronous and batching writes into InfluxDB 2.x. In default api uses synchronous write. To enable batching you 
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
#### Batching

The writes are processed in batches which are configurable by `WriteOptions`:

| Property            | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                  | Default Value |
|---------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------|
| **writeType**       | type of write SYNCHRONOUS / BATCHING /                                                                                                                                                                                                                                                                                                                                                                                                                                       | SYNCHRONOUS   |
| **batchSize**       | the number of data point to collect in batch                                                                                                                                                                                                                                                                                                                                                                                                                                 | 10            |
| **retryInterval**   | the number of milliseconds to retry unsuccessful write. The retry interval is "exponentially" used when the InfluxDB server does not specify "Retry-After" header.                                                                                                                                                                                                                                                                                                           | 5000          |
| **jitterInterval**  | the number of milliseconds before the data is written increased by a random amount                                                                                                                                                                                                                                                                                                                                                                                           | 0             |
| **maxRetries**      | the number of max retries when write fails                                                                                                                                                                                                                                                                                                                                                                                                                                   | 5             |
| **maxRetryDelay**   | maximum delay when retrying write in milliseconds                                                                                                                                                                                                                                                                                                                                                                                                                            | 125000        |
| **maxRetryTime**    | maximum total retry timeout in milliseconds                                                                                                                                                                                                                                                                                                                                                                                                                                  | 180000        |
| **exponentialBase** | the base for the exponential retry delay, the next delay is computed using random exponential backoff as a random value within the interval  ``retryInterval * exponentialBase^(attempts-1)`` and ``retryInterval * exponentialBase^(attempts)``. Example for ``retryInterval=5000, exponentialBase=2, maxRetryDelay=125000, total=5`` Retry delays are random distributed values within the ranges of ``[5000-10000, 10000-20000, 20000-40000, 40000-80000, 80000-125000]`` | 2             | 
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

Server availability can be checked using the `$client->ping();` method. That is equivalent of the [influx ping](https://docs.influxdata.com/influxdb/latest/reference/cli/influx/ping/).

### InfluxDB 1.8 API compatibility

[InfluxDB 1.8.0 introduced forward compatibility APIs](https://docs.influxdata.com/influxdb/v1.8/tools/api/#influxdb-2-0-api-compatibility-endpoints) for InfluxDB 2.x. This allow you to easily move from InfluxDB 1.x to InfluxDB 2.x Cloud or open source.

The following forward compatible APIs are available:

| API                                          | Endpoint                                                                                           | Description                                                                                                                                                                                                                                                    |
|:---------------------------------------------|:---------------------------------------------------------------------------------------------------|:---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| [QueryApi.php](src/InfluxDB2/QueryApi.php)   | [/api/v2/query](https://docs.influxdata.com/influxdb/latest/tools/api/#api-v2-query-http-endpoint) | Query data in InfluxDB 1.8.0+ using the InfluxDB 2.x API and [Flux](https://docs.influxdata.com/flux/latest/) _(endpoint should be enabled by [`flux-enabled` option](https://docs.influxdata.com/influxdb/latest/administration/config/#flux-enabled-false))_ |
| [WriteApi.php](src/InfluxDB2/WriteApi.php)   | [/api/v2/write](https://docs.influxdata.com/influxdb/latest/tools/api/#api-v2-write-http-endpoint) | Write data to InfluxDB 1.8.0+ using the InfluxDB 2.x API                                                                                                                                                                                                       |
| [HealthApi.php](src/InfluxDB2/HealthApi.php) | [/health](https://docs.influxdata.com/influxdb/latest/tools/api/#health-http-endpoint)             | Check the health of your InfluxDB instance                                                                                                                                                                                                                     |    

For detail info see [InfluxDB 1.8 example](examples/InfluxDB_18_Example.php).

### InfluxDB 2.x management API

InfluxDB 2.x API client is generated using [`influxdb-clients-apigen`](https://github.com/bonitoo-io/influxdb-clients-apigen). Sources are in `InfluxDB2\Service\`  and `InfluxDB2\Model\` packages.

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
### Writing via UDP

Sending via UDP will be useful in cases when the execution time is critical to avoid potential delays (even timeouts) in sending metrics to the InfluxDB while are problems with the database or network connectivity.  
As is known, sending via UDP occurs without waiting for a response, unlike TCP (HTTP).

UDP Writer Requirements:
1. Installed ext-sockets
2. Since Influxdb 2.0+ does not support UDP protocol natively you need to install and configure Telegraf plugin: https://docs.influxdata.com/telegraf/v1.16/plugins/#socket_listener
3. Extra config option passed to client: udpPort. Optionally you can specify udpHost, otherwise udpHost will parsed from url option
4. Extra config option passed to client: ipVersion. Optionally you can specify the ip version, defaults to IPv4
 
```php
$client = new InfluxDB2\Client(["url" => "http://localhost:8086", "token" => "my-token",
    "bucket" => "my-bucket",
    "org" => "my-org",
    "precision" => InfluxDB2\Model\WritePrecision::NS,
    "udpPort" => 8094,
    "ipVersion" => 6,
]);
$writer = $client->createUdpWriter();
$writer->write('h2o,location=west value=33i 15');
$writer->close();
 ```

### Delete data

The [DefaultService.php](/src/InfluxDB2/Service/DefaultService.php) supports deletes [points](https://docs.influxdata.com/influxdb/latest/reference/syntax/line-protocol/) from an InfluxDB bucket.

```php
<?php
/**
 * Shows how to delete data from InfluxDB by client
 */
use InfluxDB2\Client;
use InfluxDB2\Model\DeletePredicateRequest;
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
// Delete data by measurement and tag value
//
/** @var DeleteService $service */
$service = $client->createService(DeleteService::class);

$predicate = new DeletePredicateRequest();
$predicate->setStart(DateTime::createFromFormat('Y', '2020'));
$predicate->setStop(new DateTime());
$predicate->setPredicate("_measurement=\"mem\" AND host=\"host1\"");

$service->postDelete($predicate, null, $org, $bucket);

$client->close();
```

For more details see [DeleteDataExample.php](examples/DeleteDataExample.php).

### Proxy and redirects

You can configure InfluxDB PHP client behind a proxy in two ways:

##### 1. Using environment variable
Set environment variable `HTTP_PROXY` or `HTTPS_PROXY` based on the scheme of your server url. For more info see Guzzle docs - [environment Variables](https://docs.guzzlephp.org/en/5.3/clients.html?highlight=PROXY#environment-variables).

##### 2. Configure client to use proxy via Options
You can pass a `proxy` configuration when creating the client:
```php
$client = new InfluxDB2\Client([
  "url" => "http://localhost:8086", 
  "token" => "my-token",
  "bucket" => "my-bucket",
  "org" => "my-org",
  "proxy" => "http://192.168.16.1:10",
]);
```
For more info see Guzzle docs - [proxy](https://docs.guzzlephp.org/en/5.3/clients.html?highlight=PROXY#proxy).

#### Redirects

Client automatically follows HTTP redirects. You can configure redirects behaviour by  a `allow_redirects` configuration:
```php
$client = new InfluxDB2\Client([
  "url" => "http://localhost:8086", 
  "token" => "my-token",
  "bucket" => "my-bucket",
  "org" => "my-org",
  "allow_redirects" => false,
]);
```
For more info see Redirect Plugin docs - [allow_redirects](https://docs.php-http.org/en/latest/plugins/redirect.html#redirect-plugin)

## Local tests

Run once to install dependencies:

```shell script
make deps
```

Run unit & intergration tests:

```shell script
make test
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/influxdata/influxdb-client-php.

## License

The gem is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
