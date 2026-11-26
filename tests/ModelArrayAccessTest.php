<?php

namespace InfluxDB2Test;

use ArrayAccess;
use InfluxDB2\Model\ModelInterface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Generated models are accessible as arrays by names of their properties.
 */
class ModelArrayAccessTest extends TestCase
{
    /**
     * @return array<string, array{class-string<ModelInterface>}>
     */
    public function modelProvider(): array
    {
        $result = [];
        $files = glob(__DIR__ . '/../src/InfluxDB2/Model/*.php');
        foreach ($files === false ? [] : $files as $file) {
            $class = 'InfluxDB2\\Model\\' . basename($file, '.php');
            if (is_subclass_of($class, ModelInterface::class) && is_subclass_of($class, ArrayAccess::class)) {
                $result[$class] = [$class];
            }
        }
        return $result;
    }

    /**
     * @dataProvider modelProvider
     * @param class-string<ModelInterface> $class
     */
    public function testArrayAccessByPropertyName(string $class): void
    {
        // constructors of some models set default values which are tested elsewhere
        $model = (new ReflectionClass($class))->newInstanceWithoutConstructor();
        self::assertInstanceOf(ArrayAccess::class, $model);
        $getters = call_user_func([$class, 'getters']);
        self::assertIsArray($getters);

        foreach ($getters as $property => $getter) {
            $getterCallable = [$model, $getter];
            self::assertIsCallable($getterCallable);

            $model[$property] = 'value of ' . $property;
            self::assertTrue(isset($model[$property]), "{$class}['{$property}']");
            self::assertSame('value of ' . $property, $model[$property]);
            self::assertSame('value of ' . $property, call_user_func($getterCallable));

            unset($model[$property]);
            self::assertFalse(isset($model[$property]));
            self::assertNull($model[$property]);
        }
    }

    /**
     * @dataProvider modelProvider
     * @param class-string<ModelInterface> $class
     */
    public function testArrayAccessPhpDoc(string $class): void
    {
        $reflection = new ReflectionClass($class);
        foreach (['offsetExists' => 'string', 'offsetGet' => 'string', 'offsetSet' => 'string|null', 'offsetUnset' => 'string'] as $method => $type) {
            self::assertStringContainsString(
                "@param {$type} \$offset",
                (string) $reflection->getMethod($method)->getDocComment(),
                "{$class}::{$method}()"
            );
        }
        $parent = $reflection->getParentClass();
        if ($parent !== false && $parent->implementsInterface(ArrayAccess::class)) {
            // the generic types are inherited
            return;
        }
        self::assertStringContainsString(
            '@implements ArrayAccess<string, mixed>',
            (string) $reflection->getDocComment(),
            $class
        );
    }
}
