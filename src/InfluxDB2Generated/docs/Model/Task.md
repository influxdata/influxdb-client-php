# Task

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional] 
**org_id** | **string** | The ID of the organization that owns this Task. | [optional] 
**org** | **string** | The organization that owns this Task. | [optional] 
**name** | **string** | A description of the task. | 
**status** | **string** | The current status of the task. When updated to &#39;inactive&#39;, cancels all queued jobs of this task. | [optional] [default to 'active']
**labels** | [**\InfluxDB2Generated\Model\Label[]**](Label.md) |  | [optional] 
**authorization_id** | **string** | The ID of the authorization used when this task communicates with the query engine. | [optional] 
**flux** | **string** | The Flux script to run for this task. | 
**every** | **string** | A simple task repetition schedule; parsed from Flux. | [optional] 
**cron** | **string** | A task repetition schedule in the form &#39;* * * * * *&#39;; parsed from Flux. | [optional] 
**offset** | **string** | Duration to delay after the schedule, before executing the task; parsed from flux. | [optional] 
**latest_completed** | [**\DateTime**](\DateTime.md) | Timestamp of latest scheduled, completed run, RFC3339. | [optional] 
**created_at** | [**\DateTime**](\DateTime.md) |  | [optional] 
**updated_at** | [**\DateTime**](\DateTime.md) |  | [optional] 
**links** | [**\InfluxDB2Generated\Model\TaskLinks**](TaskLinks.md) |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


