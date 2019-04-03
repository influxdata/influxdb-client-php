# InfluxDB2Generated\ProtosApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**protosGet**](ProtosApi.md#protosGet) | **GET** /protos | List of available protos (templates of tasks/dashboards/etc)
[**protosProtoIDDashboardsPost**](ProtosApi.md#protosProtoIDDashboardsPost) | **POST** /protos/{protoID}/dashboards | Create instance of a proto dashboard


# **protosGet**
> \InfluxDB2Generated\Model\Protos protosGet($zap_trace_span)

List of available protos (templates of tasks/dashboards/etc)

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ProtosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->protosGet($zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProtosApi->protosGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Protos**](../Model/Protos.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **protosProtoIDDashboardsPost**
> \InfluxDB2Generated\Model\Dashboards protosProtoIDDashboardsPost($proto_id, $create_proto_resources_request, $zap_trace_span)

Create instance of a proto dashboard

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ProtosApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$proto_id = 'proto_id_example'; // string | ID of proto
$create_proto_resources_request = new \InfluxDB2Generated\Model\CreateProtoResourcesRequest(); // \InfluxDB2Generated\Model\CreateProtoResourcesRequest | organization that the dashboard will be created as
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->protosProtoIDDashboardsPost($proto_id, $create_proto_resources_request, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProtosApi->protosProtoIDDashboardsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **proto_id** | **string**| ID of proto |
 **create_proto_resources_request** | [**\InfluxDB2Generated\Model\CreateProtoResourcesRequest**](../Model/CreateProtoResourcesRequest.md)| organization that the dashboard will be created as |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Dashboards**](../Model/Dashboards.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

