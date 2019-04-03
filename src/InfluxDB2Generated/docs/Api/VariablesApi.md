# InfluxDB2Generated\VariablesApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**variablesGet**](VariablesApi.md#variablesGet) | **GET** /variables | get all variables
[**variablesPost**](VariablesApi.md#variablesPost) | **POST** /variables | create a variable
[**variablesVariableIDDelete**](VariablesApi.md#variablesVariableIDDelete) | **DELETE** /variables/{variableID} | delete a variable
[**variablesVariableIDGet**](VariablesApi.md#variablesVariableIDGet) | **GET** /variables/{variableID} | get a variable
[**variablesVariableIDPatch**](VariablesApi.md#variablesVariableIDPatch) | **PATCH** /variables/{variableID} | update a variable
[**variablesVariableIDPut**](VariablesApi.md#variablesVariableIDPut) | **PUT** /variables/{variableID} | replace a variable


# **variablesGet**
> \InfluxDB2Generated\Model\Variables variablesGet($zap_trace_span, $org, $org_id)

get all variables

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\VariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$org = 'org_example'; // string | specifies the organization name of the resource
$org_id = 'org_id_example'; // string | specifies the organization id of the resource

try {
    $result = $apiInstance->variablesGet($zap_trace_span, $org, $org_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VariablesApi->variablesGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **org** | **string**| specifies the organization name of the resource | [optional]
 **org_id** | **string**| specifies the organization id of the resource | [optional]

### Return type

[**\InfluxDB2Generated\Model\Variables**](../Model/Variables.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **variablesPost**
> \InfluxDB2Generated\Model\Variable variablesPost($variable, $zap_trace_span)

create a variable

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\VariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$variable = new \InfluxDB2Generated\Model\Variable(); // \InfluxDB2Generated\Model\Variable | variable to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->variablesPost($variable, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VariablesApi->variablesPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **variable** | [**\InfluxDB2Generated\Model\Variable**](../Model/Variable.md)| variable to create |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Variable**](../Model/Variable.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **variablesVariableIDDelete**
> variablesVariableIDDelete($variable_id, $zap_trace_span)

delete a variable

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\VariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$variable_id = 'variable_id_example'; // string | id of the variable
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->variablesVariableIDDelete($variable_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling VariablesApi->variablesVariableIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **variable_id** | **string**| id of the variable |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **variablesVariableIDGet**
> \InfluxDB2Generated\Model\Variable variablesVariableIDGet($variable_id, $zap_trace_span)

get a variable

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\VariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$variable_id = 'variable_id_example'; // string | ID of the variable
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->variablesVariableIDGet($variable_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VariablesApi->variablesVariableIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **variable_id** | **string**| ID of the variable |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Variable**](../Model/Variable.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **variablesVariableIDPatch**
> \InfluxDB2Generated\Model\Variable variablesVariableIDPatch($variable_id, $variable, $zap_trace_span)

update a variable

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\VariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$variable_id = 'variable_id_example'; // string | id of the variable
$variable = new \InfluxDB2Generated\Model\Variable(); // \InfluxDB2Generated\Model\Variable | variable update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->variablesVariableIDPatch($variable_id, $variable, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VariablesApi->variablesVariableIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **variable_id** | **string**| id of the variable |
 **variable** | [**\InfluxDB2Generated\Model\Variable**](../Model/Variable.md)| variable update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Variable**](../Model/Variable.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **variablesVariableIDPut**
> \InfluxDB2Generated\Model\Variable variablesVariableIDPut($variable_id, $variable, $zap_trace_span)

replace a variable

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\VariablesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$variable_id = 'variable_id_example'; // string | id of the variable
$variable = new \InfluxDB2Generated\Model\Variable(); // \InfluxDB2Generated\Model\Variable | variable to replace
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->variablesVariableIDPut($variable_id, $variable, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VariablesApi->variablesVariableIDPut: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **variable_id** | **string**| id of the variable |
 **variable** | [**\InfluxDB2Generated\Model\Variable**](../Model/Variable.md)| variable to replace |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Variable**](../Model/Variable.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

