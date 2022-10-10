# Examples

## Writes
- [WriteExample.php](WriteExample.php) - How to write data to InfluxDB via default API using `Point` structure or line protocol
- [WriteBatchingExample.php](WriteBatchingExample.php) - How to use batching for more performance writes
- [WriteUDPExample.php](WriteUDPExample.php) - How to write data to InfluxDB via UDP

## Queries
- [QueryRawExample.php](QueryRawExample.php) - How to query data into `string`
- [QueryExample.php](QueryExample.php) - How to query data into `FluxTable` and encode results into JSON
- [QueryStreamExample.php](QueryStreamExample.php) - How to query data into `Stream`
- [QueryProfilerExample.php](QueryProfilerExample.php) - How to query data with profilers
- [QueryFromFileExample.php](QueryFromFileExample.php) - How to use a Flux query defined in a separate file
- [ParameterizedQuery.php](ParameterizedQuery.php) - How to use parameterized Flux queries

## Management API
- [BucketManagementExample.php](BucketManagementExample.php) - How to create, list and delete Buckets

## Others
- [InfluxDB_18_Example.php](InfluxDB_18_Example.php) - How to use forward compatibility APIs from InfluxDB 1.8
- [DeleteDataExample.php](DeleteDataExample.php) - How to delete data from InfluxDB by client
- [InvokableScripts.php](InvokableScripts.php) - How to use Invokable scripts Cloud API to create custom endpoints that query data
- [RecordRowExample.php](RecordRowExample.php) - How to use `FluxRecord.row` instead of `FluxRecord.values`,
  in case of duplicity column names