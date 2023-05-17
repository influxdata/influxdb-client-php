<?php

namespace InfluxDB2;

/**
 * Class FluxCsvParser us used to construct FluxResult from CSV.
 * @package InfluxDB2
 */
class FluxCsvParser
{
    private const ANNOTATION_DATATYPE = '#datatype';
    private const ANNOTATION_GROUP = '#group';
    private const ANNOTATION_DEFAULT = '#default';
    private const ANNOTATIONS = [self::ANNOTATION_DATATYPE, self::ANNOTATION_GROUP, self::ANNOTATION_DEFAULT];

    /* @var  $variable FluxTable[] */
    public $tables;

    private $response;
    private $stream;
    private $responseMode;
    private $resource;

    /* @var  $variable int */
    private $tableIndex = 0;
    private $tableId;

    private $startNewTable;

    /** @var FluxTable */
    private $table;
    private $groups = [];

    private $parsingStateError;

    public $closed;

    /** @var FluxColumn[] */
    private $fluxColumns;

    /**
     * FluxCsvParser constructor.
     * @param $response mixed response to by parsed
     * @param $stream bool use streaming
     * @param $responseMode string metadata expected in response ('full', 'only_names')
     */
    public function __construct($response, bool $stream = false, string $responseMode = "full")
    {
        $this->response = is_string($response) ? null : $response;
        $this->resource = is_string($response) ? $this->stringToStream($response) : $response->detach();
        $this->stream = $stream;
        $this->responseMode = $responseMode;
        $this->tableIndex = 0;
        if (!$stream) {
            $this->tables = [];
        }

        $this->closed = false;
    }

