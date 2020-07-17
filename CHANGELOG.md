## 1.6.0 [unreleased]

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
