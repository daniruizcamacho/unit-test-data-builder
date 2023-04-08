<?php

declare(strict_types=1);

namespace App;

use Assert\Assertion;

class Lesson
{
    private const MIN_TIME = 0;

    public function __construct(
        private int $id,
        private string $name,
        private int $timeInSeconds
    ) {
        Assertion::greaterThan($timeInSeconds, self::MIN_TIME);
        Assertion::notEmpty($name);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function timeInSeconds(): int
    {
        return $this->timeInSeconds;
    }
}
