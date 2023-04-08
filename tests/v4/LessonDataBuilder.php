<?php

declare(strict_types=1);

namespace App\Tests\v4;

use App\Lesson;

/**
 * @method LessonDataBuilder withId(int $id)
 * @method LessonDataBuilder withName(string $name)
 * @method LessonDataBuilder withTimeInSeconds(int $timeInSeconds)
 */
class LessonDataBuilder
{
    use BuilderTrait;

    private const DEFAULT_ID = 1;
    private const DEFAULT_NAME = 'Default Lesson Name';
    private const DEFAULT_TIME_IN_SECONDS = 300;

    public function __construct()
    {
        $this->createInstance(Lesson::class);
        $this->withId(self::DEFAULT_ID);
        $this->withName(self::DEFAULT_NAME);
        $this->withTimeInSeconds(self::DEFAULT_TIME_IN_SECONDS);
    }

    public static function aLesson(): self
    {
        return new self();
    }
}
