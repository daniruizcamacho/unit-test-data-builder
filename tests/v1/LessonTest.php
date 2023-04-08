<?php

declare(strict_types=1);

namespace App\Tests\v1;

use App\Lesson;
use PHPUnit\Framework\TestCase;

class LessonTest extends TestCase
{
    public function testCreateLesson(): void
    {
        $id = 1;
        $name = 'fake name';
        $time = 5000;
        $lesson = new Lesson($id, $name, $time);

        $this->assertSame($id, $lesson->id());
        $this->assertSame($name, $lesson->name());
        $this->assertSame($time, $lesson->timeInSeconds());
    }
}
