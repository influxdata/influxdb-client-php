# InfluxDB2Generated\AuthorizationsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**authorizationsAuthIDDelete**](AuthorizationsApi.md#authorizationsAuthIDDelete) | **DELETE** /authorizations/{authID} | Delete a authorization
[**authorizationsAuthIDGet**](AuthorizationsApi.md#authorizationsAuthIDGet) | **GET** /authorizations/{authID} | Retrieve an authorization
[**authorizationsAuthIDPatch**](AuthorizationsApi.md#authorizationsAuthIDPatch) | **PATCH** /authorizations/{authID} | update authorization to be active or inactive. requests using an inactive authorization will be rejected.
[**authorizationsGet**](AuthorizationsApi.md#authorizationsGet) | **GET** /authorizations | List all authorizations
[**authorizationsPost**](AuthorizationsApi.md#authorizationsPost) | **POST** /authorizations | Create an authorization


# **authorizationsAuthIDDelete**
> authorizationsAuthIDDelete($auth_id, $zap_trace_span)

Delete a authorization

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\AuthorizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$auth_id = 'auth_id_example'; // string | ID of authorization to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->authorizationsAuthIDDelete($auth_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationsApi->authorizationsAuthIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **auth_id** | **string**| ID of authorization to delete |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **authorizationsAuthIDGet**
> \InfluxDB2Generated\Model\Authorization authorizationsAuthIDGet($auth_id, $zap_trace_span)

Retrieve an authorization

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\AuthorizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$auth_id = 'auth_id_example'; // string | ID of authorization to get
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->authorizationsAuthIDGet($auth_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationsApi->authorizationsAuthIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **auth_id** | **string**| ID of authorization to get |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Authorization**](../Model/Authorization.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **authorizationsAuthIDPatch**
> \InfluxDB2Generated\Model\Authorization authorizationsAuthIDPatch($auth_id, $authorization, $zap_trace_span)

update authorization to be active or inactive. requests using an inactive authorization will be rejected.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\AuthorizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$auth_id = 'auth_id_example'; // string | ID of authorization to update
$authorization = new \InfluxDB2Generated\Model\Authorization(); // \InfluxDB2Generated\Model\Authorization | authorization to update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->authorizationsAuthIDPatch($auth_id, $authorization, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationsApi->authorizationsAuthIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **auth_id** | **string**| ID of authorization to update |
 **authorization** | [**\InfluxDB2Generated\Model\Authorization**](../Model/Authorization.md)| authorization to update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Authorization**](../Model/Authorization.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **authorizationsGet**
> \InfluxDB2Generated\Model\Authorizations authorizationsGet($zap_trace_span, $user_id, $user)

List all authorizations

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\AuthorizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$user_id = 'user_id_example'; // string | filter authorizations belonging to a user id
$user = 'user_example'; // string | filter authorizations belonging to a user name

try {
    $result = $apiInstance->authorizationsGet($zap_trace_span, $user_id, $user);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationsApi->authorizationsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **user_id** | **string**| filter authorizations belonging to a user id | [optional]
 **user** | **string**| filter authorizations belonging to a user name | [optional]

### Return type

[**\InfluxDB2Generated\Model\Authorizations**](../Model/Authorizations.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **authorizationsPost**
> \InfluxDB2Generated\Model\Authorization authorizationsPost($authorization, $zap_trace_span)

Create an authorization

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\AuthorizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$authorization = new \InfluxDB2Generated\Model\Authorization(); // \InfluxDB2Generated\Model\Authorization | authorization to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->authorizationsPost($authorization, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationsApi->authorizationsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **authorization** | [**\InfluxDB2Generated\Model\Authorization**](../Model/Authorization.md)| authorization to create |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Authorization**](../Model/Authorization.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

