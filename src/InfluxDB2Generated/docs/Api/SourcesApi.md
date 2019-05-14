# InfluxDB2Generated\SourcesApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**sourcesGet**](SourcesApi.md#sourcesGet) | **GET** /sources | Get all sources
[**sourcesPost**](SourcesApi.md#sourcesPost) | **POST** /sources | Creates a Source
[**sourcesSourceIDBucketsGet**](SourcesApi.md#sourcesSourceIDBucketsGet) | **GET** /sources/{sourceID}/buckets | Get a sources buckets (will return dbrps in the form of buckets if it is a v1 source)
[**sourcesSourceIDDelete**](SourcesApi.md#sourcesSourceIDDelete) | **DELETE** /sources/{sourceID} | Delete a source
[**sourcesSourceIDGet**](SourcesApi.md#sourcesSourceIDGet) | **GET** /sources/{sourceID} | Get a source
[**sourcesSourceIDHealthGet**](SourcesApi.md#sourcesSourceIDHealthGet) | **GET** /sources/{sourceID}/health | Get a sources health
[**sourcesSourceIDPatch**](SourcesApi.md#sourcesSourceIDPatch) | **PATCH** /sources/{sourceID} | Updates a Source



## sourcesGet

> \InfluxDB2Generated\Model\Sources sourcesGet($org, $zap_trace_span)

Get all sources

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SourcesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org = 'org_example'; // string | specifies the organization of the resource
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->sourcesGet($org, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourcesApi->sourcesGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org** | **string**| specifies the organization of the resource |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Sources**](../Model/Sources.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## sourcesPost

> \InfluxDB2Generated\Model\Source sourcesPost($source, $zap_trace_span)

Creates a Source

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SourcesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$source = new \InfluxDB2Generated\Model\Source(); // \InfluxDB2Generated\Model\Source | source to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->sourcesPost($source, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourcesApi->sourcesPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **source** | [**\InfluxDB2Generated\Model\Source**](../Model/Source.md)| source to create |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Source**](../Model/Source.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## sourcesSourceIDBucketsGet

> \InfluxDB2Generated\Model\Buckets sourcesSourceIDBucketsGet($source_id, $org, $zap_trace_span)

Get a sources buckets (will return dbrps in the form of buckets if it is a v1 source)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SourcesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$source_id = 'source_id_example'; // string | ID of the source
$org = 'org_example'; // string | specifies the organization of the resource
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->sourcesSourceIDBucketsGet($source_id, $org, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourcesApi->sourcesSourceIDBucketsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **source_id** | **string**| ID of the source |
 **org** | **string**| specifies the organization of the resource |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Buckets**](../Model/Buckets.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## sourcesSourceIDDelete

> sourcesSourceIDDelete($source_id)

Delete a source

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SourcesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$source_id = 'source_id_example'; // string | ID of the source

try {
    $apiInstance->sourcesSourceIDDelete($source_id);
} catch (Exception $e) {
    echo 'Exception when calling SourcesApi->sourcesSourceIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **source_id** | **string**| ID of the source |

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


## sourcesSourceIDGet

> \InfluxDB2Generated\Model\Source sourcesSourceIDGet($source_id, $zap_trace_span)

Get a source

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SourcesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$source_id = 'source_id_example'; // string | ID of the source
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->sourcesSourceIDGet($source_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourcesApi->sourcesSourceIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **source_id** | **string**| ID of the source |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Source**](../Model/Source.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## sourcesSourceIDHealthGet

> \InfluxDB2Generated\Model\Check sourcesSourceIDHealthGet($source_id, $zap_trace_span)

Get a sources health

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SourcesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$source_id = 'source_id_example'; // string | ID of the source
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->sourcesSourceIDHealthGet($source_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourcesApi->sourcesSourceIDHealthGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **source_id** | **string**| ID of the source |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Check**](../Model/Check.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## sourcesSourceIDPatch

> \InfluxDB2Generated\Model\Source sourcesSourceIDPatch($source_id, $source, $zap_trace_span)

Updates a Source

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\SourcesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$source_id = 'source_id_example'; // string | ID of the source
$source = new \InfluxDB2Generated\Model\Source(); // \InfluxDB2Generated\Model\Source | source update
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->sourcesSourceIDPatch($source_id, $source, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SourcesApi->sourcesSourceIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **source_id** | **string**| ID of the source |
 **source** | [**\InfluxDB2Generated\Model\Source**](../Model/Source.md)| source update |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Source**](../Model/Source.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

