<?php
/**
 * Run
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
 * Run Class Doc Comment
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Run implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Run';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'task_id' => 'string',
        'status' => 'string',
        'scheduled_for' => '\DateTime',
        'log' => '\InfluxDB2\Model\LogEvent[]',
        'flux' => 'string',
        'started_at' => '\DateTime',
        'finished_at' => '\DateTime',
        'requested_at' => '\DateTime',
        'links' => '\InfluxDB2\Model\RunLinks'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'id' => null,
        'task_id' => null,
        'status' => null,
        'scheduled_for' => 'date-time',
        'log' => null,
        'flux' => null,
        'started_at' => 'date-time',
        'finished_at' => 'date-time',
        'requested_at' => 'date-time',
        'links' => null
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
        'id' => 'id',
        'task_id' => 'taskID',
        'status' => 'status',
        'scheduled_for' => 'scheduledFor',
        'log' => 'log',
        'flux' => 'flux',
        'started_at' => 'startedAt',
        'finished_at' => 'finishedAt',
        'requested_at' => 'requestedAt',
        'links' => 'links'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'task_id' => 'setTaskId',
        'status' => 'setStatus',
        'scheduled_for' => 'setScheduledFor',
        'log' => 'setLog',
        'flux' => 'setFlux',
        'started_at' => 'setStartedAt',
        'finished_at' => 'setFinishedAt',
        'requested_at' => 'setRequestedAt',
        'links' => 'setLinks'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'task_id' => 'getTaskId',
        'status' => 'getStatus',
        'scheduled_for' => 'getScheduledFor',
        'log' => 'getLog',
        'flux' => 'getFlux',
        'started_at' => 'getStartedAt',
        'finished_at' => 'getFinishedAt',
        'requested_at' => 'getRequestedAt',
        'links' => 'getLinks'
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

    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_STARTED = 'started';
    const STATUS_FAILED = 'failed';
    const STATUS_SUCCESS = 'success';
    const STATUS_CANCELED = 'canceled';



    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_SCHEDULED,
            self::STATUS_STARTED,
            self::STATUS_FAILED,
            self::STATUS_SUCCESS,
            self::STATUS_CANCELED,
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['task_id'] = isset($data['task_id']) ? $data['task_id'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['scheduled_for'] = isset($data['scheduled_for']) ? $data['scheduled_for'] : null;
        $this->container['log'] = isset($data['log']) ? $data['log'] : null;
        $this->container['flux'] = isset($data['flux']) ? $data['flux'] : null;
        $this->container['started_at'] = isset($data['started_at']) ? $data['started_at'] : null;
        $this->container['finished_at'] = isset($data['finished_at']) ? $data['finished_at'] : null;
        $this->container['requested_at'] = isset($data['requested_at']) ? $data['requested_at'] : null;
        $this->container['links'] = isset($data['links']) ? $data['links'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
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
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets task_id
     *
     * @return string|null
     */
    public function getTaskId()
    {
        return $this->container['task_id'];
    }

    /**
     * Sets task_id
     *
     * @param string|null $task_id task_id
     *
     * @return $this
     */
    public function setTaskId($task_id)
    {
        $this->container['task_id'] = $task_id;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets scheduled_for
     *
     * @return \DateTime|null
     */
    public function getScheduledFor()
    {
        return $this->container['scheduled_for'];
    }

    /**
     * Sets scheduled_for
     *
     * @param \DateTime|null $scheduled_for The time [RFC3339 date/time format](https://docs.influxdata.com/influxdb/v2.3/reference/glossary/#rfc3339-timestamp) used for the run's `now` option.
     *
     * @return $this
     */
    public function setScheduledFor($scheduled_for)
    {
        $this->container['scheduled_for'] = $scheduled_for;

        return $this;
    }

    /**
     * Gets log
     *
     * @return \InfluxDB2\Model\LogEvent[]|null
     */
    public function getLog()
    {
        return $this->container['log'];
    }

    /**
     * Sets log
     *
     * @param \InfluxDB2\Model\LogEvent[]|null $log An array of logs associated with the run.
     *
     * @return $this
     */
    public function setLog($log)
    {
        $this->container['log'] = $log;

        return $this;
    }

    /**
     * Gets flux
     *
     * @return string|null
     */
    public function getFlux()
    {
        return $this->container['flux'];
    }

    /**
     * Sets flux
     *
     * @param string|null $flux Flux used for the task
     *
     * @return $this
     */
    public function setFlux($flux)
    {
        $this->container['flux'] = $flux;

        return $this;
    }

    /**
     * Gets started_at
     *
     * @return \DateTime|null
     */
    public function getStartedAt()
    {
        return $this->container['started_at'];
    }

    /**
     * Sets started_at
     *
     * @param \DateTime|null $started_at The time ([RFC3339Nano date/time format](https://go.dev/src/time/format.go)) the run started executing.
     *
     * @return $this
     */
    public function setStartedAt($started_at)
    {
        $this->container['started_at'] = $started_at;

        return $this;
    }

    /**
     * Gets finished_at
     *
     * @return \DateTime|null
     */
    public function getFinishedAt()
    {
        return $this->container['finished_at'];
    }

    /**
     * Sets finished_at
     *
     * @param \DateTime|null $finished_at The time ([RFC3339Nano date/time format](https://go.dev/src/time/format.go)) the run finished executing.
     *
     * @return $this
     */
    public function setFinishedAt($finished_at)
    {
        $this->container['finished_at'] = $finished_at;

        return $this;
    }

    /**
     * Gets requested_at
     *
     * @return \DateTime|null
     */
    public function getRequestedAt()
    {
        return $this->container['requested_at'];
    }

    /**
     * Sets requested_at
     *
     * @param \DateTime|null $requested_at The time ([RFC3339Nano date/time format](https://docs.influxdata.com/influxdb/v2.3/reference/glossary/#rfc3339nano-timestamp)) the run was manually requested.
     *
     * @return $this
     */
    public function setRequestedAt($requested_at)
    {
        $this->container['requested_at'] = $requested_at;

        return $this;
    }

    /**
     * Gets links
     *
     * @return \InfluxDB2\Model\RunLinks|null
     */
    public function getLinks()
    {
        return $this->container['links'];
    }

    /**
     * Sets links
     *
     * @param \InfluxDB2\Model\RunLinks|null $links links
     *
     * @return $this
     */
    public function setLinks($links)
    {
        $this->container['links'] = $links;

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


