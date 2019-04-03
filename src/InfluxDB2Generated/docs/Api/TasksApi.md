# InfluxDB2Generated\TasksApi

All URIs are relative to *https://raw.githubusercontent.com/api/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**tasksGet**](TasksApi.md#tasksGet) | **GET** /tasks | List tasks.
[**tasksPost**](TasksApi.md#tasksPost) | **POST** /tasks | Create a new task
[**tasksTaskIDDelete**](TasksApi.md#tasksTaskIDDelete) | **DELETE** /tasks/{taskID} | Delete a task
[**tasksTaskIDGet**](TasksApi.md#tasksTaskIDGet) | **GET** /tasks/{taskID} | Retrieve an task
[**tasksTaskIDLabelsGet**](TasksApi.md#tasksTaskIDLabelsGet) | **GET** /tasks/{taskID}/labels | list all labels for a task
[**tasksTaskIDLabelsLabelIDDelete**](TasksApi.md#tasksTaskIDLabelsLabelIDDelete) | **DELETE** /tasks/{taskID}/labels/{labelID} | delete a label from a task
[**tasksTaskIDLabelsPost**](TasksApi.md#tasksTaskIDLabelsPost) | **POST** /tasks/{taskID}/labels | add a label to a task
[**tasksTaskIDLogsGet**](TasksApi.md#tasksTaskIDLogsGet) | **GET** /tasks/{taskID}/logs | Retrieve all logs for a task
[**tasksTaskIDMembersGet**](TasksApi.md#tasksTaskIDMembersGet) | **GET** /tasks/{taskID}/members | List all task members
[**tasksTaskIDMembersPost**](TasksApi.md#tasksTaskIDMembersPost) | **POST** /tasks/{taskID}/members | Add task member
[**tasksTaskIDMembersUserIDDelete**](TasksApi.md#tasksTaskIDMembersUserIDDelete) | **DELETE** /tasks/{taskID}/members/{userID} | removes a member from an task
[**tasksTaskIDOwnersGet**](TasksApi.md#tasksTaskIDOwnersGet) | **GET** /tasks/{taskID}/owners | List all task owners
[**tasksTaskIDOwnersPost**](TasksApi.md#tasksTaskIDOwnersPost) | **POST** /tasks/{taskID}/owners | Add task owner
[**tasksTaskIDOwnersUserIDDelete**](TasksApi.md#tasksTaskIDOwnersUserIDDelete) | **DELETE** /tasks/taskID}/owners/{userID} | removes an owner from an task
[**tasksTaskIDPatch**](TasksApi.md#tasksTaskIDPatch) | **PATCH** /tasks/{taskID} | Update a task
[**tasksTaskIDRunsGet**](TasksApi.md#tasksTaskIDRunsGet) | **GET** /tasks/{taskID}/runs | Retrieve list of run records for a task
[**tasksTaskIDRunsPost**](TasksApi.md#tasksTaskIDRunsPost) | **POST** /tasks/{taskID}/runs | manually start a run of the task now overriding the current schedule.
[**tasksTaskIDRunsRunIDGet**](TasksApi.md#tasksTaskIDRunsRunIDGet) | **GET** /tasks/{taskID}/runs/{runID} | Retrieve a single run record for a task
[**tasksTaskIDRunsRunIDLogsGet**](TasksApi.md#tasksTaskIDRunsRunIDLogsGet) | **GET** /tasks/{taskID}/runs/{runID}/logs | Retrieve all logs for a run
[**tasksTaskIDRunsRunIDRetryPost**](TasksApi.md#tasksTaskIDRunsRunIDRetryPost) | **POST** /tasks/{taskID}/runs/{runID}/retry | Retry a task run


# **tasksGet**
> \InfluxDB2Generated\Model\InlineResponse2001 tasksGet($zap_trace_span, $after, $user, $org, $limit)

List tasks.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$after = 'after_example'; // string | returns tasks after specified ID
$user = 'user_example'; // string | filter tasks to a specific user ID
$org = 'org_example'; // string | filter tasks to a specific organization ID
$limit = 100; // int | the number of tasks to return

try {
    $result = $apiInstance->tasksGet($zap_trace_span, $after, $user, $org, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **after** | **string**| returns tasks after specified ID | [optional]
 **user** | **string**| filter tasks to a specific user ID | [optional]
 **org** | **string**| filter tasks to a specific organization ID | [optional]
 **limit** | **int**| the number of tasks to return | [optional] [default to 100]

### Return type

[**\InfluxDB2Generated\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksPost**
> \InfluxDB2Generated\Model\Task tasksPost($task_create_request, $zap_trace_span)

Create a new task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_create_request = new \InfluxDB2Generated\Model\TaskCreateRequest(); // \InfluxDB2Generated\Model\TaskCreateRequest | task to create
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksPost($task_create_request, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_create_request** | [**\InfluxDB2Generated\Model\TaskCreateRequest**](../Model/TaskCreateRequest.md)| task to create |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Task**](../Model/Task.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDDelete**
> tasksTaskIDDelete($task_id, $zap_trace_span)

Delete a task

Deletes a task and all associated records

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of task to delete
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->tasksTaskIDDelete($task_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of task to delete |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDGet**
> \InfluxDB2Generated\Model\Task tasksTaskIDGet($task_id, $zap_trace_span)

Retrieve an task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of task to get
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDGet($task_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of task to get |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Task**](../Model/Task.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDLabelsGet**
> \InfluxDB2Generated\Model\InlineResponse200 tasksTaskIDLabelsGet($task_id, $zap_trace_span)

list all labels for a task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of the task
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDLabelsGet($task_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDLabelsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of the task |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDLabelsLabelIDDelete**
> tasksTaskIDLabelsLabelIDDelete($task_id, $label_id, $zap_trace_span)

delete a label from a task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of the task
$label_id = 'label_id_example'; // string | the label id
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $apiInstance->tasksTaskIDLabelsLabelIDDelete($task_id, $label_id, $zap_trace_span);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDLabelsLabelIDDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of the task |
 **label_id** | **string**| the label id |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDLabelsPost**
> \InfluxDB2Generated\Model\LabelResponse tasksTaskIDLabelsPost($task_id, $label_mapping, $zap_trace_span)

add a label to a task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of the task
$label_mapping = new \InfluxDB2Generated\Model\LabelMapping(); // \InfluxDB2Generated\Model\LabelMapping | label to add
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDLabelsPost($task_id, $label_mapping, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDLabelsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of the task |
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

# **tasksTaskIDLogsGet**
> \InfluxDB2Generated\Model\Logs tasksTaskIDLogsGet($task_id, $zap_trace_span)

Retrieve all logs for a task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of task to get logs for
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDLogsGet($task_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of task to get logs for |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Logs**](../Model/Logs.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDMembersGet**
> \InfluxDB2Generated\Model\ResourceMembers tasksTaskIDMembersGet($task_id, $zap_trace_span)

List all task members

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
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
    echo 'Exception when calling TasksApi->tasksTaskIDMembersGet: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDMembersPost**
> \InfluxDB2Generated\Model\ResourceMember tasksTaskIDMembersPost($task_id, $add_resource_member_request_body, $zap_trace_span)

Add task member

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
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
    echo 'Exception when calling TasksApi->tasksTaskIDMembersPost: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDMembersUserIDDelete**
> tasksTaskIDMembersUserIDDelete($user_id, $task_id, $zap_trace_span)

removes a member from an task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
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
    echo 'Exception when calling TasksApi->tasksTaskIDMembersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDOwnersGet**
> \InfluxDB2Generated\Model\ResourceOwners tasksTaskIDOwnersGet($task_id, $zap_trace_span)

List all task owners

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
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
    echo 'Exception when calling TasksApi->tasksTaskIDOwnersGet: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDOwnersPost**
> \InfluxDB2Generated\Model\ResourceOwner tasksTaskIDOwnersPost($task_id, $add_resource_member_request_body, $zap_trace_span)

Add task owner

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
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
    echo 'Exception when calling TasksApi->tasksTaskIDOwnersPost: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDOwnersUserIDDelete**
> tasksTaskIDOwnersUserIDDelete($user_id, $task_id, $zap_trace_span)

removes an owner from an task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
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
    echo 'Exception when calling TasksApi->tasksTaskIDOwnersUserIDDelete: ', $e->getMessage(), PHP_EOL;
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

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDPatch**
> \InfluxDB2Generated\Model\Task tasksTaskIDPatch($task_id, $task_update_request, $zap_trace_span)

Update a task

Update a task. This will cancel all queued runs.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of task to get
$task_update_request = new \InfluxDB2Generated\Model\TaskUpdateRequest(); // \InfluxDB2Generated\Model\TaskUpdateRequest | task update to apply
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDPatch($task_id, $task_update_request, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDPatch: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of task to get |
 **task_update_request** | [**\InfluxDB2Generated\Model\TaskUpdateRequest**](../Model/TaskUpdateRequest.md)| task update to apply |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Task**](../Model/Task.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDRunsGet**
> \InfluxDB2Generated\Model\InlineResponse2002 tasksTaskIDRunsGet($task_id, $zap_trace_span, $after, $limit, $after_time, $before_time)

Retrieve list of run records for a task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of task to get runs for
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context
$after = 'after_example'; // string | returns runs after specified ID
$limit = 20; // int | the number of runs to return
$after_time = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | filter runs to those scheduled after this time, RFC3339
$before_time = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime | filter runs to those scheduled before this time, RFC3339

try {
    $result = $apiInstance->tasksTaskIDRunsGet($task_id, $zap_trace_span, $after, $limit, $after_time, $before_time);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDRunsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of task to get runs for |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]
 **after** | **string**| returns runs after specified ID | [optional]
 **limit** | **int**| the number of runs to return | [optional] [default to 20]
 **after_time** | **\DateTime**| filter runs to those scheduled after this time, RFC3339 | [optional]
 **before_time** | **\DateTime**| filter runs to those scheduled before this time, RFC3339 | [optional]

### Return type

[**\InfluxDB2Generated\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDRunsPost**
> \InfluxDB2Generated\Model\Run tasksTaskIDRunsPost($task_id, $run_manually)

manually start a run of the task now overriding the current schedule.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | 
$run_manually = new \InfluxDB2Generated\Model\RunManually(); // \InfluxDB2Generated\Model\RunManually | 

try {
    $result = $apiInstance->tasksTaskIDRunsPost($task_id, $run_manually);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDRunsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**|  |
 **run_manually** | [**\InfluxDB2Generated\Model\RunManually**](../Model/RunManually.md)|  | [optional]

### Return type

[**\InfluxDB2Generated\Model\Run**](../Model/Run.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDRunsRunIDGet**
> \InfluxDB2Generated\Model\Run tasksTaskIDRunsRunIDGet($task_id, $run_id, $zap_trace_span)

Retrieve a single run record for a task

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | task ID
$run_id = 'run_id_example'; // string | run ID
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDRunsRunIDGet($task_id, $run_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDRunsRunIDGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| task ID |
 **run_id** | **string**| run ID |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Run**](../Model/Run.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDRunsRunIDLogsGet**
> \InfluxDB2Generated\Model\Logs tasksTaskIDRunsRunIDLogsGet($task_id, $run_id, $zap_trace_span)

Retrieve all logs for a run

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | ID of task to get logs for.
$run_id = 'run_id_example'; // string | ID of run to get logs for.
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDRunsRunIDLogsGet($task_id, $run_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDRunsRunIDLogsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| ID of task to get logs for. |
 **run_id** | **string**| ID of run to get logs for. |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Logs**](../Model/Logs.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **tasksTaskIDRunsRunIDRetryPost**
> \InfluxDB2Generated\Model\Run tasksTaskIDRunsRunIDRetryPost($task_id, $run_id, $zap_trace_span)

Retry a task run

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


$apiInstance = new InfluxDB2Generated\Api\TasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$task_id = 'task_id_example'; // string | task ID
$run_id = 'run_id_example'; // string | run ID
$zap_trace_span = {"trace_id":"1","span_id":"1","baggage":{"key":"value"}}; // string | OpenTracing span context

try {
    $result = $apiInstance->tasksTaskIDRunsRunIDRetryPost($task_id, $run_id, $zap_trace_span);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TasksApi->tasksTaskIDRunsRunIDRetryPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **task_id** | **string**| task ID |
 **run_id** | **string**| run ID |
 **zap_trace_span** | **string**| OpenTracing span context | [optional]

### Return type

[**\InfluxDB2Generated\Model\Run**](../Model/Run.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

