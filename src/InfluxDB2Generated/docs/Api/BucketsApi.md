# InfluxDB2Generated\BucketsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**bucketsBucketIDDelete**](BucketsApi.md#bucketsBucketIDDelete) | **DELETE** /buckets/{bucketID} | Delete a bucket
[**bucketsBucketIDGet**](BucketsApi.md#bucketsBucketIDGet) | **GET** /buckets/{bucketID} | Retrieve a bucket
[**bucketsBucketIDLabelsGet**](BucketsApi.md#bucketsBucketIDLabelsGet) | **GET** /buckets/{bucketID}/labels | list all labels for a bucket
[**bucketsBucketIDLabelsLabelIDDelete**](BucketsApi.md#bucketsBucketIDLabelsLabelIDDelete) | **DELETE** /buckets/{bucketID}/labels/{labelID} | delete a label from a bucket
[**bucketsBucketIDLabelsPost**](BucketsApi.md#bucketsBucketIDLabelsPost) | **POST** /buckets/{bucketID}/labels | add a label to a bucket
[**bucketsBucketIDLogsGet**](BucketsApi.md#bucketsBucketIDLogsGet) | **GET** /buckets/{bucketID}/logs | Retrieve operation logs for a bucket
[**bucketsBucketIDMembersGet**](BucketsApi.md#bucketsBucketIDMembersGet) | **GET** /buckets/{bucketID}/members | List all users with member privileges for a bucket
[**bucketsBucketIDMembersPost**](BucketsApi.md#bucketsBucketIDMembersPost) | **POST** /buckets/{bucketID}/members | Add bucket member
[**bucketsBucketIDMembersUserIDDelete**](BucketsApi.md#bucketsBucketIDMembersUserIDDelete) | **DELETE** /buckets/{bucketID}/members/{userID} | removes a member from an bucket
[**bucketsBucketIDOwnersGet**](BucketsApi.md#bucketsBucketIDOwnersGet) | **GET** /buckets/{bucketID}/owners | List all owners of a bucket
[**bucketsBucketIDOwnersPost**](BucketsApi.md#bucketsBucketIDOwnersPost) | **POST** /buckets/{bucketID}/owners | Add bucket owner
[**bucketsBucketIDOwnersUserIDDelete**](BucketsApi.md#bucketsBucketIDOwnersUserIDDelete) | **DELETE** /buckets/{bucketID}/owners/{userID} | removes an owner from a bucket
[**bucketsBucketIDPatch**](BucketsApi.md#bucketsBucketIDPatch) | **PATCH** /buckets/{bucketID} | Update a bucket
[**bucketsGet**](BucketsApi.md#bucketsGet) | **GET** /buckets | List all buckets
[**bucketsPost**](BucketsApi.md#bucketsPost) | **POST** /buckets | Create a bucket
[**sourcesSourceIDBucketsGet**](BucketsApi.md#sourcesSourceIDBucketsGet) | **GET** /sources/{sourceID}/buckets | Get a sources buckets (will return dbrps in the form of buckets if it is a v1 source)



## bucketsBucketIDDelete

> bucketsBucketIDDelete($bucket_id, $zap_trace_span)

Delete a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of bucket to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->bucketsBucketIDDelete($bucket_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of bucket to delete |
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


## bucketsBucketIDGet

> \InfluxDB2Generated\Model\Bucket bucketsBucketIDGet($bucket_id, $zap_trace_span)

Retrieve a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of bucket to get
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsBucketIDGet($bucket_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of bucket to get |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Bucket**](../Model/Bucket.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## bucketsBucketIDLabelsGet

> \InfluxDB2Generated\Model\InlineResponse200 bucketsBucketIDLabelsGet($bucket_id, $zap_trace_span)

list all labels for a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsBucketIDLabelsGet($bucket_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDLabelsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## bucketsBucketIDLabelsLabelIDDelete

> bucketsBucketIDLabelsLabelIDDelete($bucket_id, $label_id, $zap_trace_span)

delete a label from a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$label_id = 'label_id_example'; // string | the label id to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->bucketsBucketIDLabelsLabelIDDelete($bucket_id, $label_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDLabelsLabelIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
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


## bucketsBucketIDLabelsPost

> \InfluxDB2Generated\Model\InlineResponse200 bucketsBucketIDLabelsPost($bucket_id, $label_mapping, $zap_trace_span)

add a label to a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$label_mapping = new \InfluxDB2Generated\Model\LabelMapping(); // \InfluxDB2Generated\Model\LabelMapping | label to add
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsBucketIDLabelsPost($bucket_id, $label_mapping, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDLabelsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
 **label_mapping** | [**\InfluxDB2Generated\Model\LabelMapping**](../Model/LabelMapping.md)| label to add |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## bucketsBucketIDLogsGet

> \InfluxDB2Generated\Model\OperationLogs bucketsBucketIDLogsGet($bucket_id, $zap_trace_span, $offset, $limit)

Retrieve operation logs for a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$offset = 56; // int | 
$limit = 20; // int | 

try {
    $result = $apiInstance->bucketsBucketIDLogsGet($bucket_id, $zap_trace_span, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
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


## bucketsBucketIDMembersGet

> \InfluxDB2Generated\Model\ResourceOwners bucketsBucketIDMembersGet($bucket_id, $zap_trace_span)

List all users with member privileges for a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsBucketIDMembersGet($bucket_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDMembersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
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


## bucketsBucketIDMembersPost

> \InfluxDB2Generated\Model\ResourceMember bucketsBucketIDMembersPost($bucket_id, $add_resource_member_request_body, $zap_trace_span)

Add bucket member

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as member
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsBucketIDMembersPost($bucket_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDMembersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
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


## bucketsBucketIDMembersUserIDDelete

> bucketsBucketIDMembersUserIDDelete($user_id, $bucket_id, $zap_trace_span)

removes a member from an bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of member to remove
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->bucketsBucketIDMembersUserIDDelete($user_id, $bucket_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of member to remove |
 **bucket_id** | **string**| ID of the bucket |
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


## bucketsBucketIDOwnersGet

> \InfluxDB2Generated\Model\ResourceMembers bucketsBucketIDOwnersGet($bucket_id, $zap_trace_span)

List all owners of a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsBucketIDOwnersGet($bucket_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDOwnersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
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


## bucketsBucketIDOwnersPost

> \InfluxDB2Generated\Model\ResourceOwner bucketsBucketIDOwnersPost($bucket_id, $add_resource_member_request_body, $zap_trace_span)

Add bucket owner

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as owner
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsBucketIDOwnersPost($bucket_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDOwnersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of the bucket |
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


## bucketsBucketIDOwnersUserIDDelete

> bucketsBucketIDOwnersUserIDDelete($user_id, $bucket_id, $zap_trace_span)

removes an owner from a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of owner to remove
$bucket_id = 'bucket_id_example'; // string | ID of the bucket
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->bucketsBucketIDOwnersUserIDDelete($user_id, $bucket_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of owner to remove |
 **bucket_id** | **string**| ID of the bucket |
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


## bucketsBucketIDPatch

> \InfluxDB2Generated\Model\Bucket bucketsBucketIDPatch($bucket_id, $bucket, $zap_trace_span)

Update a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket_id = 'bucket_id_example'; // string | ID of bucket to update
$bucket = new \InfluxDB2Generated\Model\Bucket(); // \InfluxDB2Generated\Model\Bucket | bucket update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsBucketIDPatch($bucket_id, $bucket, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsBucketIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket_id** | **string**| ID of bucket to update |
 **bucket** | [**\InfluxDB2Generated\Model\Bucket**](../Model/Bucket.md)| bucket update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Bucket**](../Model/Bucket.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## bucketsGet

> \InfluxDB2Generated\Model\Buckets bucketsGet($zap_trace_span, $offset, $limit, $org, $org_id, $name)

List all buckets

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$offset = 56; // int | 
$limit = 20; // int | 
$org = 'org_example'; // string | specifies the organization name of the resource
$org_id = 'org_id_example'; // string | specifies the organization id of the resource
$name = 'name_example'; // string | only returns buckets with the specified name

try {
    $result = $apiInstance->bucketsGet($zap_trace_span, $offset, $limit, $org, $org_id, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **offset** | **int**|  | [optional]
 **limit** | **int**|  | [optional] [default to 20]
 **org** | **string**| specifies the organization name of the resource | [optional]
 **org_id** | **string**| specifies the organization id of the resource | [optional]
 **name** | **string**| only returns buckets with the specified name | [optional]

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


## bucketsPost

> \InfluxDB2Generated\Model\Bucket bucketsPost($bucket, $zap_trace_span)

Create a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$bucket = new \InfluxDB2Generated\Model\Bucket(); // \InfluxDB2Generated\Model\Bucket | bucket to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->bucketsPost($bucket, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BucketsApi->bucketsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **bucket** | [**\InfluxDB2Generated\Model\Bucket**](../Model/Bucket.md)| bucket to create |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Bucket**](../Model/Bucket.md)

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


$apiInstance = new InfluxDB2Generated\Api\BucketsApi(
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
    echo 'Exception when calling BucketsApi->sourcesSourceIDBucketsGet: ', $e->getMessage(), PHP_EOL;
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

