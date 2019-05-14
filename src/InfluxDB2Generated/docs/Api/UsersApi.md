# InfluxDB2Generated\UsersApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**bucketsBucketIDMembersGet**](UsersApi.md#bucketsBucketIDMembersGet) | **GET** /buckets/{bucketID}/members | List all users with member privileges for a bucket
[**bucketsBucketIDMembersPost**](UsersApi.md#bucketsBucketIDMembersPost) | **POST** /buckets/{bucketID}/members | Add bucket member
[**bucketsBucketIDMembersUserIDDelete**](UsersApi.md#bucketsBucketIDMembersUserIDDelete) | **DELETE** /buckets/{bucketID}/members/{userID} | removes a member from an bucket
[**bucketsBucketIDOwnersGet**](UsersApi.md#bucketsBucketIDOwnersGet) | **GET** /buckets/{bucketID}/owners | List all owners of a bucket
[**bucketsBucketIDOwnersPost**](UsersApi.md#bucketsBucketIDOwnersPost) | **POST** /buckets/{bucketID}/owners | Add bucket owner
[**bucketsBucketIDOwnersUserIDDelete**](UsersApi.md#bucketsBucketIDOwnersUserIDDelete) | **DELETE** /buckets/{bucketID}/owners/{userID} | removes an owner from a bucket
[**dashboardsDashboardIDMembersGet**](UsersApi.md#dashboardsDashboardIDMembersGet) | **GET** /dashboards/{dashboardID}/members | List all dashboard members
[**dashboardsDashboardIDMembersPost**](UsersApi.md#dashboardsDashboardIDMembersPost) | **POST** /dashboards/{dashboardID}/members | Add dashboard member
[**dashboardsDashboardIDMembersUserIDDelete**](UsersApi.md#dashboardsDashboardIDMembersUserIDDelete) | **DELETE** /dashboards/{dashboardID}/members/{userID} | removes a member from an dashboard
[**dashboardsDashboardIDOwnersGet**](UsersApi.md#dashboardsDashboardIDOwnersGet) | **GET** /dashboards/{dashboardID}/owners | List all dashboard owners
[**dashboardsDashboardIDOwnersPost**](UsersApi.md#dashboardsDashboardIDOwnersPost) | **POST** /dashboards/{dashboardID}/owners | Add dashboard owner
[**dashboardsDashboardIDOwnersUserIDDelete**](UsersApi.md#dashboardsDashboardIDOwnersUserIDDelete) | **DELETE** /dashboards/{dashboardID}/owners/{userID} | removes an owner from a dashboard
[**meGet**](UsersApi.md#meGet) | **GET** /me | Returns currently authenticated user
[**mePasswordPut**](UsersApi.md#mePasswordPut) | **PUT** /me/password | Update password
[**orgsOrgIDMembersGet**](UsersApi.md#orgsOrgIDMembersGet) | **GET** /orgs/{orgID}/members | List all members of an organization
[**orgsOrgIDMembersPost**](UsersApi.md#orgsOrgIDMembersPost) | **POST** /orgs/{orgID}/members | Add organization member
[**orgsOrgIDMembersUserIDDelete**](UsersApi.md#orgsOrgIDMembersUserIDDelete) | **DELETE** /orgs/{orgID}/members/{userID} | removes a member from an organization
[**orgsOrgIDOwnersGet**](UsersApi.md#orgsOrgIDOwnersGet) | **GET** /orgs/{orgID}/owners | List all owners of an organization
[**orgsOrgIDOwnersPost**](UsersApi.md#orgsOrgIDOwnersPost) | **POST** /orgs/{orgID}/owners | Add organization owner
[**orgsOrgIDOwnersUserIDDelete**](UsersApi.md#orgsOrgIDOwnersUserIDDelete) | **DELETE** /orgs/{orgID}/owners/{userID} | removes an owner from an organization
[**scrapersScraperTargetIDMembersGet**](UsersApi.md#scrapersScraperTargetIDMembersGet) | **GET** /scrapers/{scraperTargetID}/members | List all users with member privileges for a scraper target
[**scrapersScraperTargetIDMembersPost**](UsersApi.md#scrapersScraperTargetIDMembersPost) | **POST** /scrapers/{scraperTargetID}/members | Add scraper target member
[**scrapersScraperTargetIDMembersUserIDDelete**](UsersApi.md#scrapersScraperTargetIDMembersUserIDDelete) | **DELETE** /scrapers/{scraperTargetID}/members/{userID} | removes a member from a scraper target
[**scrapersScraperTargetIDOwnersGet**](UsersApi.md#scrapersScraperTargetIDOwnersGet) | **GET** /scrapers/{scraperTargetID}/owners | List all owners of a scraper target
[**scrapersScraperTargetIDOwnersPost**](UsersApi.md#scrapersScraperTargetIDOwnersPost) | **POST** /scrapers/{scraperTargetID}/owners | Add scraper target owner
[**scrapersScraperTargetIDOwnersUserIDDelete**](UsersApi.md#scrapersScraperTargetIDOwnersUserIDDelete) | **DELETE** /scrapers/{scraperTargetID}/owners/{userID} | removes an owner from a scraper target
[**tasksTaskIDMembersGet**](UsersApi.md#tasksTaskIDMembersGet) | **GET** /tasks/{taskID}/members | List all task members
[**tasksTaskIDMembersPost**](UsersApi.md#tasksTaskIDMembersPost) | **POST** /tasks/{taskID}/members | Add task member
[**tasksTaskIDMembersUserIDDelete**](UsersApi.md#tasksTaskIDMembersUserIDDelete) | **DELETE** /tasks/{taskID}/members/{userID} | removes a member from an task
[**tasksTaskIDOwnersGet**](UsersApi.md#tasksTaskIDOwnersGet) | **GET** /tasks/{taskID}/owners | List all task owners
[**tasksTaskIDOwnersPost**](UsersApi.md#tasksTaskIDOwnersPost) | **POST** /tasks/{taskID}/owners | Add task owner
[**tasksTaskIDOwnersUserIDDelete**](UsersApi.md#tasksTaskIDOwnersUserIDDelete) | **DELETE** /tasks/taskID}/owners/{userID} | removes an owner from an task
[**telegrafsTelegrafIDMembersGet**](UsersApi.md#telegrafsTelegrafIDMembersGet) | **GET** /telegrafs/{telegrafID}/members | List all users with member privileges for a telegraf config
[**telegrafsTelegrafIDMembersPost**](UsersApi.md#telegrafsTelegrafIDMembersPost) | **POST** /telegrafs/{telegrafID}/members | Add telegraf config member
[**telegrafsTelegrafIDMembersUserIDDelete**](UsersApi.md#telegrafsTelegrafIDMembersUserIDDelete) | **DELETE** /telegrafs/{telegrafID}/members/{userID} | removes a member from a telegraf config
[**telegrafsTelegrafIDOwnersGet**](UsersApi.md#telegrafsTelegrafIDOwnersGet) | **GET** /telegrafs/{telegrafID}/owners | List all owners of a telegraf config
[**telegrafsTelegrafIDOwnersPost**](UsersApi.md#telegrafsTelegrafIDOwnersPost) | **POST** /telegrafs/{telegrafID}/owners | Add telegraf config owner
[**telegrafsTelegrafIDOwnersUserIDDelete**](UsersApi.md#telegrafsTelegrafIDOwnersUserIDDelete) | **DELETE** /telegrafs/{telegrafID}/owners/{userID} | removes an owner from a telegraf config
[**usersGet**](UsersApi.md#usersGet) | **GET** /users | List all users
[**usersPost**](UsersApi.md#usersPost) | **POST** /users | Create a user
[**usersUserIDDelete**](UsersApi.md#usersUserIDDelete) | **DELETE** /users/{userID} | deletes a user
[**usersUserIDGet**](UsersApi.md#usersUserIDGet) | **GET** /users/{userID} | Retrieve a user
[**usersUserIDLogsGet**](UsersApi.md#usersUserIDLogsGet) | **GET** /users/{userID}/logs | Retrieve operation logs for a user
[**usersUserIDPasswordPut**](UsersApi.md#usersUserIDPasswordPut) | **PUT** /users/{userID}/password | Update password
[**usersUserIDPatch**](UsersApi.md#usersUserIDPatch) | **PATCH** /users/{userID} | Update a user



## bucketsBucketIDMembersGet

> \InfluxDB2Generated\Model\ResourceOwners bucketsBucketIDMembersGet($bucket_id, $zap_trace_span)

List all users with member privileges for a bucket

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->bucketsBucketIDMembersGet: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->bucketsBucketIDMembersPost: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->bucketsBucketIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->bucketsBucketIDOwnersGet: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->bucketsBucketIDOwnersPost: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->bucketsBucketIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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


## dashboardsDashboardIDMembersGet

> \InfluxDB2Generated\Model\ResourceMembers dashboardsDashboardIDMembersGet($dashboard_id, $zap_trace_span)

List all dashboard members

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDMembersGet($dashboard_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->dashboardsDashboardIDMembersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
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


## dashboardsDashboardIDMembersPost

> \InfluxDB2Generated\Model\ResourceMember dashboardsDashboardIDMembersPost($dashboard_id, $add_resource_member_request_body, $zap_trace_span)

Add dashboard member

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as member
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDMembersPost($dashboard_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->dashboardsDashboardIDMembersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
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


## dashboardsDashboardIDMembersUserIDDelete

> dashboardsDashboardIDMembersUserIDDelete($user_id, $dashboard_id, $zap_trace_span)

removes a member from an dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of member to remove
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->dashboardsDashboardIDMembersUserIDDelete($user_id, $dashboard_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->dashboardsDashboardIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of member to remove |
 **dashboard_id** | **string**| ID of the dashboard |
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


## dashboardsDashboardIDOwnersGet

> \InfluxDB2Generated\Model\ResourceOwners dashboardsDashboardIDOwnersGet($dashboard_id, $zap_trace_span)

List all dashboard owners

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDOwnersGet($dashboard_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->dashboardsDashboardIDOwnersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
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


## dashboardsDashboardIDOwnersPost

> \InfluxDB2Generated\Model\ResourceOwner dashboardsDashboardIDOwnersPost($dashboard_id, $add_resource_member_request_body, $zap_trace_span)

Add dashboard owner

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as owner
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->dashboardsDashboardIDOwnersPost($dashboard_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->dashboardsDashboardIDOwnersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **dashboard_id** | **string**| ID of the dashboard |
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


## dashboardsDashboardIDOwnersUserIDDelete

> dashboardsDashboardIDOwnersUserIDDelete($user_id, $dashboard_id, $zap_trace_span)

removes an owner from a dashboard

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of owner to remove
$dashboard_id = 'dashboard_id_example'; // string | ID of the dashboard
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->dashboardsDashboardIDOwnersUserIDDelete($user_id, $dashboard_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->dashboardsDashboardIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of owner to remove |
 **dashboard_id** | **string**| ID of the dashboard |
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


## meGet

> \InfluxDB2Generated\Model\User meGet($zap_trace_span)

Returns currently authenticated user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->meGet($zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->meGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## mePasswordPut

> mePasswordPut($password_reset_body, $zap_trace_span)

Update password

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$password_reset_body = new \InfluxDB2Generated\Model\PasswordResetBody(); // \InfluxDB2Generated\Model\PasswordResetBody | new password
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->mePasswordPut($password_reset_body, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->mePasswordPut: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **password_reset_body** | [**\InfluxDB2Generated\Model\PasswordResetBody**](../Model/PasswordResetBody.md)| new password |
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


## orgsOrgIDMembersGet

> \InfluxDB2Generated\Model\ResourceMembers orgsOrgIDMembersGet($org_id, $zap_trace_span)

List all members of an organization

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->orgsOrgIDMembersGet: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->orgsOrgIDMembersPost: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->orgsOrgIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->orgsOrgIDOwnersGet: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->orgsOrgIDOwnersPost: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->orgsOrgIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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


## scrapersScraperTargetIDMembersGet

> \InfluxDB2Generated\Model\ResourceMembers scrapersScraperTargetIDMembersGet($scraper_target_id, $zap_trace_span)

List all users with member privileges for a scraper target

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->scrapersScraperTargetIDMembersGet: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->scrapersScraperTargetIDMembersPost: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->scrapersScraperTargetIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->scrapersScraperTargetIDOwnersGet: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->scrapersScraperTargetIDOwnersPost: ', $e->getMessage(), PHP_EOL;
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


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->scrapersScraperTargetIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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


## tasksTaskIDMembersGet

> \InfluxDB2Generated\Model\ResourceMembers tasksTaskIDMembersGet($task_id, $zap_trace_span)

List all task members

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of the task
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDMembersGet($task_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->tasksTaskIDMembersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of the task |
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


## tasksTaskIDMembersPost

> \InfluxDB2Generated\Model\ResourceMember tasksTaskIDMembersPost($task_id, $add_resource_member_request_body, $zap_trace_span)

Add task member

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of the task
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as member
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDMembersPost($task_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->tasksTaskIDMembersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of the task |
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


## tasksTaskIDMembersUserIDDelete

> tasksTaskIDMembersUserIDDelete($user_id, $task_id, $zap_trace_span)

removes a member from an task

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of member to remove
$task_id = 'task_id_example'; // string | ID of the task
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->tasksTaskIDMembersUserIDDelete($user_id, $task_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->tasksTaskIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of member to remove |
 **task_id** | **string**| ID of the task |
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


## tasksTaskIDOwnersGet

> \InfluxDB2Generated\Model\ResourceOwners tasksTaskIDOwnersGet($task_id, $zap_trace_span)

List all task owners

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of the task
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDOwnersGet($task_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->tasksTaskIDOwnersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of the task |
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


## tasksTaskIDOwnersPost

> \InfluxDB2Generated\Model\ResourceOwner tasksTaskIDOwnersPost($task_id, $add_resource_member_request_body, $zap_trace_span)

Add task owner

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of the task
$add_resource_member_request_body = new \InfluxDB2Generated\Model\AddResourceMemberRequestBody(); // \InfluxDB2Generated\Model\AddResourceMemberRequestBody | user to add as owner
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDOwnersPost($task_id, $add_resource_member_request_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->tasksTaskIDOwnersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of the task |
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


## tasksTaskIDOwnersUserIDDelete

> tasksTaskIDOwnersUserIDDelete($user_id, $task_id, $zap_trace_span)

removes an owner from an task

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of owner to remove
$task_id = 'task_id_example'; // string | ID of the task
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->tasksTaskIDOwnersUserIDDelete($user_id, $task_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->tasksTaskIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of owner to remove |
 **task_id** | **string**| ID of the task |
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


## telegrafsTelegrafIDMembersGet

> \InfluxDB2Generated\Model\ResourceMembers telegrafsTelegrafIDMembersGet($telegraf_id, $zap_trace_span)

List all users with member privileges for a telegraf config

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->telegrafsTelegrafIDMembersGet: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## telegrafsTelegrafIDMembersPost

> \InfluxDB2Generated\Model\ResourceMember telegrafsTelegrafIDMembersPost($telegraf_id, $add_resource_member_request_body, $zap_trace_span)

Add telegraf config member

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->telegrafsTelegrafIDMembersPost: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## telegrafsTelegrafIDMembersUserIDDelete

> telegrafsTelegrafIDMembersUserIDDelete($user_id, $telegraf_id, $zap_trace_span)

removes a member from a telegraf config

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->telegrafsTelegrafIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## telegrafsTelegrafIDOwnersGet

> \InfluxDB2Generated\Model\ResourceOwners telegrafsTelegrafIDOwnersGet($telegraf_id, $zap_trace_span)

List all owners of a telegraf config

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->telegrafsTelegrafIDOwnersGet: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## telegrafsTelegrafIDOwnersPost

> \InfluxDB2Generated\Model\ResourceOwner telegrafsTelegrafIDOwnersPost($telegraf_id, $add_resource_member_request_body, $zap_trace_span)

Add telegraf config owner

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->telegrafsTelegrafIDOwnersPost: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## telegrafsTelegrafIDOwnersUserIDDelete

> telegrafsTelegrafIDOwnersUserIDDelete($user_id, $telegraf_id, $zap_trace_span)

removes an owner from a telegraf config

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
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
    echo 'Exception when calling UsersApi->telegrafsTelegrafIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersGet

> \InfluxDB2Generated\Model\Users usersGet($zap_trace_span)

List all users

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->usersGet($zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Users**](../Model/Users.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersPost

> \InfluxDB2Generated\Model\User usersPost($user)

Create a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user = new \InfluxDB2Generated\Model\User(); // \InfluxDB2Generated\Model\User | user to create

try {
    $result = $apiInstance->usersPost($user);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user** | [**\InfluxDB2Generated\Model\User**](../Model/User.md)| user to create |

### Return type

[**\InfluxDB2Generated\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersUserIDDelete

> usersUserIDDelete($user_id, $zap_trace_span)

deletes a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of user to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->usersUserIDDelete($user_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersUserIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of user to delete |
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


## usersUserIDGet

> \InfluxDB2Generated\Model\User usersUserIDGet($user_id, $zap_trace_span)

Retrieve a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of user to get
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->usersUserIDGet($user_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersUserIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of user to get |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersUserIDLogsGet

> \InfluxDB2Generated\Model\OperationLogs usersUserIDLogsGet($user_id, $zap_trace_span, $offset, $limit)

Retrieve operation logs for a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of the user
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$offset = 56; // int | 
$limit = 20; // int | 

try {
    $result = $apiInstance->usersUserIDLogsGet($user_id, $zap_trace_span, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersUserIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of the user |
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


## usersUserIDPasswordPut

> \InfluxDB2Generated\Model\User usersUserIDPasswordPut($user_id, $password_reset_body, $zap_trace_span)

Update password

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of the user
$password_reset_body = new \InfluxDB2Generated\Model\PasswordResetBody(); // \InfluxDB2Generated\Model\PasswordResetBody | new password
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->usersUserIDPasswordPut($user_id, $password_reset_body, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersUserIDPasswordPut: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of the user |
 **password_reset_body** | [**\InfluxDB2Generated\Model\PasswordResetBody**](../Model/PasswordResetBody.md)| new password |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersUserIDPatch

> \InfluxDB2Generated\Model\User usersUserIDPatch($user_id, $user, $zap_trace_span)

Update a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$user_id = 'user_id_example'; // string | ID of user to update
$user = new \InfluxDB2Generated\Model\User(); // \InfluxDB2Generated\Model\User | user update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->usersUserIDPatch($user_id, $user, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersUserIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **user_id** | **string**| ID of user to update |
 **user** | [**\InfluxDB2Generated\Model\User**](../Model/User.md)| user update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

