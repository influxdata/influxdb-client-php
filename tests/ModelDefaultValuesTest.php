<?php

namespace InfluxDB2Test;

use InfluxDB2\Model\ModelInterface;
use PHPUnit\Framework\TestCase;

class ModelDefaultValuesTest extends TestCase
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
            if (is_subclass_of($class, ModelInterface::class)) {
                $result[$class] = [$class];
            }
        }
        return $result;
    }

    /**
     * @dataProvider modelProvider
     * @param class-string<ModelInterface> $class
     */
    public function testDefaultValuesAreAllowed(string $class): void
    {
        $model = new $class();
        self::assertInstanceOf(ModelInterface::class, $model);
        $getters = call_user_func([$class, 'getters']);

        foreach ($getters as $property => $getter) {
            $allowableValues = 'get' . str_replace('_', '', ucwords($property, '_')) . 'AllowableValues';
            if (!method_exists($model, $allowableValues)) {
                continue;
            }
            $getterCallable = [$model, $getter];
            $allowableCallable = [$model, $allowableValues];
            self::assertIsCallable($getterCallable);
            self::assertIsCallable($allowableCallable);
            $value = call_user_func($getterCallable);
            if ($value === null || is_array($value)) {
                continue;
            }
            self::assertContains($value, call_user_func($allowableCallable), "default value of '{$property}'");
        }
    }

    public function testDefaultValuesOfViewProperties(): void
    {
        $properties = new \InfluxDB2\Model\XYViewProperties();

        self::assertSame('xy', $properties->getType());
        self::assertSame('chronograf-v2', $properties->getShape());
    }

    public function testDefaultValueOfLineProtocolLengthError(): void
    {
        self::assertSame('invalid', (new \InfluxDB2\Model\LineProtocolLengthError())->getCode());
    }
}
