<?php
/**
 * Replication
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
 * Replication Class Doc Comment
 *
 * @category Class
 * @package  InfluxDB2
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Replication implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Replication';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
        'org_id' => 'string',
        'remote_id' => 'string',
        'local_bucket_id' => 'string',
        'remote_bucket_id' => 'string',
        'remote_bucket_name' => 'string',
        'max_queue_size_bytes' => 'int',
        'current_queue_size_bytes' => 'int',
        'latest_response_code' => 'int',
        'latest_error_message' => 'string',
        'drop_non_retryable_data' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'id' => null,
        'name' => null,
        'description' => null,
        'org_id' => null,
        'remote_id' => null,
        'local_bucket_id' => null,
        'remote_bucket_id' => null,
        'remote_bucket_name' => null,
        'max_queue_size_bytes' => 'int64',
        'current_queue_size_bytes' => 'int64',
        'latest_response_code' => 'int32',
        'latest_error_message' => null,
        'drop_non_retryable_data' => null
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
        'name' => 'name',
        'description' => 'description',
        'org_id' => 'orgID',
        'remote_id' => 'remoteID',
        'local_bucket_id' => 'localBucketID',
        'remote_bucket_id' => 'remoteBucketID',
        'remote_bucket_name' => 'remoteBucketName',
        'max_queue_size_bytes' => 'maxQueueSizeBytes',
        'current_queue_size_bytes' => 'currentQueueSizeBytes',
        'latest_response_code' => 'latestResponseCode',
        'latest_error_message' => 'latestErrorMessage',
        'drop_non_retryable_data' => 'dropNonRetryableData'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'description' => 'setDescription',
        'org_id' => 'setOrgId',
        'remote_id' => 'setRemoteId',
        'local_bucket_id' => 'setLocalBucketId',
        'remote_bucket_id' => 'setRemoteBucketId',
        'remote_bucket_name' => 'setRemoteBucketName',
        'max_queue_size_bytes' => 'setMaxQueueSizeBytes',
        'current_queue_size_bytes' => 'setCurrentQueueSizeBytes',
        'latest_response_code' => 'setLatestResponseCode',
        'latest_error_message' => 'setLatestErrorMessage',
        'drop_non_retryable_data' => 'setDropNonRetryableData'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'description' => 'getDescription',
        'org_id' => 'getOrgId',
        'remote_id' => 'getRemoteId',
        'local_bucket_id' => 'getLocalBucketId',
        'remote_bucket_id' => 'getRemoteBucketId',
        'remote_bucket_name' => 'getRemoteBucketName',
        'max_queue_size_bytes' => 'getMaxQueueSizeBytes',
        'current_queue_size_bytes' => 'getCurrentQueueSizeBytes',
        'latest_response_code' => 'getLatestResponseCode',
        'latest_error_message' => 'getLatestErrorMessage',
        'drop_non_retryable_data' => 'getDropNonRetryableData'
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
    public function __construct(array $data = null)
    {
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['org_id'] = isset($data['org_id']) ? $data['org_id'] : null;
        $this->container['remote_id'] = isset($data['remote_id']) ? $data['remote_id'] : null;
        $this->container['local_bucket_id'] = isset($data['local_bucket_id']) ? $data['local_bucket_id'] : null;
        $this->container['remote_bucket_id'] = isset($data['remote_bucket_id']) ? $data['remote_bucket_id'] : null;
        $this->container['remote_bucket_name'] = isset($data['remote_bucket_name']) ? $data['remote_bucket_name'] : null;
        $this->container['max_queue_size_bytes'] = isset($data['max_queue_size_bytes']) ? $data['max_queue_size_bytes'] : null;
        $this->container['current_queue_size_bytes'] = isset($data['current_queue_size_bytes']) ? $data['current_queue_size_bytes'] : null;
        $this->container['latest_response_code'] = isset($data['latest_response_code']) ? $data['latest_response_code'] : null;
        $this->container['latest_error_message'] = isset($data['latest_error_message']) ? $data['latest_error_message'] : null;
        $this->container['drop_non_retryable_data'] = isset($data['drop_non_retryable_data']) ? $data['drop_non_retryable_data'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['org_id'] === null) {
            $invalidProperties[] = "'org_id' can't be null";
        }
        if ($this->container['remote_id'] === null) {
            $invalidProperties[] = "'remote_id' can't be null";
        }
        if ($this->container['local_bucket_id'] === null) {
            $invalidProperties[] = "'local_bucket_id' can't be null";
        }
        if ($this->container['max_queue_size_bytes'] === null) {
            $invalidProperties[] = "'max_queue_size_bytes' can't be null";
        }
        if ($this->container['current_queue_size_bytes'] === null) {
            $invalidProperties[] = "'current_queue_size_bytes' can't be null";
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
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets org_id
     *
     * @return string
     */
    public function getOrgId()
    {
        return $this->container['org_id'];
    }

    /**
     * Sets org_id
     *
     * @param string $org_id org_id
     *
     * @return $this
     */
    public function setOrgId($org_id)
    {
        $this->container['org_id'] = $org_id;

        return $this;
    }

    /**
     * Gets remote_id
     *
     * @return string
     */
    public function getRemoteId()
    {
        return $this->container['remote_id'];
    }

    /**
     * Sets remote_id
     *
     * @param string $remote_id remote_id
     *
     * @return $this
     */
    public function setRemoteId($remote_id)
    {
        $this->container['remote_id'] = $remote_id;

        return $this;
    }

    /**
     * Gets local_bucket_id
     *
     * @return string
     */
    public function getLocalBucketId()
    {
        return $this->container['local_bucket_id'];
    }

    /**
     * Sets local_bucket_id
     *
     * @param string $local_bucket_id local_bucket_id
     *
     * @return $this
     */
    public function setLocalBucketId($local_bucket_id)
    {
        $this->container['local_bucket_id'] = $local_bucket_id;

        return $this;
    }

    /**
     * Gets remote_bucket_id
     *
     * @return string|null
     */
    public function getRemoteBucketId()
    {
        return $this->container['remote_bucket_id'];
    }

    /**
     * Sets remote_bucket_id
     *
     * @param string|null $remote_bucket_id remote_bucket_id
     *
     * @return $this
     */
    public function setRemoteBucketId($remote_bucket_id)
    {
        $this->container['remote_bucket_id'] = $remote_bucket_id;

        return $this;
    }

    /**
     * Gets remote_bucket_name
     *
     * @return string|null
     */
    public function getRemoteBucketName()
    {
        return $this->container['remote_bucket_name'];
    }

    /**
     * Sets remote_bucket_name
     *
     * @param string|null $remote_bucket_name remote_bucket_name
     *
     * @return $this
     */
    public function setRemoteBucketName($remote_bucket_name)
    {
        $this->container['remote_bucket_name'] = $remote_bucket_name;

        return $this;
    }

    /**
     * Gets max_queue_size_bytes
     *
     * @return int
     */
    public function getMaxQueueSizeBytes()
    {
        return $this->container['max_queue_size_bytes'];
    }

    /**
     * Sets max_queue_size_bytes
     *
     * @param int $max_queue_size_bytes max_queue_size_bytes
     *
     * @return $this
     */
    public function setMaxQueueSizeBytes($max_queue_size_bytes)
    {
        $this->container['max_queue_size_bytes'] = $max_queue_size_bytes;

        return $this;
    }

    /**
     * Gets current_queue_size_bytes
     *
     * @return int
     */
    public function getCurrentQueueSizeBytes()
    {
        return $this->container['current_queue_size_bytes'];
    }

    /**
     * Sets current_queue_size_bytes
     *
     * @param int $current_queue_size_bytes current_queue_size_bytes
     *
     * @return $this
     */
    public function setCurrentQueueSizeBytes($current_queue_size_bytes)
    {
        $this->container['current_queue_size_bytes'] = $current_queue_size_bytes;

        return $this;
    }

    /**
     * Gets latest_response_code
     *
     * @return int|null
     */
    public function getLatestResponseCode()
    {
        return $this->container['latest_response_code'];
    }

    /**
     * Sets latest_response_code
     *
     * @param int|null $latest_response_code latest_response_code
     *
     * @return $this
     */
    public function setLatestResponseCode($latest_response_code)
    {
        $this->container['latest_response_code'] = $latest_response_code;

        return $this;
    }

    /**
     * Gets latest_error_message
     *
     * @return string|null
     */
    public function getLatestErrorMessage()
    {
        return $this->container['latest_error_message'];
    }

    /**
     * Sets latest_error_message
     *
     * @param string|null $latest_error_message latest_error_message
     *
     * @return $this
     */
    public function setLatestErrorMessage($latest_error_message)
    {
        $this->container['latest_error_message'] = $latest_error_message;

        return $this;
    }

    /**
     * Gets drop_non_retryable_data
     *
     * @return bool|null
     */
    public function getDropNonRetryableData()
    {
        return $this->container['drop_non_retryable_data'];
    }

    /**
     * Sets drop_non_retryable_data
     *
     * @param bool|null $drop_non_retryable_data drop_non_retryable_data
     *
     * @return $this
     */
    public function setDropNonRetryableData($drop_non_retryable_data)
    {
        $this->container['drop_non_retryable_data'] = $drop_non_retryable_data;

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


