# InfluxDB2Generated\WriteApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**writePost**](WriteApi.md#writePost) | **POST** /write | write time-series data into influxdb


# **writePost**
> writePost($org, $bucket, $body, $zap_trace_span, $content_encoding, $content_type, $content_length, $accept, $precision)

write time-series data into influxdb

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\WriteApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org = 'org_example'; // string | specifies the destination organization for writes
$bucket = 'bucket_example'; // string | specifies the destination bucket for writes
$body = 'body_example'; // string | line protocol body
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$content_encoding = 'identity'; // string | when present, its value indicates to the database that compression is applied to the line-protocol body.
$content_type = 'text/plain; charset=utf-8'; // string | Content-Type is used to indicate the format of the data sent to the server.
$content_length = 56; // int | Content-Length is an entity header is indicating the size of the entity-body, in bytes, sent to the database. If the length is greater than the database max body configuration option, a 413 response is sent.
$accept = 'application/json'; // string | specifies the return content format.
$precision = new \InfluxDB2Generated\Model\\InfluxDB2Generated\Model\WritePrecision(); // \InfluxDB2Generated\Model\WritePrecision | specifies the precision for the unix timestamps within the body line-protocol

try {
    $apiInstance->writePost($org, $bucket, $body, $zap_trace_span, $content_encoding, $content_type, $content_length, $accept, $precision);
} catch (Exception $e) {
    echo 'Exception when calling WriteApi->writePost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org** | **string**| specifies the destination organization for writes |
 **bucket** | **string**| specifies the destination bucket for writes |
 **body** | **string**| line protocol body |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **content_encoding** | **string**| when present, its value indicates to the database that compression is applied to the line-protocol body. | [optional] [default to &#39;identity&#39;]
 **content_type** | **string**| Content-Type is used to indicate the format of the data sent to the server. | [optional] [default to &#39;text/plain; charset&#x3D;utf-8&#39;]
 **content_length** | **int**| Content-Length is an entity header is indicating the size of the entity-body, in bytes, sent to the database. If the length is greater than the database max body configuration option, a 413 response is sent. | [optional]
 **accept** | **string**| specifies the return content format. | [optional] [default to &#39;application/json&#39;]
 **precision** | [**\InfluxDB2Generated\Model\WritePrecision**](../Model/.md)| specifies the precision for the unix timestamps within the body line-protocol | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: text/plain
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

