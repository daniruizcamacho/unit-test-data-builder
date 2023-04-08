<?php

declare(strict_types=1);

namespace App\Tests\v4;

trait BuilderTrait
{
    private object $entity;

    public function createInstance(string $className): void
    {
        $reflection = new \ReflectionClass($className);

        $this->entity = $reflection->newInstanceWithoutConstructor();
    }

    private function setPrivateValue(object $object, string $property, mixed $value): void
    {
        $refObject = new \ReflectionObject($object);
        $refProperty = $refObject->getProperty($property);
        $refProperty->setAccessible(true);
        $refProperty->setValue($object, $value);
        $refProperty->setAccessible(false);
    }


    public function build(): object
    {
        return $this->entity;
    }

    public function but(): self
    {
        return clone $this;
    }

    public function __call(string $name, $value)
    {
        if (!str_starts_with($name, 'with')) {
            throw new \BadMethodCallException("Method '{$name}' is not supported");
        }

        $property = lcfirst(str_replace('with', '', $name));
        $value = current($value);

        $this->setPrivateValue($this->entity, $property, $value);

        return $this;
    }
}
