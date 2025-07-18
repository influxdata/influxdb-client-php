<?php
/**
 * Axis
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
 * Axis Class Doc Comment
 *
 * @category Class
 * @description Axis used in a visualization.
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Axis implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Axis';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'bounds' => 'string[]',
        'label' => 'string',
        'prefix' => 'string',
        'suffix' => 'string',
        'base' => 'string',
        'scale' => '\InfluxDB2\Model\AxisScale'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'bounds' => null,
        'label' => null,
        'prefix' => null,
        'suffix' => null,
        'base' => null,
        'scale' => null
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
        'bounds' => 'bounds',
        'label' => 'label',
        'prefix' => 'prefix',
        'suffix' => 'suffix',
        'base' => 'base',
        'scale' => 'scale'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'bounds' => 'setBounds',
        'label' => 'setLabel',
        'prefix' => 'setPrefix',
        'suffix' => 'setSuffix',
        'base' => 'setBase',
        'scale' => 'setScale'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'bounds' => 'getBounds',
        'label' => 'getLabel',
        'prefix' => 'getPrefix',
        'suffix' => 'getSuffix',
        'base' => 'getBase',
        'scale' => 'getScale'
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

    const BASE_EMPTY = '';
    const BASE__2 = '2';
    const BASE__10 = '10';



    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getBaseAllowableValues()
    {
        return [
            self::BASE_EMPTY,
            self::BASE__2,
            self::BASE__10,
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
        $this->container['bounds'] = isset($data['bounds']) ? $data['bounds'] : null;
        $this->container['label'] = isset($data['label']) ? $data['label'] : null;
        $this->container['prefix'] = isset($data['prefix']) ? $data['prefix'] : null;
        $this->container['suffix'] = isset($data['suffix']) ? $data['suffix'] : null;
        $this->container['base'] = isset($data['base']) ? $data['base'] : null;
        $this->container['scale'] = isset($data['scale']) ? $data['scale'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getBaseAllowableValues();
        if (!is_null($this->container['base']) && !in_array($this->container['base'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'base', must be one of '%s'",
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
     * Gets bounds
     *
     * @return string[]|null
     */
    public function getBounds()
    {
        return $this->container['bounds'];
    }

    /**
     * Sets bounds
     *
     * @param string[]|null $bounds The extents of the axis in the form [lower, upper]. Clients determine whether bounds are inclusive or exclusive of their limits.
     *
     * @return $this
     */
    public function setBounds($bounds)
    {
        $this->container['bounds'] = $bounds;

        return $this;
    }

    /**
     * Gets label
     *
     * @return string|null
     */
    public function getLabel()
    {
        return $this->container['label'];
    }

    /**
     * Sets label
     *
     * @param string|null $label Description of the axis.
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->container['label'] = $label;

        return $this;
    }

    /**
     * Gets prefix
     *
     * @return string|null
     */
    public function getPrefix()
    {
        return $this->container['prefix'];
    }

    /**
     * Sets prefix
     *
     * @param string|null $prefix Label prefix for formatting axis values.
     *
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->container['prefix'] = $prefix;

        return $this;
    }

    /**
     * Gets suffix
     *
     * @return string|null
     */
    public function getSuffix()
    {
        return $this->container['suffix'];
    }

    /**
     * Sets suffix
     *
     * @param string|null $suffix Label suffix for formatting axis values.
     *
     * @return $this
     */
    public function setSuffix($suffix)
    {
        $this->container['suffix'] = $suffix;

        return $this;
    }

    /**
     * Gets base
     *
     * @return string|null
     */
    public function getBase()
    {
        return $this->container['base'];
    }

    /**
     * Sets base
     *
     * @param string|null $base Radix for formatting axis values.
     *
     * @return $this
     */
    public function setBase($base)
    {
        $allowedValues = $this->getBaseAllowableValues();
        if (!is_null($base) && !in_array($base, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'base', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['base'] = $base;

        return $this;
    }

    /**
     * Gets scale
     *
     * @return \InfluxDB2\Model\AxisScale|null
     */
    public function getScale()
    {
        return $this->container['scale'];
    }

    /**
     * Sets scale
     *
     * @param \InfluxDB2\Model\AxisScale|null $scale scale
     *
     * @return $this
     */
    public function setScale($scale)
    {
        $this->container['scale'] = $scale;

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


