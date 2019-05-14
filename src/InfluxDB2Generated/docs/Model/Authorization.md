# # Authorization

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**org_id** | **string** | ID of org that authorization is scoped to. | 
**status** | **string** | if inactive the token is inactive and requests using the token will be rejected. | [optional] [default to 'active']
**description** | **string** | A description of the token. | [optional] 
**permissions** | [**\InfluxDB2Generated\Model\Permission[]**](Permission.md) | List of permissions for an auth.  An auth must have at least one Permission. | 
**id** | **string** |  | [optional] 
**token** | **string** | Passed via the Authorization Header and Token Authentication type. | [optional] 
**user_id** | **string** | ID of user that created and owns the token. | [optional] 
**user** | **string** | Name of user that created and owns the token. | [optional] 
**org** | **string** | Name of the org token is scoped to. | [optional] 
**links** | [**\InfluxDB2Generated\Model\AuthorizationLinks**](AuthorizationLinks.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


