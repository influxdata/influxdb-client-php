## 2.4.0 [unreleased]

### Bug Fixes
1. [#101](https://github.com/influxdata/influxdb-client-php/pull/101): Fix parsing Query response with contains new lines in field values

## 2.3.0 [2021-10-22]

### Features
1. [#97](https://github.com/influxdata/influxdb-client-php/pull/97): Add `ping()` to check status of OSS and Cloud instance

### Bug Fixes
1. [#95](https://github.com/influxdata/influxdb-client-php/pull/95): Fix file descriptor leaks in WriteApi
1. [#96](https://github.com/influxdata/influxdb-client-php/pull/96): Fix nanosecond datetime string convertor

### CI
1. [#93](https://github.com/influxdata/influxdb-client-php/pull/93): Switch the PHP 7.1 image to next-gen CircleCI's convenience images

## 2.2.0 [2021-09-17]

### Features
1. [#86](https://github.com/influxdata/influxdb-client-php/pull/86): Add configuration option for `proxy` and `redirects`
2. [#92](https://github.com/influxdata/influxdb-client-php/pull/92): Add configuration option for `ipVersion` [UDP Writer]

### CI
1. [#90](https://github.com/influxdata/influxdb-client-php/pull/90): Switch to next-gen CircleCI's convenience images

## 2.1.0 [2021-08-20]

### Bug Fixes
1. [#84](https://github.com/influxdata/influxdb-client-php/pull/84): Parsing infinite numbers

## 2.0.0 [2021-07-09]

### Breaking Changes

This release introduces a support for new InfluxDB OSS API definitions - [oss.yml](https://github.com/influxdata/openapi/blob/master/contracts/oss.yml). The following breaking changes are in underlying API services and doesn't affect common apis such as - `WriteApi`, `QueryApi`, `BucketsApi`, `OrganizationsApi`...

- `UsersService` uses `PostUser` to create `User`
- `AuthorizationsService` uses `AuthorizationPostRequest` to create `Authorization`
- `BucketsService` uses `PatchBucketRequest` to update `Bucket`
- `OrganizationsService` uses `PostOrganizationRequest` to create `Organization`
- `OrganizationsService` uses `PatchOrganizationRequest` to update `Organization`
- `DashboardsService` uses `PatchDashboardRequest` to update `Dashboard`
- `DeleteService` is used to delete time series data instead of `DefaultService`
- `Run` contains list of `LogEvent` in `Log` property
- `DBRPs` contains list of `DBRP` in `Content` property
- `DBRPsService` uses `DBRPCreate` to create `DBRP`
- Inheritance structure:
    - `Check` <- `CheckDiscriminator` <- `CheckBase`
    - `NotificationEndpoint` <- `NotificationEndpointDiscriminator` <- `NotificationEndpointBase`
    - `NotificationRule` <- `NotificationRuleDiscriminator` <- `NNotificationRuleBase`
- Flux AST literals extends the AST `Expression` object

### API
1. [#79](https://github.com/influxdata/influxdb-client-php/pull/79): Use InfluxDB OSS API definitions to generated APIs

### Bug Fixes
1. [#81](https://github.com/influxdata/influxdb-client-php/pull/81): Compatibility with PHP 7.1 and 7.2

## 1.13.0 [2021-06-04]

### Features
1. [#76](https://github.com/influxdata/influxdb-client-php/pull/76): Exponential random backoff retry strategy

## 1.12.0 [2021-04-01]

### Features
1. [#74](https://github.com/influxdata/influxdb-client-php/pull/74): Allow to change GuzzleHTTP timeout

### API
1. [#71](https://github.com/influxdata/influxdb-client-php/pull/71): Update swagger to the latest version

## 1.11.0 [2021-03-05]

### Features
1. [#65](https://github.com/influxdata/influxdb-client-php/pull/65): `FluxRecord` uses descriptive message for column that doesn't exists
1. [#68](https://github.com/influxdata/influxdb-client-php/pull/68): Moved classes to their own file

### Documentation
1. [#65](https://github.com/influxdata/influxdb-client-php/pull/65): Documentation for the client is located at GitHub: https://influxdata.github.io/influxdb-client-php/

### CI
1. [#67](https://github.com/influxdata/influxdb-client-php/pull/67): Updated stable image to `influxdb:latest` and nightly to `quay.io/influxdb/influxdb:nightly`

## 1.10.0 [2021-01-29]

### Features
1. [#53](https://github.com/influxdata/influxdb-client-php/pull/53): Ability to write via UDP protocol
1. [#57](https://github.com/influxdata/influxdb-client-php/pull/57): Added possibility to disable verification of SSL certificate

### Bug Fixes
1. [#60](https://github.com/influxdata/influxdb-client-php/pull/60): Compatibility with PHP 7.1 and 7.2

### CI
1. [#58](https://github.com/influxdata/influxdb-client-php/pull/58): Updated default docker image to v2.0.3
1. [#60](https://github.com/influxdata/influxdb-client-php/pull/60): Added PHP 8 to CI, Added code style checking to CI

### Documentation
1. [#63](https://github.com/influxdata/influxdb-client-php/pull/63): Updated docs and examples about deleting data

## 1.9.0 [2020-12-04]

### Features
1. [#49](https://github.com/influxdata/influxdb-client-php/pull/49): Added support for Guzzle 7
1. [#51](https://github.com/influxdata/influxdb-client-php/pull/51): CSV parser is able to parse export from UI

### CI
1. [#54](https://github.com/influxdata/influxdb-client-php/pull/54): Updated default docker image to v2.0.2
 
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
