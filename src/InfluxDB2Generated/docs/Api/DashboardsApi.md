# InfluxDB2Generated\DashboardsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**dashboardsDashboardIDCellsCellIDDelete**](DashboardsApi.md#dashboardsDashboardIDCellsCellIDDelete) | **DELETE** /dashboards/{dashboardID}/cells/{cellID} | Delete a dashboard cell
[**dashboardsDashboardIDCellsCellIDPatch**](DashboardsApi.md#dashboardsDashboardIDCellsCellIDPatch) | **PATCH** /dashboards/{dashboardID}/cells/{cellID} | Update the non positional information related to a cell (because updates to a single cells positional data could cause grid conflicts)
[**dashboardsDashboardIDCellsCellIDViewGet**](DashboardsApi.md#dashboardsDashboardIDCellsCellIDViewGet) | **GET** /dashboards/{dashboardID}/cells/{cellID}/view | Retrieve the view for a cell in a dashboard
[**dashboardsDashboardIDCellsCellIDViewPatch**](DashboardsApi.md#dashboardsDashboardIDCellsCellIDViewPatch) | **PATCH** /dashboards/{dashboardID}/cells/{cellID}/view | Update the view for a cell
[**dashboardsDashboardIDCellsPost**](DashboardsApi.md#dashboardsDashboardIDCellsPost) | **POST** /dashboards/{dashboardID}/cells | Create a dashboard cell
[**dashboardsDashboardIDCellsPut**](DashboardsApi.md#dashboardsDashboardIDCellsPut) | **PUT** /dashboards/{dashboardID}/cells | Replace a dashboards cells
[**dashboardsDashboardIDDelete**](DashboardsApi.md#dashboardsDashboardIDDelete) | **DELETE** /dashboards/{dashboardID} | Delete a dashboard
[**dashboardsDashboardIDGet**](DashboardsApi.md#dashboardsDashboardIDGet) | **GET** /dashboards/{dashboardID} | Get a single Dashboard
[**dashboardsDashboardIDLabelsGet**](DashboardsApi.md#dashboardsDashboardIDLabelsGet) | **GET** /dashboards/{dashboardID}/labels | list all labels for a dashboard
[**dashboardsDashboardIDLabelsLabelIDDelete**](DashboardsApi.md#dashboardsDashboardIDLabelsLabelIDDelete) | **DELETE** /dashboards/{dashboardID}/labels/{labelID} | delete a label from a dashboard
[**dashboardsDashboardIDLabelsPost**](DashboardsApi.md#dashboardsDashboardIDLabelsPost) | **POST** /dashboards/{dashboardID}/labels | add a label to a dashboard
[**dashboardsDashboardIDLogsGet**](DashboardsApi.md#dashboardsDashboardIDLogsGet) | **GET** /dashboards/{dashboardID}/logs | Retrieve operation logs for a dashboard
[**dashboardsDashboardIDMembersGet**](DashboardsApi.md#dashboardsDashboardIDMembersGet) | **GET** /dashboards/{dashboardID}/members | List all dashboard members
[**dashboardsDashboardIDMembersPost**](DashboardsApi.md#dashboardsDashboardIDMembersPost) | **POST** /dashboards/{dashboardID}/members | Add dashboard member
[**dashboardsDashboardIDMembersUserIDDelete**](DashboardsApi.md#dashboardsDashboardIDMembersUserIDDelete) | **DELETE** /dashboards/{dashboardID}/members/{userID} | removes a member from an dashboard
[**dashboardsDashboardIDOwnersGet**](DashboardsApi.md#dashboardsDashboardIDOwnersGet) | **GET** /dashboards/{dashboardID}/owners | List all dashboard owners
[**dashboardsDashboardIDOwnersPost**](DashboardsApi.md#dashboardsDashboardIDOwnersPost) | **POST** /dashboards/{dashboardID}/owners | Add dashboard owner
[**dashboardsDashboardIDOwnersUserIDDelete**](DashboardsApi.md#dashboardsDashboardIDOwnersUserIDDelete) | **DELETE** /dashboards/{dashboardID}/owners/{userID} | removes an owner from a dashboard
[**dashboardsDashboardIDPatch**](DashboardsApi.md#dashboardsDashboardIDPatch) | **PATCH** /dashboards/{dashboardID} | Update a single dashboard
[**dashboardsGet**](DashboardsApi.md#dashboardsGet) | **GET** /dashboards | Get all dashboards
[**dashboardsPost**](DashboardsApi.md#dashboardsPost) | **POST** /dashboards | Create a dashboard



## dashboardsDashboardIDCellsCellIDDelete

> dashboardsDashboardIDCellsCellIDDelete($dashboard_id, $cell_id, $zap_trace_span)

Delete a dashboard cell

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
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
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDCellsCellIDDelete: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
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
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDCellsCellIDPatch: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
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
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDCellsCellIDViewGet: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
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
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDCellsCellIDViewPatch: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
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
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDCellsPost: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
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
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDCellsPut: ', $e->getMessage(), PHP_EOL;
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


## dashboardsDashboardIDDelete

> dashboardsDashboardIDDelete($dashboard_id, $zap_trace_span)

Delete a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard to update
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->dashboardsDashboardIDDelete($dashboard_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard to update |
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


## dashboardsDashboardIDGet

> \InfluxDB2Generated\Model\Dashboard dashboardsDashboardIDGet($dashboard_id, $zap_trace_span)

Get a single Dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard to update
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDGet($dashboard_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard to update |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Dashboard**](../Model/Dashboard.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDLabelsGet

> \InfluxDB2Generated\Model\LabelsResponse dashboardsDashboardIDLabelsGet($dashboard_id, $zap_trace_span)

list all labels for a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDLabelsGet($dashboard_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDLabelsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\LabelsResponse**](../Model/LabelsResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDLabelsLabelIDDelete

> dashboardsDashboardIDLabelsLabelIDDelete($dashboard_id, $label_id, $zap_trace_span)

delete a label from a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$label_id = 'label_id_example'; // string | the label id to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->dashboardsDashboardIDLabelsLabelIDDelete($dashboard_id, $label_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDLabelsLabelIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
 **label_id** | **string**| the label id to delete |
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


## dashboardsDashboardIDLabelsPost

> \InfluxDB2Generated\Model\LabelResponse dashboardsDashboardIDLabelsPost($dashboard_id, $label_mapping, $zap_trace_span)

add a label to a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$label_mapping = new \InfluxDB2Generated\Model\LabelMapping(); // \InfluxDB2Generated\Model\LabelMapping | label to add
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDLabelsPost($dashboard_id, $label_mapping, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDLabelsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
 **label_mapping** | [**\InfluxDB2Generated\Model\LabelMapping**](../Model/LabelMapping.md)| label to add |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\LabelResponse**](../Model/LabelResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
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


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
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
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDLogsGet: ', $e->getMessage(), PHP_EOL;
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


## dashboardsDashboardIDMembersGet

> \InfluxDB2Generated\Model\ResourceMembers dashboardsDashboardIDMembersGet($dashboard_id, $zap_trace_span)

List all dashboard members

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDMembersGet($dashboard_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDMembersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ResourceMembers**](../Model/ResourceMembers.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDMembersPost

> \InfluxDB2Generated\Model\ResourceMember dashboardsDashboardIDMembersPost($dashboard_id, $add_resource_member_request_body, $zap_trace_span)

Add dashboard member

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as member
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDMembersPost($dashboard_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDMembersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
 **add_resource_member_request_body** | [**\InfluxDB2Generated\Model\AddResourceMemberRequestBody**](../Model/AddResourceMemberRequestBody.md)| user to add as member |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ResourceMember**](../Model/ResourceMember.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDMembersUserIDDelete

> dashboardsDashboardIDMembersUserIDDelete($user_id, $dashboard_id, $zap_trace_span)

removes a member from an dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of member to remove
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->dashboardsDashboardIDMembersUserIDDelete($user_id, $dashboard_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of member to remove |
 **dashboard_id** | **string**| ID of the dashboard |
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


## dashboardsDashboardIDOwnersGet

> \InfluxDB2Generated\Model\ResourceOwners dashboardsDashboardIDOwnersGet($dashboard_id, $zap_trace_span)

List all dashboard owners

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDOwnersGet($dashboard_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDOwnersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ResourceOwners**](../Model/ResourceOwners.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDOwnersPost

> \InfluxDB2Generated\Model\ResourceOwner dashboardsDashboardIDOwnersPost($dashboard_id, $add_resource_member_request_body, $zap_trace_span)

Add dashboard owner

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as owner
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDOwnersPost($dashboard_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDOwnersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
 **add_resource_member_request_body** | [**\InfluxDB2Generated\Model\AddResourceMemberRequestBody**](../Model/AddResourceMemberRequestBody.md)| user to add as owner |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ResourceOwner**](../Model/ResourceOwner.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsDashboardIDOwnersUserIDDelete

> dashboardsDashboardIDOwnersUserIDDelete($user_id, $dashboard_id, $zap_trace_span)

removes an owner from a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of owner to remove
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->dashboardsDashboardIDOwnersUserIDDelete($user_id, $dashboard_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of owner to remove |
 **dashboard_id** | **string**| ID of the dashboard |
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


## dashboardsDashboardIDPatch

> \InfluxDB2Generated\Model\Dashboard dashboardsDashboardIDPatch($dashboard_id, $dashboard, $zap_trace_span)

Update a single dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of dashboard to update
$dashboard = new \InfluxDB2Generated\Model\Dashboard(); // \InfluxDB2Generated\Model\Dashboard | patching of a dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDPatch($dashboard_id, $dashboard, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsDashboardIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of dashboard to update |
 **dashboard** | [**\InfluxDB2Generated\Model\Dashboard**](../Model/Dashboard.md)| patching of a dashboard |
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


## dashboardsGet

> \InfluxDB2Generated\Model\Dashboards dashboardsGet($zap_trace_span, $owner, $sort_by, $id, $org_id, $org)

Get all dashboards

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$owner = 'owner_example'; // string | specifies the owner id to return resources for
$sort_by = 'sort_by_example'; // string | specifies the owner id to return resources for
$id = array('id_example'); // string[] | ID list of dashboards to return. If both this and owner are specified, only ids is used.
$org_id = 'org_id_example'; // string | specifies the organization id of the resource
$org = 'org_example'; // string | specifies the organization name of the resource

try {
    $result = $apiInstance->dashboardsGet($zap_trace_span, $owner, $sort_by, $id, $org_id, $org);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **owner** | **string**| specifies the owner id to return resources for | [optional]
 **sort_by** | **string**| specifies the owner id to return resources for | [optional]
 **id** | [**string[]**](../Model/string.md)| ID list of dashboards to return. If both this and owner are specified, only ids is used. | [optional]
 **org_id** | **string**| specifies the organization id of the resource | [optional]
 **org** | **string**| specifies the organization name of the resource | [optional]

### Return type

[**\InfluxDB2Generated\Model\Dashboards**](../Model/Dashboards.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## dashboardsPost

> \InfluxDB2Generated\Model\Dashboard dashboardsPost($dashboard, $zap_trace_span)

Create a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\DashboardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard = new \InfluxDB2Generated\Model\Dashboard(); // \InfluxDB2Generated\Model\Dashboard | dashboard to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsPost($dashboard, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DashboardsApi->dashboardsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard** | [**\InfluxDB2Generated\Model\Dashboard**](../Model/Dashboard.md)| dashboard to create |
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

