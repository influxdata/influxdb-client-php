<?php


namespace InfluxDB2;

class PointSettings
{
    private $defaultTags;

    public function __construct(array $defaultTags = null)
    {
        $this->defaultTags = is_null($defaultTags) ? [] : $defaultTags;
    }

    public function addDefaultTag(string $key, string $expression)
    {
        $this->defaultTags[$key] = $expression;
    }

    public static function getValue(string $value): string
    {
        if (substr($value, 0, 6) === '${env.') {
            return getenv(substr($value, 6, strlen($value) - 7));
        }

        return $value;
    }

    public function getDefaultTags()
    {
        return $this->defaultTags;
    }
}
