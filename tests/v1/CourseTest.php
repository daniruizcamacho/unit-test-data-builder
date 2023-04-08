<?php

declare(strict_types=1);

namespace App\Tests\v1;

use App\Course;
use App\Lesson;
use PHPUnit\Framework\TestCase;

class CourseTest extends TestCase
{
    public function testNewCourse(): void
    {
        $expectedId = 1;
        $expectedState = 'accepted';
        $expectedTotalAmount = 1500;

        $lesson1 = new Lesson(1, 'Lesson 1', 500);
        $lesson2 = new Lesson(2, 'Lesson 2', 1000);

        $course = new Course(1, [$lesson1, $lesson2]);

        $this->assertSame($expectedId, $course->id());
        $this->assertSame($expectedState, $course->state());
        $this->assertSame($expectedTotalAmount, $course->totalTimeInSeconds());
    }

    public function testNewCourseWithoutLessons(): void
    {
        $expectedId = 1;
        $expectedState = 'accepted';
        $expectedTotalAmount = 0;

        $course = new Course(1, []);

        $this->assertSame($expectedId, $course->id());
        $this->assertSame($expectedState, $course->state());
        $this->assertSame($expectedTotalAmount, $course->totalTimeInSeconds());
    }

    public function testProcessCourse(): void
    {
        $expectedId = 1;
        $expectedState = 'inProgress';

        $lesson1 = new Lesson(1, 'Lesson 1', 500);
        $lesson2 = new Lesson(2, 'Lesson 2', 1000);

        $course = new Course(1, [$lesson1, $lesson2]);
        $course->process();

        $this->assertSame($expectedId, $course->id());
        $this->assertSame($expectedState, $course->state());
    }

    public static function processExceptionDataProvider(): array
    {
        $lesson1 = new Lesson(1, 'Lesson 1', 500);
        $lesson2 = new Lesson(2, 'Lesson 2', 1000);

        $cancelledCourse = new Course(1, [$lesson1, $lesson2]);
        $cancelledCourse->cancel();

        $inProgressCourse = new Course(2, [$lesson1, $lesson2]);
        $inProgressCourse->process();

        $finishedCourse = new Course(3, [$lesson1, $lesson2]);
        $finishedCourse->process();
        $finishedCourse->finish();

        return [
            'cancelled course' => [$cancelledCourse],
            'in progress course' => [$inProgressCourse],
            'finished course' => [$finishedCourse],
        ];
    }

    /**
     * @dataProvider processExceptionDataProvider
     */
    public function testProcessExceptionCourse(Course $course): void
    {
        $this->expectException(\Exception::class);
        $course->process();
    }

    public function testCancelAcceptedCourse(): void
    {
        $expectedId = 1;
        $expectedState = 'cancelled';

        $lesson1 = new Lesson(1, 'Lesson 1', 500);
        $lesson2 = new Lesson(2, 'Lesson 2', 1000);

        $course = new Course(1, [$lesson1, $lesson2]);
        $course->cancel();

        $this->assertSame($expectedId, $course->id());
        $this->assertSame($expectedState, $course->state());
    }

    public static function cancelExceptionDataProvider(): array
    {
        $lesson1 = new Lesson(1, 'Lesson 1', 500);
        $lesson2 = new Lesson(2, 'Lesson 2', 1000);

        $cancelledCourse = new Course(1, [$lesson1, $lesson2]);
        $cancelledCourse->cancel();

        $inProgressCourse = new Course(2, [$lesson1, $lesson2]);
        $inProgressCourse->process();

        $finishedCourse = new Course(3, [$lesson1, $lesson2]);
        $finishedCourse->process();
        $finishedCourse->finish();

        return [
            'cancelled course' => [$cancelledCourse],
            'in progress course' => [$inProgressCourse],
            'finished course' => [$finishedCourse],
        ];
    }

    /**
     * @dataProvider cancelExceptionDataProvider
     */
    public function testCancelExceptionCourse(Course $course): void
    {
        $this->expectException(\Exception::class);
        $course->cancel();
    }

    public function testFinishCourse(): void
    {
        $expectedId = 1;
        $expectedState = 'finished';

        $lesson1 = new Lesson(1, 'Lesson 1', 500);
        $lesson2 = new Lesson(2, 'Lesson 2', 1000);

        $course = new Course(1, [$lesson1, $lesson2]);
        $course->process();
        $course->finish();

        $this->assertSame($expectedId, $course->id());
        $this->assertSame($expectedState, $course->state());
    }

    public static function finishExceptionDataProvider(): array
    {
        $lesson1 = new Lesson(1, 'Lesson 1', 500);
        $lesson2 = new Lesson(2, 'Lesson 2', 1000);

        $cancelledCourse = new Course(1, [$lesson1, $lesson2]);
        $cancelledCourse->cancel();

        $acceptedCourse = new Course(2, [$lesson1, $lesson2]);

        $finishedCourse = new Course(3, [$lesson1, $lesson2]);
        $finishedCourse->process();
        $finishedCourse->finish();

        return [
            'cancelled course' => [$cancelledCourse],
            'accepted course' => [$acceptedCourse],
            'finished course' => [$finishedCourse],
        ];
    }

    /**
     * @dataProvider finishExceptionDataProvider
     */
    public function testFinishExceptionCourse(Course $course): void
    {
        $this->expectException(\Exception::class);
        $course->finish();
    }
}
