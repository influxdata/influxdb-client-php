# InfluxDB2Generated\CellsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**dashboardsDashboardIDCellsCellIDDelete**](CellsApi.md#dashboardsDashboardIDCellsCellIDDelete) | **DELETE** /dashboards/{dashboardID}/cells/{cellID} | Delete a dashboard cell
[**dashboardsDashboardIDCellsCellIDPatch**](CellsApi.md#dashboardsDashboardIDCellsCellIDPatch) | **PATCH** /dashboards/{dashboardID}/cells/{cellID} | Update the non positional information related to a cell (because updates to a single cells positional data could cause grid conflicts)
[**dashboardsDashboardIDCellsCellIDViewGet**](CellsApi.md#dashboardsDashboardIDCellsCellIDViewGet) | **GET** /dashboards/{dashboardID}/cells/{cellID}/view | Retrieve the view for a cell in a dashboard
[**dashboardsDashboardIDCellsCellIDViewPatch**](CellsApi.md#dashboardsDashboardIDCellsCellIDViewPatch) | **PATCH** /dashboards/{dashboardID}/cells/{cellID}/view | Update the view for a cell
[**dashboardsDashboardIDCellsPost**](CellsApi.md#dashboardsDashboardIDCellsPost) | **POST** /dashboards/{dashboardID}/cells | Create a dashboard cell
[**dashboardsDashboardIDCellsPut**](CellsApi.md#dashboardsDashboardIDCellsPut) | **PUT** /dashboards/{dashboardID}/cells | Replace a dashboards cells



## dashboardsDashboardIDCellsCellIDDelete

> dashboardsDashboardIDCellsCellIDDelete($dashboard_id, $cell_id, $zap_trace_span)

Delete a dashboard cell

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\CellsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard to delte
$cell_id = 'cell_id_example'; // string | ID of cell to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->dashboardsDashboardIDCellsCellIDDelete($dashboard_id, $cell_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling CellsApi->dashboardsDashboardIDCellsCellIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard to delte |
 **cell_id** | **string**| ID of cell to delete |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDCellsCellIDPatch

> \InfluxDB2Generated\Model\Cell dashboardsDashboardIDCellsCellIDPatch($dashboard_id, $cell_id, $cell_update, $zap_trace_span)

Update the non positional information related to a cell (because updates to a single cells positional data could cause grid conflicts)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\CellsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard to update
$cell_id = 'cell_id_example'; // string | ID of cell to update
$cell_update = new \InfluxDB2Generated\Model\CellUpdate(); // \InfluxDB2Generated\Model\CellUpdate | updates the non positional information related to a cell
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDCellsCellIDPatch($dashboard_id, $cell_id, $cell_update, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CellsApi->dashboardsDashboardIDCellsCellIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard to update |
 **cell_id** | **string**| ID of cell to update |
 **cell_update** | [**\InfluxDB2Generated\Model\CellUpdate**](../Model/CellUpdate.md)| updates the non positional information related to a cell |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Cell**](../Model/Cell.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDCellsCellIDViewGet

> \InfluxDB2Generated\Model\View dashboardsDashboardIDCellsCellIDViewGet($dashboard_id, $cell_id, $zap_trace_span)

Retrieve the view for a cell in a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\CellsApi(
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
    echo 'Exception when calling CellsApi->dashboardsDashboardIDCellsCellIDViewGet: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\CellsApi(
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
    echo 'Exception when calling CellsApi->dashboardsDashboardIDCellsCellIDViewPatch: ', $e->getMessage(), PHP_EOL;
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


## dashboardsDashboardIDCellsPost

> \InfluxDB2Generated\Model\Cell dashboardsDashboardIDCellsPost($dashboard_id, $create_cell, $zap_trace_span)

Create a dashboard cell

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\CellsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard to update
$create_cell = new \InfluxDB2Generated\Model\CreateCell(); // \InfluxDB2Generated\Model\CreateCell | cell that will be added
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDCellsPost($dashboard_id, $create_cell, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CellsApi->dashboardsDashboardIDCellsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard to update |
 **create_cell** | [**\InfluxDB2Generated\Model\CreateCell**](../Model/CreateCell.md)| cell that will be added |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Cell**](../Model/Cell.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDCellsPut

> \InfluxDB2Generated\Model\Dashboard dashboardsDashboardIDCellsPut($dashboard_id, $cell, $zap_trace_span)

Replace a dashboards cells

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\CellsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard to update
$cell = array(new \InfluxDB2Generated\Model\array()); // \InfluxDB2Generated\Model\Cell[] | batch replaces all of a dashboards cells (this is used primarily to update the positional information of all of the cells)
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDCellsPut($dashboard_id, $cell, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CellsApi->dashboardsDashboardIDCellsPut: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard to update |
 **cell** | [**\InfluxDB2Generated\Model\Cell[]**](../Model/array.md)| batch replaces all of a dashboards cells (this is used primarily to update the positional information of all of the cells) |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Dashboard**](../Model/Dashboard.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

