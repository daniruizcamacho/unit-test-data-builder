<?php

declare(strict_types=1);

namespace App\Tests\v2;

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

        $product1 = new Lesson(1, 'Lesson 1', 500);
        $product2 = new Lesson(2, 'Lesson 2', 1000);

        $course = new Course(1, [$product1, $product2]);

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

    public function testStartCourse(): void
    {
        $expectedState = 'inProgress';

        $course = CourseObjectMother::anAcceptedCourse();
        $course->start();

        $this->assertSame($expectedState, $course->state());
    }

    public static function startExceptionDataProvider(): array
    {
        return [
            'cancelled course' => [CourseObjectMother::aCancelledCourse()],
            'in progress course' => [CourseObjectMother::anInProgressCourse()],
            'finished course' => [CourseObjectMother::aFinishedCourse()],
        ];
    }

    /**
     * @dataProvider startExceptionDataProvider
     */
    public function testStartExceptionCourse(Course $course): void
    {
        $this->expectException(\Exception::class);
        $course->start();
    }

    public function testCancelAcceptedCourse(): void
    {
        $expectedState = 'cancelled';

        $course = CourseObjectMother::anAcceptedCourse();
        $course->cancel();

        $this->assertSame($expectedState, $course->state());
    }

    public static function cancelExceptionDataProvider(): array
    {
        return [
            'cancelled course' => [CourseObjectMother::aCancelledCourse()],
            'in progress course' => [CourseObjectMother::anInProgressCourse()],
            'finished course' => [CourseObjectMother::aFinishedCourse()],
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
        $expectedState = 'finished';

        $course = CourseObjectMother::anInProgressCourse();
        $course->finish();

        $this->assertSame($expectedState, $course->state());
    }

    public static function finishExceptionDataProvider(): array
    {
        return [
            'cancelled course' => [CourseObjectMother::aCancelledCourse()],
            'accepted course' => [CourseObjectMother::anAcceptedCourse()],
            'finished course' => [CourseObjectMother::aFinishedCourse()],
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
