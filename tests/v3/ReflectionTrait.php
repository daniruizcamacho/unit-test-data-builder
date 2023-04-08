<?php

declare(strict_types=1);

namespace App\Tests\v3;

trait ReflectionTrait
{
    public function createInstance(string $className): object
    {
        $reflection = new \ReflectionClass($className);

        return $reflection->newInstanceWithoutConstructor();
    }

    public function setPrivateValue(object $object, string $property, mixed $value): void
    {
        $refObject = new \ReflectionObject($object);
        $refProperty = $refObject->getProperty($property);
        $refProperty->setAccessible(true);
        $refProperty->setValue($object, $value);
        $refProperty->setAccessible(false);
    }
}
