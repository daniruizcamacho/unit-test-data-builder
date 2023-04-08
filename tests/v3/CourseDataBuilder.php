<?php

declare(strict_types=1);

namespace App\Tests\v3;

use App\Course;

class CourseDataBuilder
{
    use ReflectionTrait;

    private const DEFAULT_ID = 1;
    private const DEFAULT_STATE = 'accepted';

    private Course $course;

    private function __construct()
    {
        $this->course = $this->createInstance(Course::class);
        $this->setPrivateValue($this->course, 'id', self::DEFAULT_ID);
        $this->setPrivateValue($this->course, 'state', self::DEFAULT_STATE);
        $this->setPrivateValue($this->course, 'lessons', [LessonDataBuilder::aLesson()->build()]);
    }

    public static function aCourse(): self
    {
        return new self();
    }

    public function build(): Course
    {
        return $this->course;
    }

    public function but(): self
    {
        return clone $this;
    }

    public function withId(int $id): self
    {
        $this->setPrivateValue($this->course, 'id', $id);

        return $this;
    }

    public function withState(string $state): self
    {
        $this->setPrivateValue($this->course, 'state', $state);

        return $this;
    }

    public function withLessons(array $lessons): self
    {
        $this->setPrivateValue($this->course, 'lessons', $lessons);

        return $this;
    }
}
