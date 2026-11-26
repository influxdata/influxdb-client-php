<?php

namespace InfluxDB2Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use InfluxDB2\DefaultApi;
use InfluxDB2\ObjectSerializer;
use InfluxDB2\Service\BackupService;
use InfluxDB2\TemporaryFile;
use PHPUnit\Framework\TestCase;

class TemporaryFileTest extends TestCase
{
    public function testDeserializedFileIsDeleted(): void
    {
        $file = ObjectSerializer::deserialize(Utils::streamFor('file content'), '\SplFileObject', []);

        self::assertInstanceOf(TemporaryFile::class, $file);
        $path = $file->getRealPath();
        self::assertIsString($path);
        self::assertFileExists($path);
        self::assertSame('file content', $file->fread(100));

        $file = null;

        self::assertFalse(file_exists($path));
    }

    public function testCopyOfFileIsKept(): void
    {
        $file = ObjectSerializer::deserialize(Utils::streamFor('file content'), '\SplFileObject', []);
        self::assertInstanceOf(TemporaryFile::class, $file);
        $path = (string) $file->getRealPath();
        $copy = $path . '-copy';
        self::assertTrue(copy($path, $copy));

        $file = null;

        self::assertFalse(file_exists($path));
        self::assertSame('file content', file_get_contents($copy));
        unlink($copy);
    }

    public function testDownloadedBackupIsDeleted(): void
    {
        $defaultApi = new DefaultApi(['url' => 'http://localhost:8086', 'token' => 'my-token']);
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Type' => 'application/octet-stream'], 'backup content'),
        ]);
        $defaultApi->http = $defaultApi->configuredClient(new \GuzzleHttp\Client(['handler' => HandlerStack::create($mockHandler)]));

        $backup = (new BackupService($defaultApi))->getBackupKV();

        self::assertInstanceOf(\SplFileObject::class, $backup);
        $path = $backup->getRealPath();
        self::assertIsString($path);
        self::assertSame('backup content', $backup->fread(100));

        unset($backup);

        self::assertFalse(file_exists($path));
    }
}
