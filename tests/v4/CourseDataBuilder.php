<?php

declare(strict_types=1);

namespace App\Tests\v4;

use App\Course;
use App\Tests\v3\LessonDataBuilder;

/**
 * @method CourseDataBuilder withId(int $id)
 * @method CourseDataBuilder withState(string $state)
 * @method CourseDataBuilder withLessons(array $lessons)
 */
class CourseDataBuilder
{
    use BuilderTrait;

    private const DEFAULT_ID = 1;
    private const DEFAULT_STATE = 'accepted';

    private function __construct()
    {
        $this->createInstance(Course::class);
        $this->withId(self::DEFAULT_ID);
        $this->withState(self::DEFAULT_STATE);
        $this->withLessons([LessonDataBuilder::aLesson()->build()]);
    }

    public static function aCourse(): self
    {
        return new self();
    }
}
