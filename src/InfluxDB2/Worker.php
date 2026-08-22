<?php

namespace InfluxDB2;

use Exception;
use SplQueue;

class Worker
{
    private WriteApi $client;
    /** @var SplQueue<BatchItem> */
    private SplQueue $queue;
    private WriteOptions $writeOptions;

    public function __construct(WriteApi $client)
    {
        $this->client = $client;
        $this->writeOptions = $client->writeOptions;

        $this->queue = new SplQueue();
    }

    public function push(BatchItem $payload): void
    {
        $this->queue->enqueue($payload);

        if ($this->queue->count() >= $this->writeOptions->batchSize) {
            $this->checkBackgroundQueue(true);
        }
    }

    public function flush(): void
    {
        while ($this->queue->count() !== 0) {
            $this->checkBackgroundQueue(false);
        }
    }

    private function checkBackgroundQueue(bool $size): void
    {
        $data = array();
        $points = 0;

        if ($size && $this->queue->count() < $this->writeOptions->batchSize) {
            return;
        }

        while (($points < $this->writeOptions->batchSize) && $this->queue->count() !== 0) {
            try {
                $item = $this->queue->dequeue();

                $key = $item->key;
                $index = $this->existsKey($key, $data);

                if ($index === null) {
                    $data[] = array('key' => $key, 'data' => array());
                    $index = array_keys($data)[count($data) - 1];
                }

                $data[$index]['data'][] = $item->data;
                $points += 1;
            } catch (Exception $e) {
                return;
            }
        }

        if (!empty($data)) {
            $this->write($data);
        }
    }

    /**
     * @param BatchItemKey $key
     * @param array<int, array{key: BatchItemKey, data: list<string>}> $data
     * @return int|null
     */
    private function existsKey(BatchItemKey $key, array $data): ?int
    {
        foreach ($data as $item) {
            $itemKey = $item['key'];
            if ($key->precision === $itemKey->precision &&
                $key->bucket === $itemKey->bucket &&
                $key->org === $itemKey->org) {
                $found = array_search($item, $data, true);
                if ($found !== false) {
                    return $found;
                }
            }
        }

        return null;
    }

    /**
     * @param array<int, array{key: BatchItemKey, data: list<string>}> $data
     */
    private function write(array $data): void
    {
        foreach ($data as $item) {
            $key = $item['key'];
            $payload = $item['data'];

            $this->client->writeRaw(join("\n", $payload), $key->precision, $key->bucket, $key->org);
        }
    }
}
