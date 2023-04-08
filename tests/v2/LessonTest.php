<?php

declare(strict_types=1);

namespace App\Tests\v2;

use App\Lesson;
use PHPUnit\Framework\TestCase;

class LessonTest extends TestCase
{
    public function testCreateLesson(): void
    {
        $id = 1;
        $name = 'fake name';
        $timeInSeconds = 5000;
        $lesson = new Lesson($id, $name, $timeInSeconds);

        $this->assertSame($id, $lesson->id());
        $this->assertSame($name, $lesson->name());
        $this->assertSame($timeInSeconds, $lesson->timeInSeconds());
    }
}
