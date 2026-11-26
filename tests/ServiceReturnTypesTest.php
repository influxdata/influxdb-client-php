<?php

namespace InfluxDB2Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use InfluxDB2\DefaultApi;
use InfluxDB2\Model\Buckets;
use InfluxDB2\Service\BucketsService;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * PHPDoc of generated services documents the type which is really returned.
 */
class ServiceReturnTypesTest extends TestCase
{
    /**
     * @return array<string, array{ReflectionMethod, ReflectionMethod}>
     */
    public function operationProvider(): array
    {
        $result = [];
        $files = glob(__DIR__ . '/../src/InfluxDB2/Service/*.php');
        foreach ($files === false ? [] : $files as $file) {
            /** @var class-string $class */
            $class = 'InfluxDB2\\Service\\' . basename($file, '.php');
            $reflection = new ReflectionClass($class);
            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                $withHttpInfo = $method->getName() . 'WithHttpInfo';
                if ($method->getDeclaringClass()->getName() === $class && $reflection->hasMethod($withHttpInfo)) {
                    $result[$reflection->getShortName() . '::' . $method->getName()] = [$method, $reflection->getMethod($withHttpInfo)];
                }
            }
        }
        return $result;
    }

    public function testAllOperationsAreTested(): void
    {
        self::assertGreaterThan(250, count($this->operationProvider()));
    }

    /**
     * @dataProvider operationProvider
     */
    public function testReturnType(ReflectionMethod $operation, ReflectionMethod $withHttpInfo): void
    {
        $returnType = self::returnType($withHttpInfo);
        $phpDocType = [
            'object[]' => 'array<mixed>[]',
            'map[string,object]' => 'array<string, array<mixed>>',
        ][$returnType] ?? $returnType;

        self::assertSame($phpDocType ?? 'void', self::phpDocReturn($operation));
        self::assertSame(
            'array{0: ' . ($phpDocType ?? 'null') . ', 1: int, 2: array<string, string[]>}',
            explode('} ', self::phpDocReturn($withHttpInfo), 2)[0] . '}'
        );
    }

    public function testReturnedValueHasDocumentedType(): void
    {
        $defaultApi = new DefaultApi(['url' => 'http://localhost:8086', 'token' => 'my-token']);
        $mockHandler = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], '{"buckets":[]}'),
            new Response(200, ['Content-Type' => 'application/json', 'X-Custom' => 'value'], '{"buckets":[]}'),
        ]);
        $defaultApi->http = $defaultApi->configuredClient(new \GuzzleHttp\Client(['handler' => HandlerStack::create($mockHandler)]));
        $service = new BucketsService($defaultApi);

        self::assertInstanceOf(Buckets::class, $service->getBuckets());

        list($buckets, $statusCode, $headers) = $service->getBucketsWithHttpInfo();
        self::assertInstanceOf(Buckets::class, $buckets);
        self::assertSame(200, $statusCode);
        self::assertSame(['value'], $headers['X-Custom']);
    }

    private static function returnType(ReflectionMethod $method): ?string
    {
        $lines = file((string) $method->getFileName());
        $start = (int) $method->getStartLine();
        $source = implode('', array_slice($lines === false ? [] : $lines, $start - 1, (int) $method->getEndLine() - $start + 1));
        return preg_match("/\\\$returnType = '([^']+)';/", $source, $matches) === 1 ? $matches[1] : null;
    }

    private static function phpDocReturn(ReflectionMethod $method): string
    {
        self::assertSame(1, preg_match('/@return (.+)$/m', (string) $method->getDocComment(), $matches));
        return trim($matches[1]);
    }
}
