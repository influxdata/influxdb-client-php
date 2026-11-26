<?php

namespace InfluxDB2Test;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

/**
 * PHPDoc of generated models and services (excluded from PHPStan analysis) contains valid types.
 */
class GeneratedPhpDocTest extends TestCase
{
    private const BUILTIN_TYPES = [
        'array', 'bool', 'boolean', 'callable', 'false', 'float', 'double', 'int', 'integer', 'iterable', 'mixed',
        'null', 'number', 'object', 'resource', 'self', 'static', 'string', 'true', 'void', '$this',
    ];

    /**
     * @return array<string, array{class-string}>
     */
    public function classProvider(): array
    {
        $result = [];
        foreach (['Model', 'Service'] as $namespace) {
            $files = glob(__DIR__ . "/../src/InfluxDB2/{$namespace}/*.php");
            foreach ($files === false ? [] : $files as $file) {
                /** @var class-string $class */
                $class = "InfluxDB2\\{$namespace}\\" . basename($file, '.php');
                $result[$class] = [$class];
            }
        }
        foreach (['ApiException', 'Configuration', 'HeaderSelector', 'ObjectSerializer'] as $name) {
            $result["InfluxDB2\\{$name}"] = ["InfluxDB2\\{$name}"];
        }
        return $result;
    }

    /**
     * @dataProvider classProvider
     * @param class-string $class
     */
    public function testPhpDoc(string $class): void
    {
        $reflection = new ReflectionClass($class);
        self::assertNotFalse($reflection->getFileName());
        $uses = self::useStatements($reflection);

        foreach ($reflection->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() !== $class) {
                continue;
            }
            $where = $class . '::' . $method->getName() . '()';
            $parameters = array_map(function (\ReflectionParameter $parameter) {
                return $parameter->getName();
            }, $method->getParameters());

            preg_match_all('/@param\s+(\S+)\s+\$(\w+)/', (string) $method->getDocComment(), $matches, PREG_SET_ORDER);
            foreach ($matches as $param) {
                self::assertContains($param[2], $parameters, "{$where} documents unknown parameter \${$param[2]}");
                $this->assertValidType($param[1], $reflection, $uses, "{$where} \${$param[2]}");
            }
            if (preg_match('/@return\s+(\S+)/', (string) $method->getDocComment(), $match) === 1) {
                $this->assertValidType($match[1], $reflection, $uses, "{$where} @return");
            }
        }

        foreach ($reflection->getProperties() as $property) {
            if ($property->getDeclaringClass()->getName() !== $class) {
                continue;
            }
            if (preg_match('/@var\s+(\S+)/', (string) $property->getDocComment(), $match) === 1) {
                $this->assertValidType($match[1], $reflection, $uses, "{$class}::\${$property->getName()}");
            }
        }
    }

    public function testEnumValuesAreDocumentedAsConstants(): void
    {
        $method = new ReflectionMethod(\InfluxDB2\Model\Task::class, 'setStatus');

        self::assertStringContainsString(
            '@param \InfluxDB2\Model\TaskStatusType::ACTIVE|\InfluxDB2\Model\TaskStatusType::INACTIVE|null $status',
            (string) $method->getDocComment()
        );
    }

    /**
     * @param ReflectionClass<object> $context
     * @param array<string, string> $uses
     */
    private function assertValidType(string $type, ReflectionClass $context, array $uses, string $where): void
    {
        foreach (self::splitUnion($type) as $part) {
            while (substr($part, -2) === '[]') {
                $part = substr($part, 0, -2);
            }
            if ($part !== '' && $part[0] === '(' && substr($part, -1) === ')') {
                $this->assertValidType(substr($part, 1, -1), $context, $uses, $where);
                continue;
            }
            if (preg_match('/^([\w\\\\]+)[<{]/', $part, $match) === 1) {
                // generic or shape, e.g. array<string, string> or array{0: int}
                self::assertContains($match[1], ['array', 'list', 'iterable'], "{$where}: {$type}");
                continue;
            }
            if (in_array(strtolower($part), self::BUILTIN_TYPES, true)) {
                continue;
            }
            if (strpos($part, '::') !== false) {
                list($class, $constant) = explode('::', $part, 2);
                $resolved = self::resolveClass($class, $context, $uses);
                self::assertNotNull($resolved, "{$where}: unknown class in {$type}");
                self::assertTrue(defined($resolved . '::' . $constant), "{$where}: unknown constant {$part}");
                continue;
            }
            $resolved = self::resolveClass($part, $context, $uses);
            self::assertNotNull($resolved, "{$where}: unknown type {$part} in {$type}");
            self::assertFalse(
                method_exists($resolved, 'getAllowableEnumValues') && !method_exists($resolved, 'openAPITypes'),
                "{$where}: the value of the enum {$part} is a string, document its constants or string instead"
            );
        }
    }

    /**
     * @param ReflectionClass<object> $context
     * @param array<string, string> $uses
     */
    private static function resolveClass(string $name, ReflectionClass $context, array $uses): ?string
    {
        $candidates = $name[0] === '\\'
            ? [substr($name, 1)]
            : [$uses[$name] ?? $name, $context->getNamespaceName() . '\\' . $name];
        foreach ($candidates as $candidate) {
            if (class_exists($candidate) || interface_exists($candidate)) {
                return $candidate;
            }
        }
        return null;
    }

    /**
     * @return string[]
     */
    private static function splitUnion(string $type): array
    {
        $parts = [];
        $depth = 0;
        $current = '';
        foreach (str_split($type) as $char) {
            if (in_array($char, ['(', '<', '{'], true)) {
                $depth++;
            } elseif (in_array($char, [')', '>', '}'], true)) {
                $depth--;
            }
            if ($char === '|' && $depth === 0) {
                $parts[] = $current;
                $current = '';
                continue;
            }
            $current .= $char;
        }
        $parts[] = $current;
        return $parts;
    }

    /**
     * @param ReflectionClass<object> $class
     * @return array<string, string> short name => class
     */
    private static function useStatements(ReflectionClass $class): array
    {
        $source = (string) file_get_contents((string) $class->getFileName());
        preg_match_all('/^use\s+\\\\?([\w\\\\]+)(?:\s+as\s+(\w+))?;/m', $source, $matches, PREG_SET_ORDER);
        $uses = [];
        foreach ($matches as $match) {
            $alias = isset($match[2]) && $match[2] !== '' ? $match[2] : substr((string) strrchr('\\' . $match[1], '\\'), 1);
            $uses[$alias] = $match[1];
        }
        return $uses;
    }
}
