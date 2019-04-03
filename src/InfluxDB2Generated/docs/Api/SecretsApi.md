# InfluxDB2Generated\SecretsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**orgsOrgIDSecretsDeletePost**](SecretsApi.md#orgsOrgIDSecretsDeletePost) | **POST** /orgs/{orgID}/secrets/delete | delete provided secrets
[**orgsOrgIDSecretsGet**](SecretsApi.md#orgsOrgIDSecretsGet) | **GET** /orgs/{orgID}/secrets | List all secret keys for an organization
[**orgsOrgIDSecretsPatch**](SecretsApi.md#orgsOrgIDSecretsPatch) | **PATCH** /orgs/{orgID}/secrets | Apply patch to the provided secrets


# **orgsOrgIDSecretsDeletePost**
> orgsOrgIDSecretsDeletePost($org_id, $secret_keys, $zap_trace_span)

delete provided secrets

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SecretsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$secret_keys = new \InfluxDB2Generated\Model\SecretKeys(); // \InfluxDB2Generated\Model\SecretKeys | secret key to deleted
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->orgsOrgIDSecretsDeletePost($org_id, $secret_keys, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling SecretsApi->orgsOrgIDSecretsDeletePost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
 **secret_keys** | [**\InfluxDB2Generated\Model\SecretKeys**](../Model/SecretKeys.md)| secret key to deleted |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **orgsOrgIDSecretsGet**
> \InfluxDB2Generated\Model\SecretKeys orgsOrgIDSecretsGet($org_id, $zap_trace_span)

List all secret keys for an organization

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SecretsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDSecretsGet($org_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecretsApi->orgsOrgIDSecretsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\SecretKeys**](../Model/SecretKeys.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **orgsOrgIDSecretsPatch**
> orgsOrgIDSecretsPatch($org_id, $request_body, $zap_trace_span)

Apply patch to the provided secrets

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SecretsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$request_body = array('key' => 'request_body_example'); // map[string,string] | secret key value pairs to update/add
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->orgsOrgIDSecretsPatch($org_id, $request_body, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling SecretsApi->orgsOrgIDSecretsPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
 **request_body** | [**map[string,string]**](../Model/string.md)| secret key value pairs to update/add |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

