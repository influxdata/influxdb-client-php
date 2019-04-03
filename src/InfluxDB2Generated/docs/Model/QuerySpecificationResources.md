# QuerySpecificationResources

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**priority** | [**OneOfStringString**](OneOfStringString.md) | priority of the query | [optional] 
**concurrency_quota** | **int** | number of concurrent workers allowed to process this query; 0 indicates the planner can pick the optimal concurrency. | [optional] [default to 0]
**memory_bytes_quota** | **int** | number of bytes of RAM this query may consume; 0 means unlimited. | [optional] [default to 0]

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