    private function stringToStream(string $string)
    {
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $string);
        rewind($stream);
        return $stream;
    }

    public function parse()
    {
        iterator_to_array($this->each());

        return $this;
    }

    public function each()
    {
        try {
            while (($csv = fgetcsv($this->resource)) !== false) {
                if (!isset($csv) || (count($csv) == 1 && $csv[0] == null)) {
                    continue;
                }

                //skip empty csv row
                if ($csv[1] == 'error' && $csv[2] == 'reference') {
                    $this->parsingStateError = true;
                    continue;
                }

                # Throw  InfluxException with error response
                if ($this->parsingStateError) {
                    $error = $csv[1];
                    $referenceValue = $csv[2];
                    throw new FluxQueryError(
                        $error,
                        !isset($referenceValue) || trim($referenceValue) === '' ? 0 : $referenceValue
                    );
                }

                $result = $this->parseLine($csv);

                if ($result instanceof FluxRecord) {
                    yield $result;
                }
            }
        } finally {
            $this->closeConnection();
        }
    }

    private function parseLine(array $csv)
    {
        $token = $csv[0];
        # start new table
        if ((in_array($token, self::ANNOTATIONS) && !$this->startNewTable)
            || ($this->responseMode == "only_names" && is_null($this->table))) {
            # Return already parsed DataFrame
            $this->startNewTable = true;
            $this->table = new FluxTable();
            $this->groups = [];

            if (!$this->stream) {
                $this->tables[$this->tableIndex] = $this->table;
            }

            $this->tableIndex += 1;
            $this->tableId = -1;
        } elseif ($this->table == null) {
            throw new FluxCsvParserException('Unable to parse CSV response. FluxTable definition was not found.');
        }

        if (self::ANNOTATION_DATATYPE == $token) {
            $this->addDataTypes($this->table, $csv);
        } elseif (self::ANNOTATION_GROUP == $token) {
            $this->groups = $csv;
        } elseif (self::ANNOTATION_DEFAULT == $token) {
            $this->addDefaultEmptyValues($this->table, $csv);
        } else {
            return $this->parseValues($csv);
        }
        return null;
    }

    private function parseRecord(int $tableIndex, FluxTable $table, array $csv)
    {
        $record = new FluxRecord($tableIndex);
        foreach ($table->columns as $fluxColumn) {
            $columnName = $fluxColumn->label;
            $strVal = $csv[$fluxColumn->index + 1];
            $value = $this->toValue($strVal, $fluxColumn);
            $record->values[$columnName] = $value;
            $record->row[] = $value;
        }
        return $record;
    }

    private function addDataTypes(FluxTable $table, array $data_types)
    {
        for ($i = 1; $i < sizeof($data_types); ++$i) {
            $columnDef = new FluxColumn();
            $columnDef->index = $i - 1;
            $columnDef->dataType = $data_types[$i];
            array_push($table->columns, $columnDef);
        }
    }

    private function addGroups(FluxTable $table, $csv)
    {
        $i = 1;
        foreach ($table->columns as &$column) {
            $column->group = $csv[$i] == 'true';
            $i++;
        }
    }

    private function addDefaultEmptyValues(FluxTable $table, $defaultValues)
    {
        $i = 1;
        foreach ($table->columns as &$column) {
            $column->defaultValue = $defaultValues[$i];
            $i++;
        }
    }

    private function addColumnNamesAndTags(FluxTable $table, array $csv)
    {
        $i = 1;

        foreach ($table->columns as $column) {
            $column->label = $csv[$i];
            $i++;
        }

        $duplicates = array();
        foreach (array_count_values($csv) as $label => $count) {
            if ($count > 1) {
                $duplicates[] = $label;
            }
        }

        if (count($duplicates) > 0) {
            $duplicatesStr = implode(", ", $duplicates);
            print "The response contains columns with duplicated names: {$duplicatesStr}\n";
            print "You should use the 'FluxRecord.row' to access your data instead of 'FluxRecord.values'.";
        }
    }


    private function parseValues(array $csv)
    {
        # parse column names
        if ($this->startNewTable) {
            if ($this->responseMode == 'only_names' && empty($this->table->columns)) {
                $this->addDataTypes($this->table, array_fill(0, sizeof($csv), 'string'));
                $this->groups = array_fill(0, sizeof($csv), 'false');
            }
            $this->addGroups($this->table, $this->groups);
            $this->addColumnNamesAndTags($this->table, $csv);
            $this->startNewTable = false;
            return null;
        }

        $currentId = (int)$csv[2];
        if ($this->tableId == -1) {
            $this->tableId = $currentId;
        }

        if ($this->tableId != $currentId) {
            # create new table with previous column headers settings
            $this->fluxColumns = $this->table->columns;
            $this->table = new FluxTable();

            foreach ($this->fluxColumns as &$column) {
                array_push($this->table->columns, $column);
            }

            if (!$this->stream) {
                $this->tables[$this->tableIndex] = $this->table;
            }

            $this->tableIndex += 1;
            $this->tableId = $currentId;
        }

        $fluxRecord = $this->parseRecord($this->tableIndex - 1, $this->table, $csv);

        if ($this->stream) {
            return $fluxRecord;
        } else {
            $fluxTable = $this->tables[$this->tableIndex - 1];
            array_push($fluxTable->records, $fluxRecord);
        }

        return null;
    }

    private function toValue($strVal, FluxColumn $column)
    {
        if ($strVal == null || $strVal == '') {
            $defaultValue = $column->defaultValue;
            if (empty($defaultValue)) {
                return null;
            }
            return $this->toValue($defaultValue, $column);
        }

        if ('string' == $column->dataType) {
            return $strVal;
        }

        if ('boolean' == $column->dataType) {
            return "true" == $strVal;
        }

        if ('unsignedLong' == $column->dataType || 'long' == $column->dataType) {
            return intval($strVal);
        }

        if ('double' == $column->dataType) {
            if ($strVal == '+Inf') {
                return INF;
            }
            if ($strVal == '-Inf') {
                return -INF;
            }
            return (double)$strVal;
        }

        if ('base64Binary' == $column->dataType) {
            return base64_decode($strVal);
        }

        if ('dateTime:RFC3339' == $column->dataType || 'dateTime:RFC3339Nano' == $column->dataType) {
            ##todo nanoseconds precission, php datetime is only in microseconds precision
            return $strVal;
        }

        return $strVal;
    }

    private function closeConnection()
    {
        # Close CSV Parser
        $this->closed = true;
        if (isset($this->response)) {
            $this->response->close();
        }
        if (is_resource($this->resource)) {
            fclose($this->resource);
        }

        unset($this->response);
        unset($this->resource);
    }
}
