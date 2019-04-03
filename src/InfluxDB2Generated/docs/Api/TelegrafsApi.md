# InfluxDB2Generated\TelegrafsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**telegrafsGet**](TelegrafsApi.md#telegrafsGet) | **GET** /telegrafs | 
[**telegrafsPost**](TelegrafsApi.md#telegrafsPost) | **POST** /telegrafs | Create a telegraf config
[**telegrafsTelegrafIDDelete**](TelegrafsApi.md#telegrafsTelegrafIDDelete) | **DELETE** /telegrafs/{telegrafID} | delete a telegraf config
[**telegrafsTelegrafIDGet**](TelegrafsApi.md#telegrafsTelegrafIDGet) | **GET** /telegrafs/{telegrafID} | Retrieve a telegraf config
[**telegrafsTelegrafIDLabelsGet**](TelegrafsApi.md#telegrafsTelegrafIDLabelsGet) | **GET** /telegrafs/{telegrafID}/labels | list all labels for a telegraf config
[**telegrafsTelegrafIDLabelsLabelIDDelete**](TelegrafsApi.md#telegrafsTelegrafIDLabelsLabelIDDelete) | **DELETE** /telegrafs/{telegrafID}/labels/{labelID} | delete a label from a telegraf config
[**telegrafsTelegrafIDLabelsPost**](TelegrafsApi.md#telegrafsTelegrafIDLabelsPost) | **POST** /telegrafs/{telegrafID}/labels | add a label to a telegraf config
[**telegrafsTelegrafIDMembersGet**](TelegrafsApi.md#telegrafsTelegrafIDMembersGet) | **GET** /telegrafs/{telegrafID}/members | List all users with member privileges for a telegraf config
[**telegrafsTelegrafIDMembersPost**](TelegrafsApi.md#telegrafsTelegrafIDMembersPost) | **POST** /telegrafs/{telegrafID}/members | Add telegraf config member
[**telegrafsTelegrafIDMembersUserIDDelete**](TelegrafsApi.md#telegrafsTelegrafIDMembersUserIDDelete) | **DELETE** /telegrafs/{telegrafID}/members/{userID} | removes a member from a telegraf config
[**telegrafsTelegrafIDOwnersGet**](TelegrafsApi.md#telegrafsTelegrafIDOwnersGet) | **GET** /telegrafs/{telegrafID}/owners | List all owners of a telegraf config
[**telegrafsTelegrafIDOwnersPost**](TelegrafsApi.md#telegrafsTelegrafIDOwnersPost) | **POST** /telegrafs/{telegrafID}/owners | Add telegraf config owner
[**telegrafsTelegrafIDOwnersUserIDDelete**](TelegrafsApi.md#telegrafsTelegrafIDOwnersUserIDDelete) | **DELETE** /telegrafs/{telegrafID}/owners/{userID} | removes an owner from a telegraf config
[**telegrafsTelegrafIDPut**](TelegrafsApi.md#telegrafsTelegrafIDPut) | **PUT** /telegrafs/{telegrafID} | Update a telegraf config


# **telegrafsGet**
> \InfluxDB2Generated\Model\Telegrafs telegrafsGet($org_id, $zap_trace_span)



### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | specifies the organization of the resource
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsGet($org_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| specifies the organization of the resource |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Telegrafs**](../Model/Telegrafs.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsPost**
> \InfluxDB2Generated\Model\Telegraf telegrafsPost($telegraf_request, $zap_trace_span)

Create a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_request = new \InfluxDB2Generated\Model\TelegrafRequest(); // \InfluxDB2Generated\Model\TelegrafRequest | telegraf config to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsPost($telegraf_request, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_request** | [**\InfluxDB2Generated\Model\TelegrafRequest**](../Model/TelegrafRequest.md)| telegraf config to create |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Telegraf**](../Model/Telegraf.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDDelete**
> \InfluxDB2Generated\Model\Telegraf telegrafsTelegrafIDDelete($telegraf_id, $zap_trace_span)

delete a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of telegraf config
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDDelete($telegraf_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of telegraf config |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Telegraf**](../Model/Telegraf.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDGet**
> \InfluxDB2Generated\Model\Telegraf telegrafsTelegrafIDGet($telegraf_id, $zap_trace_span)

Retrieve a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of telegraf config
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDGet($telegraf_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of telegraf config |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Telegraf**](../Model/Telegraf.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json, application/toml, application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDLabelsGet**
> \InfluxDB2Generated\Model\LabelsResponse telegrafsTelegrafIDLabelsGet($telegraf_id, $zap_trace_span)

list all labels for a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf config
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDLabelsGet($telegraf_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDLabelsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of the telegraf config |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\LabelsResponse**](../Model/LabelsResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDLabelsLabelIDDelete**
> telegrafsTelegrafIDLabelsLabelIDDelete($telegraf_id, $label_id, $zap_trace_span)

delete a label from a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf config
$label_id = 'label_id_example'; // string | the label ID
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->telegrafsTelegrafIDLabelsLabelIDDelete($telegraf_id, $label_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDLabelsLabelIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of the telegraf config |
 **label_id** | **string**| the label ID |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDLabelsPost**
> \InfluxDB2Generated\Model\LabelResponse telegrafsTelegrafIDLabelsPost($telegraf_id, $label_mapping, $zap_trace_span)

add a label to a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf config
$label_mapping = new \InfluxDB2Generated\Model\LabelMapping(); // \InfluxDB2Generated\Model\LabelMapping | label to add
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDLabelsPost($telegraf_id, $label_mapping, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDLabelsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of the telegraf config |
 **label_mapping** | [**\InfluxDB2Generated\Model\LabelMapping**](../Model/LabelMapping.md)| label to add |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\LabelResponse**](../Model/LabelResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDMembersGet**
> \InfluxDB2Generated\Model\ResourceMembers telegrafsTelegrafIDMembersGet($telegraf_id, $zap_trace_span)

List all users with member privileges for a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf config
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDMembersGet($telegraf_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDMembersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of the telegraf config |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ResourceMembers**](../Model/ResourceMembers.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDMembersPost**
> \InfluxDB2Generated\Model\ResourceMember telegrafsTelegrafIDMembersPost($telegraf_id, $add_resource_member_request_body, $zap_trace_span)

Add telegraf config member

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf config
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as member
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDMembersPost($telegraf_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDMembersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of the telegraf config |
 **add_resource_member_request_body** | [**\InfluxDB2Generated\Model\AddResourceMemberRequestBody**](../Model/AddResourceMemberRequestBody.md)| user to add as member |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ResourceMember**](../Model/ResourceMember.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDMembersUserIDDelete**
> telegrafsTelegrafIDMembersUserIDDelete($user_id, $telegraf_id, $zap_trace_span)

removes a member from a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of member to remove
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->telegrafsTelegrafIDMembersUserIDDelete($user_id, $telegraf_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of member to remove |
 **telegraf_id** | **string**| ID of the telegraf |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDOwnersGet**
> \InfluxDB2Generated\Model\ResourceOwners telegrafsTelegrafIDOwnersGet($telegraf_id, $zap_trace_span)

List all owners of a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf config
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDOwnersGet($telegraf_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDOwnersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of the telegraf config |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ResourceOwners**](../Model/ResourceOwners.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDOwnersPost**
> \InfluxDB2Generated\Model\ResourceOwner telegrafsTelegrafIDOwnersPost($telegraf_id, $add_resource_member_request_body, $zap_trace_span)

Add telegraf config owner

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf config
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as owner
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDOwnersPost($telegraf_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDOwnersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of the telegraf config |
 **add_resource_member_request_body** | [**\InfluxDB2Generated\Model\AddResourceMemberRequestBody**](../Model/AddResourceMemberRequestBody.md)| user to add as owner |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\ResourceOwner**](../Model/ResourceOwner.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDOwnersUserIDDelete**
> telegrafsTelegrafIDOwnersUserIDDelete($user_id, $telegraf_id, $zap_trace_span)

removes an owner from a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of owner to remove
$telegraf_id = 'telegraf_id_example'; // string | ID of the telegraf config
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->telegrafsTelegrafIDOwnersUserIDDelete($user_id, $telegraf_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of owner to remove |
 **telegraf_id** | **string**| ID of the telegraf config |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **telegrafsTelegrafIDPut**
> \InfluxDB2Generated\Model\Telegraf telegrafsTelegrafIDPut($telegraf_id, $telegraf_request, $zap_trace_span)

Update a telegraf config

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TelegrafsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$telegraf_id = 'telegraf_id_example'; // string | ID of telegraf config
$telegraf_request = new \InfluxDB2Generated\Model\TelegrafRequest(); // \InfluxDB2Generated\Model\TelegrafRequest | telegraf config update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->telegrafsTelegrafIDPut($telegraf_id, $telegraf_request, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TelegrafsApi->telegrafsTelegrafIDPut: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **telegraf_id** | **string**| ID of telegraf config |
 **telegraf_request** | [**\InfluxDB2Generated\Model\TelegrafRequest**](../Model/TelegrafRequest.md)| telegraf config update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Telegraf**](../Model/Telegraf.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

