<?php
/**
 * Query
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
 * Query Class Doc Comment
 *
 * @category Class
 * @description Query InfluxDB with the Flux language
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Query implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Query';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'extern' => '\InfluxDB2\Model\File',
        'query' => 'string',
        'type' => 'string',
        'params' => 'map[string,object]',
        'dialect' => '\InfluxDB2\Model\Dialect',
        'now' => '\DateTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'extern' => null,
        'query' => null,
        'type' => null,
        'params' => null,
        'dialect' => null,
        'now' => 'date-time'
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
        'extern' => 'extern',
        'query' => 'query',
        'type' => 'type',
        'params' => 'params',
        'dialect' => 'dialect',
        'now' => 'now'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'extern' => 'setExtern',
        'query' => 'setQuery',
        'type' => 'setType',
        'params' => 'setParams',
        'dialect' => 'setDialect',
        'now' => 'setNow'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'extern' => 'getExtern',
        'query' => 'getQuery',
        'type' => 'getType',
        'params' => 'getParams',
        'dialect' => 'getDialect',
        'now' => 'getNow'
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

    const TYPE_FLUX = 'flux';



    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_FLUX,
        ];
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
        $this->container['extern'] = isset($data['extern']) ? $data['extern'] : null;
        $this->container['query'] = isset($data['query']) ? $data['query'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['params'] = isset($data['params']) ? $data['params'] : null;
        $this->container['dialect'] = isset($data['dialect']) ? $data['dialect'] : null;
        $this->container['now'] = isset($data['now']) ? $data['now'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['query'] === null) {
            $invalidProperties[] = "'query' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

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
     * Gets extern
     *
     * @return \InfluxDB2\Model\File|null
     */
    public function getExtern()
    {
        return $this->container['extern'];
    }

    /**
     * Sets extern
     *
     * @param \InfluxDB2\Model\File|null $extern extern
     *
     * @return $this
     */
    public function setExtern($extern)
    {
        $this->container['extern'] = $extern;

        return $this;
    }

    /**
     * Gets query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->container['query'];
    }

    /**
     * Sets query
     *
     * @param string $query The query script to execute.
     *
     * @return $this
     */
    public function setQuery($query)
    {
        $this->container['query'] = $query;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type The type of query. Must be "flux".
     *
     * @return $this
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets params
     *
     * @return map[string,object]|null
     */
    public function getParams()
    {
        return $this->container['params'];
    }

    /**
     * Sets params
     *
     * @param map[string,object]|null $params Key-value pairs passed as parameters during query execution.  To use parameters in your query, pass a _`query`_ with `params` references (in dot notation)--for example:  ```json   query: "from(bucket: params.mybucket) |> range(start: params.rangeStart) |> limit(n:1)" ```  and pass _`params`_ with the key-value pairs--for example:  ```json   params: {     "mybucket": "environment",     "rangeStart": "-30d"   } ```  During query execution, InfluxDB passes _`params`_ to your script and substitutes the values.  #### Limitations  - If you use _`params`_, you can't use _`extern`_.
     *
     * @return $this
     */
    public function setParams($params)
    {
        $this->container['params'] = $params;

        return $this;
    }

    /**
     * Gets dialect
     *
     * @return \InfluxDB2\Model\Dialect|null
     */
    public function getDialect()
    {
        return $this->container['dialect'];
    }

    /**
     * Sets dialect
     *
     * @param \InfluxDB2\Model\Dialect|null $dialect dialect
     *
     * @return $this
     */
    public function setDialect($dialect)
    {
        $this->container['dialect'] = $dialect;

        return $this;
    }

    /**
     * Gets now
     *
     * @return \DateTime|null
     */
    public function getNow()
    {
        return $this->container['now'];
    }

    /**
     * Sets now
     *
     * @param \DateTime|null $now Specifies the time that should be reported as `now` in the query. Default is the server `now` time.
     *
     * @return $this
     */
    public function setNow($now)
    {
        $this->container['now'] = $now;

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


