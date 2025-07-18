<?php
/**
 * TemplateApply
 *
 * PHP version 5
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * InfluxDB OSS API Service
 *
 * The InfluxDB v2 API provides a programmatic interface for all interactions with InfluxDB. Access the InfluxDB API using the `/api/v2/` endpoint.
 *
 * OpenAPI spec version: 2.0.0
 *
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 3.3.4
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace InfluxDB2\Model;

use \ArrayAccess;
use \InfluxDB2\ObjectSerializer;

/**
 * TemplateApply Class Doc Comment
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class TemplateApply implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TemplateApply';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'dry_run' => 'bool',
        'org_id' => 'string',
        'stack_id' => 'string',
        'template' => '\InfluxDB2\Model\TemplateApplyTemplate',
        'templates' => '\InfluxDB2\Model\TemplateApplyTemplates[]',
        'env_refs' => 'map[string,object]',
        'secrets' => 'map[string,string]',
        'remotes' => '\InfluxDB2\Model\TemplateApplyRemotes[]',
        'actions' => 'object[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'dry_run' => null,
        'org_id' => null,
        'stack_id' => null,
        'template' => null,
        'templates' => null,
        'env_refs' => null,
        'secrets' => null,
        'remotes' => null,
        'actions' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'dry_run' => 'dryRun',
        'org_id' => 'orgID',
        'stack_id' => 'stackID',
        'template' => 'template',
        'templates' => 'templates',
        'env_refs' => 'envRefs',
        'secrets' => 'secrets',
        'remotes' => 'remotes',
        'actions' => 'actions'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'dry_run' => 'setDryRun',
        'org_id' => 'setOrgId',
        'stack_id' => 'setStackId',
        'template' => 'setTemplate',
        'templates' => 'setTemplates',
        'env_refs' => 'setEnvRefs',
        'secrets' => 'setSecrets',
        'remotes' => 'setRemotes',
        'actions' => 'setActions'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'dry_run' => 'getDryRun',
        'org_id' => 'getOrgId',
        'stack_id' => 'getStackId',
        'template' => 'getTemplate',
        'templates' => 'getTemplates',
        'env_refs' => 'getEnvRefs',
        'secrets' => 'getSecrets',
        'remotes' => 'getRemotes',
        'actions' => 'getActions'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }





    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->container['dry_run'] = isset($data['dry_run']) ? $data['dry_run'] : null;
        $this->container['org_id'] = isset($data['org_id']) ? $data['org_id'] : null;
        $this->container['stack_id'] = isset($data['stack_id']) ? $data['stack_id'] : null;
        $this->container['template'] = isset($data['template']) ? $data['template'] : null;
        $this->container['templates'] = isset($data['templates']) ? $data['templates'] : null;
        $this->container['env_refs'] = isset($data['env_refs']) ? $data['env_refs'] : null;
        $this->container['secrets'] = isset($data['secrets']) ? $data['secrets'] : null;
        $this->container['remotes'] = isset($data['remotes']) ? $data['remotes'] : null;
        $this->container['actions'] = isset($data['actions']) ? $data['actions'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets dry_run
     *
     * @return bool|null
     */
    public function getDryRun()
    {
        return $this->container['dry_run'];
    }

    /**
     * Sets dry_run
     *
     * @param bool|null $dry_run Only applies a dry run of the templates passed in the request.  - Validates the template and generates a resource diff and summary. - Doesn't install templates or make changes to the InfluxDB instance.
     *
     * @return $this
     */
    public function setDryRun($dry_run)
    {
        $this->container['dry_run'] = $dry_run;

        return $this;
    }

    /**
     * Gets org_id
     *
     * @return string|null
     */
    public function getOrgId()
    {
        return $this->container['org_id'];
    }

    /**
     * Sets org_id
     *
     * @param string|null $org_id Organization ID. InfluxDB applies templates to this organization. The organization owns all resources created by the template.  To find your organization, see how to [view organizations](https://docs.influxdata.com/influxdb/v2.3/organizations/view-orgs/).
     *
     * @return $this
     */
    public function setOrgId($org_id)
    {
        $this->container['org_id'] = $org_id;

        return $this;
    }

    /**
     * Gets stack_id
     *
     * @return string|null
     */
    public function getStackId()
    {
        return $this->container['stack_id'];
    }

    /**
     * Sets stack_id
     *
     * @param string|null $stack_id ID of the stack to update.  To apply templates to an existing stack in the organization, use the `stackID` parameter. If you apply templates without providing a stack ID, InfluxDB initializes a new stack with all new resources.  To find a stack ID, use the InfluxDB [`/api/v2/stacks` API endpoint](#operation/ListStacks) to list stacks.  #### Related guides  - [Stacks](https://docs.influxdata.com/influxdb/v2.3/influxdb-templates/stacks/) - [View stacks](https://docs.influxdata.com/influxdb/v2.3/influxdb-templates/stacks/view/)
     *
     * @return $this
     */
    public function setStackId($stack_id)
    {
        $this->container['stack_id'] = $stack_id;

        return $this;
    }

    /**
     * Gets template
     *
     * @return \InfluxDB2\Model\TemplateApplyTemplate|null
     */
    public function getTemplate()
    {
        return $this->container['template'];
    }

    /**
     * Sets template
     *
     * @param \InfluxDB2\Model\TemplateApplyTemplate|null $template template
     *
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->container['template'] = $template;

        return $this;
    }

    /**
     * Gets templates
     *
     * @return \InfluxDB2\Model\TemplateApplyTemplates[]|null
     */
    public function getTemplates()
    {
        return $this->container['templates'];
    }

    /**
     * Sets templates
     *
     * @param \InfluxDB2\Model\TemplateApplyTemplates[]|null $templates A list of template objects to apply. A template object has a `contents` property with an array of InfluxDB resource configurations.  Use the `templates` parameter to apply multiple template objects. If you use `templates`, you can't use the `template` parameter.
     *
     * @return $this
     */
    public function setTemplates($templates)
    {
        $this->container['templates'] = $templates;

        return $this;
    }

    /**
     * Gets env_refs
     *
     * @return map[string,object]|null
     */
    public function getEnvRefs()
    {
        return $this->container['env_refs'];
    }

    /**
     * Sets env_refs
     *
     * @param map[string,object]|null $env_refs An object with key-value pairs that map to **environment references** in templates.  Environment references in templates are `envRef` objects with an `envRef.key` property. To substitute a custom environment reference value when applying templates, pass `envRefs` with the `envRef.key` and the value.  When you apply a template, InfluxDB replaces `envRef` objects in the template with the values that you provide in the `envRefs` parameter. For more examples, see how to [define environment references](https://docs.influxdata.com/influxdb/v2.3/influxdb-templates/use/#define-environment-references).  The following template fields may use environment references:    - `metadata.name`   - `spec.endpointName`   - `spec.associations.name`  For more information about including environment references in template fields, see how to [include user-definable resource names](https://docs.influxdata.com/influxdb/v2.3/influxdb-templates/create/#include-user-definable-resource-names).
     *
     * @return $this
     */
    public function setEnvRefs($env_refs)
    {
        $this->container['env_refs'] = $env_refs;

        return $this;
    }

    /**
     * Gets secrets
     *
     * @return map[string,string]|null
     */
    public function getSecrets()
    {
        return $this->container['secrets'];
    }

    /**
     * Sets secrets
     *
     * @param map[string,string]|null $secrets An object with key-value pairs that map to **secrets** in queries.  Queries may reference secrets stored in InfluxDB--for example, the following Flux script retrieves `POSTGRES_USERNAME` and `POSTGRES_PASSWORD` secrets and then uses them to connect to a PostgreSQL database:    ```js   import "sql"   import "influxdata/influxdb/secrets"    username = secrets.get(key: "POSTGRES_USERNAME")   password = secrets.get(key: "POSTGRES_PASSWORD")    sql.from(     driverName: "postgres",     dataSourceName: "postgresql://${username}:${password}@localhost:5432",     query: "SELECT * FROM example_table",   )   ```  To define secret values in your `/api/v2/templates/apply` request, pass the `secrets` parameter with key-value pairs--for example:    ```json   {     ...     "secrets": {       "POSTGRES_USERNAME": "pguser",       "POSTGRES_PASSWORD": "foo"     }     ...   }   ```  InfluxDB stores the key-value pairs as secrets that you can access with `secrets.get()`. Once stored, you can't view secret values in InfluxDB.  #### Related guides  - [How to pass secrets when installing a template](https://docs.influxdata.com/influxdb/v2.3/influxdb-templates/use/#pass-secrets-when-installing-a-template)
     *
     * @return $this
     */
    public function setSecrets($secrets)
    {
        $this->container['secrets'] = $secrets;

        return $this;
    }

    /**
     * Gets remotes
     *
     * @return \InfluxDB2\Model\TemplateApplyRemotes[]|null
     */
    public function getRemotes()
    {
        return $this->container['remotes'];
    }

    /**
     * Sets remotes
     *
     * @param \InfluxDB2\Model\TemplateApplyRemotes[]|null $remotes A list of URLs for template files.  To apply a template manifest file located at a URL, pass `remotes` with an array that contains the URL.
     *
     * @return $this
     */
    public function setRemotes($remotes)
    {
        $this->container['remotes'] = $remotes;

        return $this;
    }

    /**
     * Gets actions
     *
     * @return object[]|null
     */
    public function getActions()
    {
        return $this->container['actions'];
    }

    /**
     * Sets actions
     *
     * @param object[]|null $actions A list of `action` objects. Actions let you customize how InfluxDB applies templates in the request.  You can use the following actions to prevent creating or updating resources:  - A `skipKind` action skips template resources of a specified `kind`. - A `skipResource` action skips template resources with a specified `metadata.name`   and `kind`.
     *
     * @return $this
     */
    public function setActions($actions)
    {
        $this->container['actions'] = $actions;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }
}


