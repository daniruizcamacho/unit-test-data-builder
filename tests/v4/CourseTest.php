<?php

declare(strict_types=1);

namespace App\Tests\v4;

use App\Course;
use PHPUnit\Framework\TestCase;

class CourseTest extends TestCase
{
    public function testNewCourse(): void
    {
        $expectedId = 1;
        $expectedState = 'accepted';
        $expectedTotalAmount = 1500;

        $lesson1 = LessonDataBuilder::aLesson()
            ->withTimeInSeconds(500)
            ->build();

        $lesson2 = LessonDataBuilder::aLesson()
            ->withTimeInSeconds(1000)
            ->build();

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

    public function testStartCourse(): void
    {
        $expectedId = 1;
        $expectedState = 'inProgress';

        $course = CourseDataBuilder::aCourse()
            ->withId($expectedId)
            ->withState('accepted')
            ->build();

        $course->start();

        $this->assertSame($expectedId, $course->id());
        $this->assertSame($expectedState, $course->state());
    }

    public static function startExceptionDataProvider(): array
    {
        $cancelledCourse = CourseDataBuilder::aCourse()
            ->withState('cancelled')
            ->build();

        $inProgressCourse = CourseDataBuilder::aCourse()
            ->withState('inProgress')
            ->build();

        $finishedCourse = CourseDataBuilder::aCourse()
            ->withState('finished')
            ->build();

        return [
            'cancelled course' => [$cancelledCourse],
            'in progress course' => [$inProgressCourse],
            'finished course' => [$finishedCourse],
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
        $expectedId = 1;
        $expectedState = 'cancelled';

        $course = CourseDataBuilder::aCourse()
            ->withId($expectedId)
            ->withState('accepted')
            ->build();
        $course->cancel();

        $this->assertSame($expectedId, $course->id());
        $this->assertSame($expectedState, $course->state());
    }

    public static function cancelExceptionDataProvider(): array
    {
        $cancelledCourse = CourseDataBuilder::aCourse()
            ->withState('cancelled')
            ->build();

        $inProgressCourse = CourseDataBuilder::aCourse()
            ->withState('inProgress')
            ->build();

        $finishedCourse = CourseDataBuilder::aCourse()
            ->withState('finished')
            ->build();

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

        $course = CourseDataBuilder::aCourse()
            ->withId($expectedId)
            ->withState('inProgress')
            ->build();
        $course->finish();

        $this->assertSame($expectedId, $course->id());
        $this->assertSame($expectedState, $course->state());
    }

    public static function finishExceptionDataProvider(): array
    {

        $cancelledCourse = CourseDataBuilder::aCourse()
            ->withState('cancelled')
            ->build();

        $acceptedCourse = CourseDataBuilder::aCourse()
            ->withState('accepted')
            ->build();

        $finishedCourse = CourseDataBuilder::aCourse()
            ->withState('finished')
            ->build();

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
