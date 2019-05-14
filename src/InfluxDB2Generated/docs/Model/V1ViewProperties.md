# # V1ViewProperties

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  | [optional] 
**queries** | [**\InfluxDB2Generated\Model\DashboardQuery[]**](DashboardQuery.md) |  | [optional] 
**axes** | [**\InfluxDB2Generated\Model\V1ViewPropertiesAxes**](V1ViewPropertiesAxes.md) |  | [optional] 
**graph_type** | **string** | The viewport for a view&#39;s graph/visualization | [optional] [default to 'line']
**colors** | [**\InfluxDB2Generated\Model\DashboardColor[]**](DashboardColor.md) | Colors define color encoding of data into a visualization | [optional] 
**legend** | [**\InfluxDB2Generated\Model\V1ViewPropertiesLegend**](V1ViewPropertiesLegend.md) |  | [optional] 
**table_options** | **object** |  | [optional] 
**field_options** | [**\InfluxDB2Generated\Model\RenamableField[]**](RenamableField.md) | fieldOptions represent the fields retrieved by the query with customization options | [optional] 
**time_format** | **string** | timeFormat describes the display format for time values according to moment.js date formatting | [optional] 
**decimal_points** | [**\InfluxDB2Generated\Model\V1ViewPropertiesDecimalPoints**](V1ViewPropertiesDecimalPoints.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


