<?php

declare(strict_types=1);

namespace App\Tests\v4;

use App\Lesson;
use PHPUnit\Framework\TestCase;

class LessonTest extends TestCase
{
    public function testCreateLesson(): void
    {
        $id = 1;
        $name = 'fake name';
        $timeInSeconds = 5000;
        $product = new Lesson($id, $name, $timeInSeconds);

        $this->assertSame($id, $product->id());
        $this->assertSame($name, $product->name());
        $this->assertSame($timeInSeconds, $product->timeInSeconds());
    }
}
