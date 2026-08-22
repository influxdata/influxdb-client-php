<?php

namespace InfluxDB2;

use InfluxDB2\Model\WritePrecision;

/**
 * Write time series data into InfluxDB.
 * @package InfluxDB2
 */
class WriteApi extends DefaultApi implements Writer
{
    public WriteOptions $writeOptions;
    public PointSettings $pointSettings;
    private Worker $worker;
    public bool $closed = false;

    /**
     * WriteApi constructor.
     * @param ClientOptions $options
     * @param array{
     *      writeType?: WriteType::SYNCHRONOUS|WriteType::BATCHING,
     *      batchSize?: int,
     *      retryInterval?: int,
     *      maxRetries?: int,
     *      maxRetryDelay?: int,
     *      maxRetryTime?: int,
     *      exponentialBase?: int,
     *      jitterInterval?: int,
     *  }|null $writeOptions
     * @param array<string, string>|null $pointSettings
     */
    public function __construct(ClientOptions $options, ?array $writeOptions = null, ?array $pointSettings = null)
    {
        parent::__construct($options);
        $this->writeOptions = new WriteOptions($writeOptions ?? []);
        $this->pointSettings = new PointSettings($pointSettings ?? []);

        if ($options->tags !== null) {
            foreach (array_keys($options->tags) as $key) {
                $this->pointSettings->addDefaultTag($key, $options->tags[$key]);
            }
        }
    }

    /**
     * Write data into specified bucket
     *
     * Example write data in array
     *      $writeApi->write([
     *          ['name' => 'cpu','tags' => ['host' => 'server_nl', 'region' => 'us'],
     *              'fields' => ['internal' => 5, 'external' => 6],
     *              'time' => 1422568543702900257],
     *          ['name' => 'gpu', 'fields' => ['value' => 0.9999]]],
     *      WritePrecision::NS,
     *      'my-bucket',
     *      'my-org'
     *      )
     *
     * Example write data in line protocol
     *      $writeApi->write('h2o,location=west value=33i 15')
     *
     * Example write data using Point structure
     *      $point = new Point("h2o).
     *
     *
     * @param string|Point|array $data DataPoints to write into InfluxDB. The data could be represent by
     * array, Point, string
     * @param WritePrecision::S|WritePrecision::MS|WritePrecision::US|WritePrecision::NS|null $precision The precision for the unix timestamps within the body line-protocol @see \InfluxDB2\Model\WritePrecision
     * @param string|null $bucket specifies the destination bucket for writes
     * @param string|null $org specifies the destination organization for writes
     * @throws ApiException
     */
    public function write($data, ?string $precision = null, ?string $bucket = null, ?string $org = null): void
    {
        $precisionParam = $this->getOption("precision", $precision);
        $bucketParam = $this->getOption("bucket", $bucket);
        $orgParam = $this->getOption("org", $org);

        $this->check("precision", $precisionParam);
        $this->check("bucket", $bucketParam);
        $this->check("org", $orgParam);

        $this->addDefaultTags($data);

        $payload = WritePayloadSerializer::generatePayload($data, $precisionParam, $bucketParam, $orgParam, $this->writeOptions->writeType);

        if ($payload === null) {
            return;
        }

        if ($payload instanceof BatchItem) {
            $this->worker()->push($payload);
        } else {
            $this->writeRaw($payload, $precisionParam, $bucketParam, $orgParam);
        }
    }

    /**
     * @param array|Point $data
     * @return void
     */
    private function addDefaultTags(&$data): void
    {
        $defaultTags = $this->pointSettings->getDefaultTags();

        if (is_array($data)) {
            if (array_key_exists('name', $data)) {
                foreach (array_keys($defaultTags) as $key) {
                    $data['tags'][$key] = PointSettings::getValue($defaultTags[$key]);
                }
            } else {
                foreach ($data as &$item) {
                    $this->addDefaultTags($item);
                }
            }
        } elseif ($data instanceof Point) {
            foreach (array_keys($defaultTags) as $key) {
                $data->addTag($key, PointSettings::getValue($defaultTags[$key]));
            }
        }
    }

    /**
     * Writes data using line protocol.
     *
     * @param string $data payload data as string (in line protocol format)
     * @param string|null $precision The precision for the unix timestamps within the body line-protocol
     * @param string|null $bucket specifies the destination bucket for writes
     * @param string|null $org specifies the destination organization for writes
     * @throws ApiException
     *
     * @see \InfluxDB2\Model\WritePrecision
     */
    public function writeRaw(string $data, ?string $precision = null, ?string $bucket = null, ?string $org = null): void
    {
        $precisionParam = $this->getOption("precision", $precision);
        $bucketParam = $this->getOption("bucket", $bucket);
        $orgParam = $this->getOption("org", $org);

        $this->check("precision", $precisionParam);
        $this->check("bucket", $bucketParam);
        $this->check("org", $orgParam);

        $queryParams = ["org" => $orgParam, "bucket" => $bucketParam, "precision" => $precisionParam];

        $retry = new WriteRetry(
            $this->writeOptions->maxRetries,
            $this->writeOptions->retryInterval,
            $this->writeOptions->maxRetryDelay,
            $this->writeOptions->exponentialBase,
            $this->writeOptions->maxRetryTime,
            $this->writeOptions->jitterInterval,
            $this->options
        );

        $retry->retry(function () use ($data, $queryParams) {
            $this->post($data, "/api/v2/write", $queryParams);
        });
    }
    public function close(): void
    {
        $this->closed = true;

        if (isset($this->worker)) {
            $this->worker()->flush();
        }

        unset($this->worker);
    }

    private function worker(): Worker
    {
        if (!isset($this->worker)) {
            $this->worker = new Worker($this);
        }

        return $this->worker;
    }

    /**
     * @param 'bucket'|'precision'|'org' $optionName
     * @param string|null $optionalValue
     * @return string
     */
    private function getOption(string $optionName, ?string $optionalValue = null): string
    {
        switch ($optionName) {
            case 'precision':
                $default = $this->options->precision;
                break;
            case 'bucket':
                $default = $this->options->bucket;
                break;
            case 'org':
                $default = $this->options->org;
                break;
            default:
                throw new \InvalidArgumentException("Invalid option name: $optionName");
        }
        return $optionalValue ?? $default;
    }
}
