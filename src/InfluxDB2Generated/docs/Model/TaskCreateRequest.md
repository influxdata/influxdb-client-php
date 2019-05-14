# # TaskCreateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**org_id** | **string** | The ID of the organization that owns this Task. | [optional] 
**org** | **string** | The name of the organization that owns this Task. | [optional] 
**status** | **string** | Starting state of the task. &#39;inactive&#39; tasks are not run until they are updated to &#39;active&#39; | [optional] [default to 'active']
**flux** | **string** | The Flux script to run for this task. | 
**token** | **string** | The token to use for authenticating this task when it executes queries. If omitted, uses the token associated with the request that creates the task. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


