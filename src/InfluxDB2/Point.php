<?php

namespace InfluxDB2;

use DateTimeInterface;
use InfluxDB2\Model\WritePrecision;

class Point
{
    public const DEFAULT_WRITE_PRECISION = WritePrecision::NS;

    private string $name;
    /** @var array<string, string|\Stringable|null>|null */
    private ?array $tags;
    /** @var array<string, float|int|string|bool|null>|null */
    private ?array $fields;
    /** @var int|float|DateTimeInterface|null */
    private $time;
    /** @var WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null */
    private ?string $precision;

    /** Create DataPoint instance for specified measurement name.
     *
     * @param string $name the measurement name for the point.
     * @param array<string, string|\Stringable>|null $tags the tag set for the point
     * @param array<string, float|int|string|bool|null>|null $fields the fields for the point
     * @param int|float|DateTimeInterface|null $time the timestamp for the point
     * @param WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null $precision the precision for the unix timestamps within the body line-protocol
     */
    public function __construct(
        string $name,
        ?array $tags = null,
        ?array $fields = null,
        $time = null,
        ?string $precision = Point::DEFAULT_WRITE_PRECISION
    ) {
        $this->name = $name;
        $this->tags = $tags;
        $this->fields = $fields;
        $this->time = $time;
        $this->precision = $precision;
    }

    /**
     * @return WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null
     */
    public function getPrecision(): ?string
    {
        return $this->precision;
    }

    public static function measurement(string $name): Point
    {
        return new Point($name);
    }

    /** Create DataPoint instance from specified data.
     *
     * @param array{
     *     name: string,
     *     tags?: array<string, string|\Stringable>,
     *     fields?: array<string, float|int|string|bool|null>,
     *     time?: int|float|DateTimeInterface|null,
     *     precision?: WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null,
     * } $data
     * @return Point
     */
    public static function fromArray(array $data): ?Point
    {
        if (!array_key_exists('name', $data)) {
            return null;
        }

        $tags = array_key_exists('tags', $data) ? $data['tags'] : null;
        $fields = array_key_exists('fields', $data) ? $data['fields'] : null;
        $time = array_key_exists('time', $data) ? $data['time'] : null;
        $precision = array_key_exists('precision', $data) ? $data['precision'] : null;

        return new Point($data['name'], $tags, $fields, $time, $precision);
    }

    /** Adds or replaces a tag value for a point.
     *
     * @param string $key the tag name
     * @param string|\Stringable|null $value the tag value, can be "object" with "__toString" function or "object" implements Stringable interface
     * @return Point
     */
    public function addTag(string $key, $value): Point
    {
        $this->tags[$key] = $value;

        return $this;
    }

    /** Adds or replaces a field value for a point.
     *
     * @param string $key the field name
     * @param float|int|string|bool|null $value the field value
     * @return Point
     */
    public function addField(string $key, $value): Point
    {
        $this->fields[$key] = $value;

        return $this;
    }

    /** Updates the timestamp for the point.
     *
     * @param int|float|DateTimeInterface $time the timestamp
     * @param WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null $precision the timestamp precision
     * @return Point
     */
    public function time($time, $precision = null): Point
    {
        $this->time = $time;
        $this->precision = $precision;

        return $this;
    }

    /** If there is no field then return null.
     *
     * @return string representation of the point
     */
    public function toLineProtocol(): ?string
    {
        $measurement = $this->escapeKey($this->name, false);

        $lineProtocol = $measurement;

        $tags = $this->appendTags();

        if (!$this->isNullOrEmptyString($tags)) {
            $lineProtocol .= $tags;
        } else {
            $lineProtocol .= ' ';
        }

        $fields = $this->appendFields();

        if ($this->isNullOrEmptyString($fields)) {
            return null;
        }

        $lineProtocol .= $fields;

        $time = $this->appendTime();

        if (!$this->isNullOrEmptyString($time)) {
            $lineProtocol .= $time;
        }

        return $lineProtocol;
    }

    private function appendTags(): ?string
    {
        $tags = '';

        if ($this->tags === null) {
            return null;
        }

        ksort($this->tags);

        foreach (array_keys($this->tags) as $key) {
            $value = $this->tags[$key];

            if (!is_string($value) && null !== $value) {
                if (
                    is_scalar($value)  ||
                    (is_object($value) && method_exists($value, '__toString')) ||
                    (\PHP_VERSION_ID >= 80000 && $value instanceof \Stringable)
                ) {
                    $value = (string) $value;
                } else {
                    trigger_error(sprintf('Tag value for key %s cannot be converted to string', $key), E_USER_WARNING);
                }
            }

            if ($this->isNullOrEmptyString($key) || $this->isNullOrEmptyString($value)) {
                continue;
            }

            $tags .= ',' . $this->escapeKey($key) . '=' . $this->escapeKey($value);
        }

        $tags .= ' ';
        return $tags;
    }

    private function appendFields(): ?string
    {
        $fields = '';

        if ($this->fields === null) {
            return null;
        }

        ksort($this->fields);

        foreach (array_keys($this->fields) as $key) {
            $value = $this->fields[$key];

            if (!isset($value)) {
                continue;
            }

            $fields .= $this->escapeKey($key) . '=';

            if (is_integer($value)) {
                $fields .= $value . 'i';
            } elseif (is_string($value)) {
                $fields .= '"' . $this->escapeValue($value) . '"';
            } elseif (is_bool($value)) {
                $fields .= $value ? 'true' : 'false';
            } else {
                $fields .= $value;
            }

            $fields .= ',';
        }

        return rtrim($fields, ',');
    }

    private function appendTime(): ?string
    {
        if (!isset($this->time)) {
            return null;
        }

        $time = $this->time;

        if (is_float($time)) {
            $time = round($time);
        } elseif ($time instanceof DateTimeInterface) {
            $seconds = $time->getTimestamp();

            switch ($this->precision) {
                case WritePrecision::MS:
                    $time = strval(round($seconds) . '000');
                    break;
                case WritePrecision::S:
                    $time = strval($seconds);
                    break;
                case WritePrecision::US:
                    $time = strval(round($seconds) . '000000');
                    break;
                default:
                    $time = strval(round($seconds) . '000000000');
                    break;
            }
        }

        return ' ' . $time;
    }

    private function escapeKey(string $key, bool $escapeEqual = true): string
    {
        $escapeKeys = array(' ' => '\\ ', ',' => '\\,', "\\" => '\\\\',
            "\n" => '\\n', "\r" => '\\r', "\t" => '\\t');

        if ($escapeEqual) {
            $escapeKeys['='] = '\\=';
        }

        return strtr($key, $escapeKeys);
    }

    private function escapeValue(string $value): string
    {
        $escapeValues = array('"' => '\\"', "\\" => '\\\\');
        return strtr($value, $escapeValues);
    }

    /**
     * @param string|\Stringable|null $str
     */
    private function isNullOrEmptyString($str): bool
    {
        return !is_string($str) || trim($str) === '';
    }
}
