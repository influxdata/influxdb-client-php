<?php

namespace InfluxDB2;

/**
 * Class FluxColumn represents a column header specification of FluxTable.
 * @package InfluxDB2
 */
class FluxColumn
{
    public ?int $index;
    public ?string $label;
    public ?string $dataType;
    public ?bool $group;
    public ?string $defaultValue;

    /**
     * FluxColumn constructor.
     * @param ?int $index column number
     * @param ?string $label column label
     * @param ?string $dataType data type
     * @param ?bool $group is group column
     * @param ?string $defaultValue default empty value
     */
    public function __construct(
        ?int $index = null,
        ?string $label = null,
        ?string $dataType = null,
        ?bool $group = null,
        ?string $defaultValue = null
    ) {
        $this->index = $index;
        $this->label = $label;
        $this->dataType = $dataType;
        $this->group = $group;
        $this->defaultValue = $defaultValue;
    }
}
