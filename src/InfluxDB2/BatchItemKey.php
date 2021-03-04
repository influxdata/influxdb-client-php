<?php

namespace InfluxDB2;

use InfluxDB2\Model\WritePrecision;

/**
 * Key for batch item
 */
class BatchItemKey
{
    /** @var string */
    public $bucket;
    /** @var string */
    public $org;
    /** @var WritePrecision */
    public $precision;

    public function __construct($bucket, $org, $precision)
    {
        $this->bucket    = $bucket;
        $this->org       = $org;
        $this->precision = $precision;
    }
}
