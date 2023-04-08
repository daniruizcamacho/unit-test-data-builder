<?php

declare(strict_types=1);

namespace App\Tests\v3;

use App\Lesson;

class LessonDataBuilder
{
    use ReflectionTrait;

    private const DEFAULT_ID = 1;
    private const DEFAULT_NAME = 'Default Lesson Name';
    private const DEFAULT_TIME_IN_SECONDS = 300;

    private Lesson $lesson;

    private function __construct()
    {
        $this->lesson = $this->createInstance(Lesson::class);
        $this->setPrivateValue($this->lesson, 'id', self::DEFAULT_ID);
        $this->setPrivateValue($this->lesson, 'name', self::DEFAULT_NAME);
        $this->setPrivateValue($this->lesson, 'timeInSeconds', self::DEFAULT_TIME_IN_SECONDS);
    }

    public static function aLesson(): self
    {
        return new self();
    }

    public function build(): Lesson
    {
        return $this->lesson;
    }

    public function but(): self
    {
        return clone $this;
    }

    public function withId(int $id): self
    {
        $this->setPrivateValue($this->lesson, 'id', $id);

        return $this;
    }

    public function withName(string $name): self
    {
        $this->setPrivateValue($this->lesson, 'name', $name);

        return $this;
    }

    public function withTimeInSeconds(int $timeInSeconds): self
    {
        $this->setPrivateValue($this->lesson, 'timeInSeconds', $timeInSeconds);

        return $this;
    }
}
