## 1.9.0 [unreleased]

### Features
1. [#49](https://github.com/influxdata/influxdb-client-php/pull/49): Added support for Guzzle 7
1. [#51](https://github.com/influxdata/influxdb-client-php/pull/51): CSV parser is able to parse export from UI

### Documentation

1. [#46](https://github.com/influxdata/influxdb-client-php/pull/46): Adding info about how to get the query in JSON format

## 1.8.0 [2020-10-30]

### Features
1. [#44](https://github.com/influxdata/influxdb-client-php/pull/44): Added generated APIs from swagger for InfluxDB 2.0 management, buckets, organizations, authorizations...
1. [#45](https://github.com/influxdata/influxdb-client-php/pull/45): Improved logging message for retries

## 1.7.0 [2020-10-02]

### Features
1. [#38](https://github.com/influxdata/influxdb-client-php/pull/38): Added jitterInterval to WriteApi

### API
1. [#39](https://github.com/influxdata/influxdb-client-php/issues/39): Default port changed from 9999 -> 8086

## 1.6.0 [2020-08-14]

### Features
1. [#32](https://github.com/influxdata/influxdb-client-php/pull/32): Added retryInterval, maxRetries and maxRetryDelay to WriteOptions in WriteApi
1. [#36](https://github.com/influxdata/influxdb-client-php/pull/35): Added exponentialBase to WriteApi
1. [#34](https://github.com/influxdata/influxdb-client-php/issues/34): Retry strategy now work also for connection errors
1. [#17](https://github.com/influxdata/influxdb-client-php/issues/17): Implemented default tags
1. [#37](https://github.com/influxdata/influxdb-client-php/pull/37): Api generator moved to influxdb-clients-apigen module

### Bug Fixes
1. [#33](https://github.com/influxdata/influxdb-client-php/pull/33): Removed unused flushInterval from WriteApi

## 1.5.0 [2020-07-17]

### Features
1. [#29](https://github.com/influxdata/influxdb-client-php/issues/29): Prevent invalid array access when no write options are passed to the WriteApi.

### Bug Fixes
1. [#27](https://github.com/influxdata/influxdb-client-php/pull/27): Fixed serialization of `\n`, `\r` and `\t` to Line Protocol, `=` is valid sign for measurement name  

## 1.4.0 [2020-06-19]

### API
1. [#27](https://github.com/influxdata/influxdb-client-php/pull/27): Updated swagger to latest version

## 1.3.0 [2020-05-15]

### Bug Fixes

1. [#25](https://github.com/influxdata/influxdb-client-php/pull/25): Fixes a typo in timeout Guzzle option

### Documentation

1. [#24](https://github.com/influxdata/influxdb-client-php/pull/24): Improved documentation about batching

## 1.2.0 [2020-04-17]

### Features
1. [#14](https://github.com/influxdata/influxdb-client-php/pull/14): Checks the health of a running InfluxDB instance by querying the /health

### Documentation

1. [#22](https://github.com/influxdata/influxdb-client-php/pull/22): Clarify how to use a client with InfluxDB 1.8

### Bug Fixes
1. [#19](https://github.com/influxdata/influxdb-client-php/pull/19): Fixed parsing QueryResponse on Windows

## 1.1.0 [2020-03-13]

### Bug Fixes
1. [#13](https://github.com/influxdata/influxdb-client-php/pull/13): Fixed throwing of InvalidArgumentException some option is empty
2. [#13](https://github.com/influxdata/influxdb-client-php/pull/13): FluxCsvParser: fixed throwing FluxQueryException with no reference, default value is 0
3. [#13](https://github.com/influxdata/influxdb-client-php/pull/13): Fixed error when querying empty data, now returns null

## 1.0.0 [2020-03-06]

### Features
1. [#4](https://github.com/influxdata/influxdb-client-php/issues/4): Use Makefile Targets Instead of scripts dir
2. [#7](https://github.com/influxdata/influxdb-client-php/issues/7): Set User-Agent to influxdb-client-php/VERSION for all requests
3. [#5](https://github.com/influxdata/influxdb-client-php/issues/5): Added WriteApi
4. [#8](https://github.com/influxdata/influxdb-client-php/issues/8): Added QueryApi
5. [#12](https://github.com/influxdata/influxdb-client-php/issues/12): Implemented query stream
