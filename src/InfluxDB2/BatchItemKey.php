<?php

namespace InfluxDB2;

use InfluxDB2\Model\WritePrecision;

/**
 * Key for batch item
 */
class BatchItemKey
{
    public string $bucket;
    public string $org;
    /** @var WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null */
    public ?string $precision;

    /**
     * @param string $bucket
     * @param string $org
     * @param WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null $precision
     * @throws \InvalidArgumentException if $precision is not valid
     */
    public function __construct(string $bucket, string $org, ?string $precision)
    {
        $this->bucket    = $bucket;
        $this->org       = $org;
        $this->precision = $precision;

        if (
            $precision !== null &&
            !in_array($precision, WritePrecision::getAllowableEnumValues(), true)
        ) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid value for $precision: %s. Allowed values are: %s',
                    $precision,
                    implode(', ', WritePrecision::getAllowableEnumValues())
                )
            );
        }
    }
}
