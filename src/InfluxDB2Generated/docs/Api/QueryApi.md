# InfluxDB2Generated\QueryApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**queryAnalyzePost**](QueryApi.md#queryAnalyzePost) | **POST** /query/analyze | analyze an influxql or flux query
[**queryAstPost**](QueryApi.md#queryAstPost) | **POST** /query/ast | 
[**queryPost**](QueryApi.md#queryPost) | **POST** /query | query an influx
[**querySpecPost**](QueryApi.md#querySpecPost) | **POST** /query/spec | 
[**querySuggestionsGet**](QueryApi.md#querySuggestionsGet) | **GET** /query/suggestions | 
[**querySuggestionsNameGet**](QueryApi.md#querySuggestionsNameGet) | **GET** /query/suggestions/{name} | 


# **queryAnalyzePost**
> \InfluxDB2Generated\Model\AnalyzeQueryResponse queryAnalyzePost($zap_trace_span, $content_type, $query)

analyze an influxql or flux query

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\QueryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$content_type = 'content_type_example'; // string | 
$query = new \InfluxDB2Generated\Model\Query(); // \InfluxDB2Generated\Model\Query | flux or influxql query to analyze

try {
    $result = $apiInstance->queryAnalyzePost($zap_trace_span, $content_type, $query);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling QueryApi->queryAnalyzePost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **content_type** | **string**|  | [optional]
 **query** | [**\InfluxDB2Generated\Model\Query**](../Model/Query.md)| flux or influxql query to analyze | [optional]

### Return type

[**\InfluxDB2Generated\Model\AnalyzeQueryResponse**](../Model/AnalyzeQueryResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **queryAstPost**
> \InfluxDB2Generated\Model\ASTResponse queryAstPost($zap_trace_span, $content_type, $language_request)



analyzes flux query and generates a query specification.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\QueryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$content_type = 'content_type_example'; // string | 
$language_request = new \InfluxDB2Generated\Model\LanguageRequest(); // \InfluxDB2Generated\Model\LanguageRequest | analyzed flux query to generate abstract syntax tree.

try {
    $result = $apiInstance->queryAstPost($zap_trace_span, $content_type, $language_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling QueryApi->queryAstPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **content_type** | **string**|  | [optional]
 **language_request** | [**\InfluxDB2Generated\Model\LanguageRequest**](../Model/LanguageRequest.md)| analyzed flux query to generate abstract syntax tree. | [optional]

### Return type

[**\InfluxDB2Generated\Model\ASTResponse**](../Model/ASTResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **queryPost**
> string queryPost($zap_trace_span, $accept, $content_type, $org, $org_id, $query)

query an influx

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\QueryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$accept = 'text/csv'; // string | specifies the return content format. Each response content type will have its own dialect options.
$content_type = 'content_type_example'; // string | 
$org = 'org_example'; // string | specifies the name of the organization executing the query; if both orgID and org are specified, orgID takes precendence.
$org_id = 'org_id_example'; // string | specifies the ID of the organization executing the query; if both orgID and org are specified, orgID takes precendence.
$query = new \InfluxDB2Generated\Model\Query(); // \InfluxDB2Generated\Model\Query | flux query or specification to execute

try {
    $result = $apiInstance->queryPost($zap_trace_span, $accept, $content_type, $org, $org_id, $query);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling QueryApi->queryPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **accept** | **string**| specifies the return content format. Each response content type will have its own dialect options. | [optional] [default to &#39;text/csv&#39;]
 **content_type** | **string**|  | [optional]
 **org** | **string**| specifies the name of the organization executing the query; if both orgID and org are specified, orgID takes precendence. | [optional]
 **org_id** | **string**| specifies the ID of the organization executing the query; if both orgID and org are specified, orgID takes precendence. | [optional]
 **query** | [**\InfluxDB2Generated\Model\Query**](../Model/Query.md)| flux query or specification to execute | [optional]

### Return type

**string**

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json, application/vnd.flux
 - **Accept**: text/csv, application/vnd.influx.arrow

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **querySpecPost**
> \InfluxDB2Generated\Model\QuerySpecification querySpecPost($zap_trace_span, $content_type, $language_request)



analyzes flux query and generates a query specification.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\QueryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$content_type = 'content_type_example'; // string | 
$language_request = new \InfluxDB2Generated\Model\LanguageRequest(); // \InfluxDB2Generated\Model\LanguageRequest | analyzed flux query to generate specification.

try {
    $result = $apiInstance->querySpecPost($zap_trace_span, $content_type, $language_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling QueryApi->querySpecPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **content_type** | **string**|  | [optional]
 **language_request** | [**\InfluxDB2Generated\Model\LanguageRequest**](../Model/LanguageRequest.md)| analyzed flux query to generate specification. | [optional]

### Return type

[**\InfluxDB2Generated\Model\QuerySpecification**](../Model/QuerySpecification.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **querySuggestionsGet**
> \InfluxDB2Generated\Model\FluxSuggestions querySuggestionsGet($zap_trace_span)



### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\QueryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->querySuggestionsGet($zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling QueryApi->querySuggestionsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\FluxSuggestions**](../Model/FluxSuggestions.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **querySuggestionsNameGet**
> \InfluxDB2Generated\Model\FluxSuggestions querySuggestionsNameGet($name, $zap_trace_span)



### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\QueryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$name = 'name_example'; // string | name of branching suggestion
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->querySuggestionsNameGet($name, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling QueryApi->querySuggestionsNameGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **name** | **string**| name of branching suggestion |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\FluxSuggestions**](../Model/FluxSuggestions.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

