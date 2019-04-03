# InfluxDB2Generated\LabelsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**labelsGet**](LabelsApi.md#labelsGet) | **GET** /labels | Get all labels
[**labelsLabelIDDelete**](LabelsApi.md#labelsLabelIDDelete) | **DELETE** /labels/{labelID} | Delete a label
[**labelsLabelIDGet**](LabelsApi.md#labelsLabelIDGet) | **GET** /labels/{labelID} | Get a label
[**labelsLabelIDPatch**](LabelsApi.md#labelsLabelIDPatch) | **PATCH** /labels/{labelID} | Update a single label
[**labelsPost**](LabelsApi.md#labelsPost) | **POST** /labels | Create a label


# **labelsGet**
> \InfluxDB2Generated\Model\LabelsResponse labelsGet()

Get all labels

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\LabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->labelsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LabelsApi->labelsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\InfluxDB2Generated\Model\LabelsResponse**](../Model/LabelsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **labelsLabelIDDelete**
> labelsLabelIDDelete($label_id, $zap_trace_span)

Delete a label

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\LabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$label_id = 'label_id_example'; // string | ID of label to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->labelsLabelIDDelete($label_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling LabelsApi->labelsLabelIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **label_id** | **string**| ID of label to delete |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **labelsLabelIDGet**
> \InfluxDB2Generated\Model\LabelResponse labelsLabelIDGet($label_id, $zap_trace_span)

Get a label

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\LabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$label_id = 'label_id_example'; // string | ID of label to update
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->labelsLabelIDGet($label_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LabelsApi->labelsLabelIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **label_id** | **string**| ID of label to update |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\LabelResponse**](../Model/LabelResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **labelsLabelIDPatch**
> \InfluxDB2Generated\Model\LabelResponse labelsLabelIDPatch($label_id, $label_update, $zap_trace_span)

Update a single label

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\LabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$label_id = 'label_id_example'; // string | ID of label to update
$label_update = new \InfluxDB2Generated\Model\LabelUpdate(); // \InfluxDB2Generated\Model\LabelUpdate | label update
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->labelsLabelIDPatch($label_id, $label_update, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LabelsApi->labelsLabelIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **label_id** | **string**| ID of label to update |
 **label_update** | [**\InfluxDB2Generated\Model\LabelUpdate**](../Model/LabelUpdate.md)| label update |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\LabelResponse**](../Model/LabelResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **labelsPost**
> \InfluxDB2Generated\Model\LabelResponse labelsPost($label)

Create a label

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\LabelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$label = new \InfluxDB2Generated\Model\Label(); // \InfluxDB2Generated\Model\Label | label to create

try {
    $result = $apiInstance->labelsPost($label);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LabelsApi->labelsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **label** | [**\InfluxDB2Generated\Model\Label**](../Model/Label.md)| label to create |

### Return type

[**\InfluxDB2Generated\Model\LabelResponse**](../Model/LabelResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

