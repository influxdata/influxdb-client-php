# InfluxDB2Generated\OrganizationsApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**orgsGet**](OrganizationsApi.md#orgsGet) | **GET** /orgs | List all organizations
[**orgsOrgIDDelete**](OrganizationsApi.md#orgsOrgIDDelete) | **DELETE** /orgs/{orgID} | Delete an organization
[**orgsOrgIDGet**](OrganizationsApi.md#orgsOrgIDGet) | **GET** /orgs/{orgID} | Retrieve an organization
[**orgsOrgIDLabelsGet**](OrganizationsApi.md#orgsOrgIDLabelsGet) | **GET** /orgs/{orgID}/labels | list all labels for a organization
[**orgsOrgIDLabelsLabelIDDelete**](OrganizationsApi.md#orgsOrgIDLabelsLabelIDDelete) | **DELETE** /orgs/{orgID}/labels/{labelID} | delete a label from an organization
[**orgsOrgIDLabelsPost**](OrganizationsApi.md#orgsOrgIDLabelsPost) | **POST** /orgs/{orgID}/labels | add a label to an organization
[**orgsOrgIDLogsGet**](OrganizationsApi.md#orgsOrgIDLogsGet) | **GET** /orgs/{orgID}/logs | Retrieve operation logs for an organization
[**orgsOrgIDMembersGet**](OrganizationsApi.md#orgsOrgIDMembersGet) | **GET** /orgs/{orgID}/members | List all members of an organization
[**orgsOrgIDMembersPost**](OrganizationsApi.md#orgsOrgIDMembersPost) | **POST** /orgs/{orgID}/members | Add organization member
[**orgsOrgIDMembersUserIDDelete**](OrganizationsApi.md#orgsOrgIDMembersUserIDDelete) | **DELETE** /orgs/{orgID}/members/{userID} | removes a member from an organization
[**orgsOrgIDOwnersGet**](OrganizationsApi.md#orgsOrgIDOwnersGet) | **GET** /orgs/{orgID}/owners | List all owners of an organization
[**orgsOrgIDOwnersPost**](OrganizationsApi.md#orgsOrgIDOwnersPost) | **POST** /orgs/{orgID}/owners | Add organization owner
[**orgsOrgIDOwnersUserIDDelete**](OrganizationsApi.md#orgsOrgIDOwnersUserIDDelete) | **DELETE** /orgs/{orgID}/owners/{userID} | removes an owner from an organization
[**orgsOrgIDPatch**](OrganizationsApi.md#orgsOrgIDPatch) | **PATCH** /orgs/{orgID} | Update an organization
[**orgsOrgIDSecretsDeletePost**](OrganizationsApi.md#orgsOrgIDSecretsDeletePost) | **POST** /orgs/{orgID}/secrets/delete | delete provided secrets
[**orgsOrgIDSecretsGet**](OrganizationsApi.md#orgsOrgIDSecretsGet) | **GET** /orgs/{orgID}/secrets | List all secret keys for an organization
[**orgsOrgIDSecretsPatch**](OrganizationsApi.md#orgsOrgIDSecretsPatch) | **PATCH** /orgs/{orgID}/secrets | Apply patch to the provided secrets
[**orgsPost**](OrganizationsApi.md#orgsPost) | **POST** /orgs | Create an organization



## orgsGet

> \InfluxDB2Generated\Model\Organizations orgsGet($zap_trace_span, $org, $org_id)

List all organizations

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$org = 'org_example'; // string | filter organizations to a specific organization name
$org_id = 'org_id_example'; // string | filter organizations to a specific organization ID

try {
    $result = $apiInstance->orgsGet($zap_trace_span, $org, $org_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **org** | **string**| filter organizations to a specific organization name | [optional]
 **org_id** | **string**| filter organizations to a specific organization ID | [optional]

### Return type

[**\InfluxDB2Generated\Model\Organizations**](../Model/Organizations.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## orgsOrgIDDelete

> orgsOrgIDDelete($org_id, $zap_trace_span)

Delete an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of organization to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->orgsOrgIDDelete($org_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of organization to delete |
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


## orgsOrgIDGet

> \InfluxDB2Generated\Model\Organization orgsOrgIDGet($org_id, $zap_trace_span)

Retrieve an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of organization to get
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDGet($org_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of organization to get |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Organization**](../Model/Organization.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## orgsOrgIDLabelsGet

> \InfluxDB2Generated\Model\InlineResponse200 orgsOrgIDLabelsGet($org_id, $zap_trace_span)

list all labels for a organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDLabelsGet($org_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDLabelsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
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


## orgsOrgIDLabelsLabelIDDelete

> orgsOrgIDLabelsLabelIDDelete($org_id, $label_id, $zap_trace_span)

delete a label from an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$label_id = 'label_id_example'; // string | the label id
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->orgsOrgIDLabelsLabelIDDelete($org_id, $label_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDLabelsLabelIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
 **label_id** | **string**| the label id |
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


## orgsOrgIDLabelsPost

> \InfluxDB2Generated\Model\LabelResponse orgsOrgIDLabelsPost($org_id, $label_mapping, $zap_trace_span)

add a label to an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$label_mapping = new \InfluxDB2Generated\Model\LabelMapping(); // \InfluxDB2Generated\Model\LabelMapping | label to add
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDLabelsPost($org_id, $label_mapping, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDLabelsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
 **label_mapping** | [**\InfluxDB2Generated\Model\LabelMapping**](../Model/LabelMapping.md)| label to add |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\LabelResponse**](../Model/LabelResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## orgsOrgIDLogsGet

> \InfluxDB2Generated\Model\OperationLogs orgsOrgIDLogsGet($org_id, $zap_trace_span, $offset, $limit)

Retrieve operation logs for an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$offset = 56; // int | 
$limit = 20; // int | 

try {
    $result = $apiInstance->orgsOrgIDLogsGet($org_id, $zap_trace_span, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
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


## orgsOrgIDMembersGet

> \InfluxDB2Generated\Model\ResourceMembers orgsOrgIDMembersGet($org_id, $zap_trace_span)

List all members of an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDMembersGet($org_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDMembersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
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


## orgsOrgIDMembersPost

> \InfluxDB2Generated\Model\ResourceMember orgsOrgIDMembersPost($org_id, $add_resource_member_request_body, $zap_trace_span)

Add organization member

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as member
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDMembersPost($org_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDMembersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
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


## orgsOrgIDMembersUserIDDelete

> orgsOrgIDMembersUserIDDelete($user_id, $org_id, $zap_trace_span)

removes a member from an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of member to remove
$org_id = 'org_id_example'; // string | ID of the organization
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->orgsOrgIDMembersUserIDDelete($user_id, $org_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of member to remove |
 **org_id** | **string**| ID of the organization |
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


## orgsOrgIDOwnersGet

> \InfluxDB2Generated\Model\ResourceOwners orgsOrgIDOwnersGet($org_id, $zap_trace_span)

List all owners of an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDOwnersGet($org_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDOwnersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
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


## orgsOrgIDOwnersPost

> \InfluxDB2Generated\Model\ResourceOwner orgsOrgIDOwnersPost($org_id, $add_resource_member_request_body, $zap_trace_span)

Add organization owner

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of the organization
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as owner
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDOwnersPost($org_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDOwnersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of the organization |
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


## orgsOrgIDOwnersUserIDDelete

> orgsOrgIDOwnersUserIDDelete($user_id, $org_id, $zap_trace_span)

removes an owner from an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of owner to remove
$org_id = 'org_id_example'; // string | ID of the organization
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->orgsOrgIDOwnersUserIDDelete($user_id, $org_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of owner to remove |
 **org_id** | **string**| ID of the organization |
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


## orgsOrgIDPatch

> \InfluxDB2Generated\Model\Organization orgsOrgIDPatch($org_id, $organization, $zap_trace_span)

Update an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$org_id = 'org_id_example'; // string | ID of organization to get
$organization = new \InfluxDB2Generated\Model\Organization(); // \InfluxDB2Generated\Model\Organization | organization update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsOrgIDPatch($org_id, $organization, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsOrgIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **org_id** | **string**| ID of organization to get |
 **organization** | [**\InfluxDB2Generated\Model\Organization**](../Model/Organization.md)| organization update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Organization**](../Model/Organization.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## orgsOrgIDSecretsDeletePost

> orgsOrgIDSecretsDeletePost($org_id, $secret_keys, $zap_trace_span)

delete provided secrets

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
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
    echo 'Exception when calling OrganizationsApi->orgsOrgIDSecretsDeletePost: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## orgsOrgIDSecretsGet

> \InfluxDB2Generated\Model\SecretKeys orgsOrgIDSecretsGet($org_id, $zap_trace_span)

List all secret keys for an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
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
    echo 'Exception when calling OrganizationsApi->orgsOrgIDSecretsGet: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## orgsOrgIDSecretsPatch

> orgsOrgIDSecretsPatch($org_id, $request_body, $zap_trace_span)

Apply patch to the provided secrets

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
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
    echo 'Exception when calling OrganizationsApi->orgsOrgIDSecretsPatch: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## orgsPost

> \InfluxDB2Generated\Model\Organization orgsPost($organization, $zap_trace_span)

Create an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\OrganizationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$organization = new \InfluxDB2Generated\Model\Organization(); // \InfluxDB2Generated\Model\Organization | organization to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->orgsPost($organization, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrganizationsApi->orgsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **organization** | [**\InfluxDB2Generated\Model\Organization**](../Model/Organization.md)| organization to create |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Organization**](../Model/Organization.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

