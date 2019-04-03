# InfluxDB2Generated\SetupApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**setupGet**](SetupApi.md#setupGet) | **GET** /setup | check if database has default user, org, bucket created, returns true if not.
[**setupPost**](SetupApi.md#setupPost) | **POST** /setup | post onboarding request, to setup initial user, org and bucket


# **setupGet**
> \InfluxDB2Generated\Model\IsOnboarding setupGet($zap_trace_span)

check if database has default user, org, bucket created, returns true if not.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SetupApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->setupGet($zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SetupApi->setupGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\IsOnboarding**](../Model/IsOnboarding.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **setupPost**
> \InfluxDB2Generated\Model\OnboardingResponse setupPost($onboarding_request, $zap_trace_span)

post onboarding request, to setup initial user, org and bucket

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SetupApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$onboarding_request = new \InfluxDB2Generated\Model\OnboardingRequest(); // \InfluxDB2Generated\Model\OnboardingRequest | source to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->setupPost($onboarding_request, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SetupApi->setupPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **onboarding_request** | [**\InfluxDB2Generated\Model\OnboardingRequest**](../Model/OnboardingRequest.md)| source to create |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\OnboardingResponse**](../Model/OnboardingResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

