# InfluxDB2Generated\OperationLogsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**bucketsBucketIDLogsGet**](OperationLogsApi.md#bucketsBucketIDLogsGet) | **GET** /buckets/{bucketID}/logs | Retrieve operation logs for a bucket
[**dashboardsDashboardIDLogsGet**](OperationLogsApi.md#dashboardsDashboardIDLogsGet) | **GET** /dashboards/{dashboardID}/logs | Retrieve operation logs for a dashboard
[**orgsOrgIDLogsGet**](OperationLogsApi.md#orgsOrgIDLogsGet) | **GET** /orgs/{orgID}/logs | Retrieve operation logs for an organization
[**usersUserIDLogsGet**](OperationLogsApi.md#usersUserIDLogsGet) | **GET** /users/{userID}/logs | Retrieve operation logs for a user



## bucketsBucketIDLogsGet

> \InfluxDB2Generated\Model\OperationLogs bucketsBucketIDLogsGet($bucket_id, $zap_trace_span, $offset, $limit)

Retrieve operation logs for a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OperationLogsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$offset = 56; // int | 
$limit = 20; // int | 

try {
    $result = $apiInstance->bucketsBucketIDLogsGet($bucket_id, $zap_trace_span, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OperationLogsApi->bucketsBucketIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **offset** | **int**|  | [optional]
 **limit** | **int**|  | [optional] [default to 20]

### Return type

[**\InfluxDB2Generated\Model\OperationLogs**](../Model/OperationLogs.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDLogsGet

> \InfluxDB2Generated\Model\OperationLogs dashboardsDashboardIDLogsGet($dashboard_id, $zap_trace_span, $offset, $limit)

Retrieve operation logs for a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OperationLogsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$offset = 56; // int | 
$limit = 20; // int | 

try {
    $result = $apiInstance->dashboardsDashboardIDLogsGet($dashboard_id, $zap_trace_span, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OperationLogsApi->dashboardsDashboardIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **offset** | **int**|  | [optional]
 **limit** | **int**|  | [optional] [default to 20]

### Return type

[**\InfluxDB2Generated\Model\OperationLogs**](../Model/OperationLogs.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## orgsOrgIDLogsGet

> \InfluxDB2Generated\Model\OperationLogs orgsOrgIDLogsGet($org_id, $zap_trace_span, $offset, $limit)

Retrieve operation logs for an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OperationLogsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$offset = 56; // int | 
$limit = 20; // int | 

try {
    $result = $apiInstance->orgsOrgIDLogsGet($org_id, $zap_trace_span, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OperationLogsApi->orgsOrgIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **offset** | **int**|  | [optional]
 **limit** | **int**|  | [optional] [default to 20]

### Return type

[**\InfluxDB2Generated\Model\OperationLogs**](../Model/OperationLogs.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersUserIDLogsGet

> \InfluxDB2Generated\Model\OperationLogs usersUserIDLogsGet($user_id, $zap_trace_span, $offset, $limit)

Retrieve operation logs for a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OperationLogsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of the user
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$offset = 56; // int | 
$limit = 20; // int | 

try {
    $result = $apiInstance->usersUserIDLogsGet($user_id, $zap_trace_span, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OperationLogsApi->usersUserIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of the user |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **offset** | **int**|  | [optional]
 **limit** | **int**|  | [optional] [default to 20]

### Return type

[**\InfluxDB2Generated\Model\OperationLogs**](../Model/OperationLogs.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

