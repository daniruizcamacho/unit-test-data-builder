<?php

declare(strict_types=1);

namespace App\Tests\v2;

use App\Lesson;

class LessonObjectMother
{
    public static function aLesson(string $name, int $timeInSeconds): Lesson
    {
        return new Lesson(1, $name, $timeInSeconds);
    }
}
