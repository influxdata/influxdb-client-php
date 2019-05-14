# InfluxDB2Generated\ViewsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**dashboardsDashboardIDCellsCellIDViewGet**](ViewsApi.md#dashboardsDashboardIDCellsCellIDViewGet) | **GET** /dashboards/{dashboardID}/cells/{cellID}/view | Retrieve the view for a cell in a dashboard
[**dashboardsDashboardIDCellsCellIDViewPatch**](ViewsApi.md#dashboardsDashboardIDCellsCellIDViewPatch) | **PATCH** /dashboards/{dashboardID}/cells/{cellID}/view | Update the view for a cell



## dashboardsDashboardIDCellsCellIDViewGet

> \InfluxDB2Generated\Model\View dashboardsDashboardIDCellsCellIDViewGet($dashboard_id, $cell_id, $zap_trace_span)

Retrieve the view for a cell in a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ViewsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard
$cell_id = 'cell_id_example'; // string | ID of cell
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDCellsCellIDViewGet($dashboard_id, $cell_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ViewsApi->dashboardsDashboardIDCellsCellIDViewGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard |
 **cell_id** | **string**| ID of cell |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\View**](../Model/View.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDCellsCellIDViewPatch

> \InfluxDB2Generated\Model\View dashboardsDashboardIDCellsCellIDViewPatch($dashboard_id, $cell_id, $view, $zap_trace_span)

Update the view for a cell

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ViewsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard to update
$cell_id = 'cell_id_example'; // string | ID of cell to update
$view = new \InfluxDB2Generated\Model\View(); // \InfluxDB2Generated\Model\View | updates the view for a cell
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDCellsCellIDViewPatch($dashboard_id, $cell_id, $view, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ViewsApi->dashboardsDashboardIDCellsCellIDViewPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard to update |
 **cell_id** | **string**| ID of cell to update |
 **view** | [**\InfluxDB2Generated\Model\View**](../Model/View.md)| updates the view for a cell |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\View**](../Model/View.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

