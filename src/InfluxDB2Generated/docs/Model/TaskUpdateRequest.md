# # TaskUpdateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** | Starting state of the task. &#39;inactive&#39; tasks are not run until they are updated to &#39;active&#39; | [optional] [default to 'active']
**flux** | **string** | The Flux script to run for this task. | [optional] 
**name** | **string** | Override the &#39;name&#39; option in the flux script. | [optional] 
**every** | **string** | Override the &#39;every&#39; option in the flux script. | [optional] 
**cron** | **string** | Override the &#39;cron&#39; option in the flux script. | [optional] 
**offset** | **string** | Override the &#39;offset&#39; option in the flux script. | [optional] 
**token** | **string** | Override the existing token associated with the task. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


