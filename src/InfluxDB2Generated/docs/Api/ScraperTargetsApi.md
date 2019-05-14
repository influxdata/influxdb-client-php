# InfluxDB2Generated\ScraperTargetsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**scrapersGet**](ScraperTargetsApi.md#scrapersGet) | **GET** /scrapers | get all scraper targets
[**scrapersPost**](ScraperTargetsApi.md#scrapersPost) | **POST** /scrapers | create a scraper target
[**scrapersScraperTargetIDDelete**](ScraperTargetsApi.md#scrapersScraperTargetIDDelete) | **DELETE** /scrapers/{scraperTargetID} | delete a scraper target
[**scrapersScraperTargetIDLabelsGet**](ScraperTargetsApi.md#scrapersScraperTargetIDLabelsGet) | **GET** /scrapers/{scraperTargetID}/labels | list all labels for a scraper targets
[**scrapersScraperTargetIDLabelsLabelIDDelete**](ScraperTargetsApi.md#scrapersScraperTargetIDLabelsLabelIDDelete) | **DELETE** /scrapers/{scraperTargetID}/labels/{labelID} | delete a label from a scraper target
[**scrapersScraperTargetIDLabelsLabelIDPatch**](ScraperTargetsApi.md#scrapersScraperTargetIDLabelsLabelIDPatch) | **PATCH** /scrapers/{scraperTargetID}/labels/{labelID} | update a label from a scraper target
[**scrapersScraperTargetIDLabelsPost**](ScraperTargetsApi.md#scrapersScraperTargetIDLabelsPost) | **POST** /scrapers/{scraperTargetID}/labels | add a label to a scraper target
[**scrapersScraperTargetIDMembersGet**](ScraperTargetsApi.md#scrapersScraperTargetIDMembersGet) | **GET** /scrapers/{scraperTargetID}/members | List all users with member privileges for a scraper target
[**scrapersScraperTargetIDMembersPost**](ScraperTargetsApi.md#scrapersScraperTargetIDMembersPost) | **POST** /scrapers/{scraperTargetID}/members | Add scraper target member
[**scrapersScraperTargetIDMembersUserIDDelete**](ScraperTargetsApi.md#scrapersScraperTargetIDMembersUserIDDelete) | **DELETE** /scrapers/{scraperTargetID}/members/{userID} | removes a member from a scraper target
[**scrapersScraperTargetIDOwnersGet**](ScraperTargetsApi.md#scrapersScraperTargetIDOwnersGet) | **GET** /scrapers/{scraperTargetID}/owners | List all owners of a scraper target
[**scrapersScraperTargetIDOwnersPost**](ScraperTargetsApi.md#scrapersScraperTargetIDOwnersPost) | **POST** /scrapers/{scraperTargetID}/owners | Add scraper target owner
[**scrapersScraperTargetIDOwnersUserIDDelete**](ScraperTargetsApi.md#scrapersScraperTargetIDOwnersUserIDDelete) | **DELETE** /scrapers/{scraperTargetID}/owners/{userID} | removes an owner from a scraper target
[**scrapersScraperTargetIDPatch**](ScraperTargetsApi.md#scrapersScraperTargetIDPatch) | **PATCH** /scrapers/{scraperTargetID} | update a scraper target



## scrapersGet

> \InfluxDB2Generated\Model\ScraperTargetResponses scrapersGet()

get all scraper targets

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->scrapersGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\InfluxDB2Generated\Model\ScraperTargetResponses**](../Model/ScraperTargetResponses.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## scrapersPost

> \InfluxDB2Generated\Model\ScraperTargetResponse scrapersPost($scraper_target_request)

create a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_request = new \InfluxDB2Generated\Model\ScraperTargetRequest(); // \InfluxDB2Generated\Model\ScraperTargetRequest | scraper target to create

try {
    $result = $apiInstance->scrapersPost($scraper_target_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_request** | [**\InfluxDB2Generated\Model\ScraperTargetRequest**](../Model/ScraperTargetRequest.md)| scraper target to create |

### Return type

[**\InfluxDB2Generated\Model\ScraperTargetResponse**](../Model/ScraperTargetResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## scrapersScraperTargetIDDelete

> scrapersScraperTargetIDDelete($scraper_target_id, $zap_trace_span)

delete a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | id of the scraper target
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->scrapersScraperTargetIDDelete($scraper_target_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| id of the scraper target |
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


## scrapersScraperTargetIDLabelsGet

> \InfluxDB2Generated\Model\InlineResponse200 scrapersScraperTargetIDLabelsGet($scraper_target_id, $zap_trace_span)

list all labels for a scraper targets

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->scrapersScraperTargetIDLabelsGet($scraper_target_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDLabelsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| ID of the scraper target |
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


## scrapersScraperTargetIDLabelsLabelIDDelete

> scrapersScraperTargetIDLabelsLabelIDDelete($scraper_target_id, $label_id, $zap_trace_span)

delete a label from a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$label_id = 'label_id_example'; // string | ID of the label
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->scrapersScraperTargetIDLabelsLabelIDDelete($scraper_target_id, $label_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDLabelsLabelIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| ID of the scraper target |
 **label_id** | **string**| ID of the label |
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


## scrapersScraperTargetIDLabelsLabelIDPatch

> scrapersScraperTargetIDLabelsLabelIDPatch($scraper_target_id, $label_id, $label, $zap_trace_span)

update a label from a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$label_id = 'label_id_example'; // string | ID of the label
$label = new \InfluxDB2Generated\Model\Label(); // \InfluxDB2Generated\Model\Label | label update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->scrapersScraperTargetIDLabelsLabelIDPatch($scraper_target_id, $label_id, $label, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDLabelsLabelIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| ID of the scraper target |
 **label_id** | **string**| ID of the label |
 **label** | [**\InfluxDB2Generated\Model\Label**](../Model/Label.md)| label update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## scrapersScraperTargetIDLabelsPost

> \InfluxDB2Generated\Model\InlineResponse200 scrapersScraperTargetIDLabelsPost($scraper_target_id, $label, $zap_trace_span)

add a label to a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$label = new \InfluxDB2Generated\Model\Label(); // \InfluxDB2Generated\Model\Label | label to add
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->scrapersScraperTargetIDLabelsPost($scraper_target_id, $label, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDLabelsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| ID of the scraper target |
 **label** | [**\InfluxDB2Generated\Model\Label**](../Model/Label.md)| label to add |
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


## scrapersScraperTargetIDMembersGet

> \InfluxDB2Generated\Model\ResourceMembers scrapersScraperTargetIDMembersGet($scraper_target_id, $zap_trace_span)

List all users with member privileges for a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->scrapersScraperTargetIDMembersGet($scraper_target_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDMembersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| ID of the scraper target |
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


## scrapersScraperTargetIDMembersPost

> \InfluxDB2Generated\Model\ResourceMember scrapersScraperTargetIDMembersPost($scraper_target_id, $add_resource_member_request_body, $zap_trace_span)

Add scraper target member

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as member
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->scrapersScraperTargetIDMembersPost($scraper_target_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDMembersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| ID of the scraper target |
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


## scrapersScraperTargetIDMembersUserIDDelete

> scrapersScraperTargetIDMembersUserIDDelete($user_id, $scraper_target_id, $zap_trace_span)

removes a member from a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of member to remove
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->scrapersScraperTargetIDMembersUserIDDelete($user_id, $scraper_target_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of member to remove |
 **scraper_target_id** | **string**| ID of the scraper target |
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


## scrapersScraperTargetIDOwnersGet

> \InfluxDB2Generated\Model\ResourceOwners scrapersScraperTargetIDOwnersGet($scraper_target_id, $zap_trace_span)

List all owners of a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->scrapersScraperTargetIDOwnersGet($scraper_target_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDOwnersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| ID of the scraper target |
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


## scrapersScraperTargetIDOwnersPost

> \InfluxDB2Generated\Model\ResourceOwner scrapersScraperTargetIDOwnersPost($scraper_target_id, $add_resource_member_request_body, $zap_trace_span)

Add scraper target owner

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as owner
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->scrapersScraperTargetIDOwnersPost($scraper_target_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDOwnersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| ID of the scraper target |
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


## scrapersScraperTargetIDOwnersUserIDDelete

> scrapersScraperTargetIDOwnersUserIDDelete($user_id, $scraper_target_id, $zap_trace_span)

removes an owner from a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of owner to remove
$scraper_target_id = 'scraper_target_id_example'; // string | ID of the scraper target
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->scrapersScraperTargetIDOwnersUserIDDelete($user_id, $scraper_target_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of owner to remove |
 **scraper_target_id** | **string**| ID of the scraper target |
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


## scrapersScraperTargetIDPatch

> \InfluxDB2Generated\Model\ScraperTargetResponse scrapersScraperTargetIDPatch($scraper_target_id, $scraper_target_request, $zap_trace_span)

update a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\ScraperTargetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$scraper_target_id = 'scraper_target_id_example'; // string | id of the scraper target
$scraper_target_request = new \InfluxDB2Generated\Model\ScraperTargetRequest(); // \InfluxDB2Generated\Model\ScraperTargetRequest | scraper target update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->scrapersScraperTargetIDPatch($scraper_target_id, $scraper_target_request, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ScraperTargetsApi->scrapersScraperTargetIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **scraper_target_id** | **string**| id of the scraper target |
 **scraper_target_request** | [**\InfluxDB2Generated\Model\ScraperTargetRequest**](../Model/ScraperTargetRequest.md)| scraper target update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ScraperTargetResponse**](../Model/ScraperTargetResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

