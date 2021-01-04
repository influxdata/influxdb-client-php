<?php

namespace InfluxDB2;

use Exception;
use SplQueue;

class Worker
{
    /** @var WriteApi */
    private $client;

    private $queue;
    private $writeOptions;

    public function __construct($client)
    {
        $this->client = $client;
        $this->writeOptions = $client->writeOptions;

        $this->queue = new SplQueue();
    }

    public function push($payload)
    {
        $this->queue->enqueue($payload);

        if ($this->queue->count() >= $this->writeOptions->batchSize) {
            $this->checkBackgroundQueue(true);
        }
    }

    public function flush()
    {
        while ($this->queue->count() != 0) {
            $this->checkBackgroundQueue(false);
        }
    }

    private function checkBackgroundQueue(bool $size)
    {
        $data = array();
        $points = 0;

        if ($size && $this->queue->count() < $this->writeOptions->batchSize) {
            return;
        }

        while (($points < $this->writeOptions->batchSize) && $this->queue->count() != 0) {
            try {
                $item = $this->queue->dequeue();

                $key = $item->key;
                $index = $this->existsKey($key, $data);

                if ($index === null) {
                    $data[] = array('key' => $key, 'data' => array());
                    $index = array_keys($data)[count($data)-1];
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

    private function existsKey($key, $data): ?int
    {
        foreach ($data as $item) {
            $itemKey = $item['key'];
            if ($key->precision === $itemKey->precision &&
                $key->bucket === $itemKey->bucket &&
                $key->org === $itemKey->org) {
                return array_search($item, $data);
            }
        }

        return null;
    }

    private function write($data)
    {
        foreach ($data as $item) {
            $key = $item['key'];
            $payload = $item['data'];

            $this->client->writeRaw(join("\n", $payload), $key->precision, $key->bucket, $key->org);
        }
    }
}
