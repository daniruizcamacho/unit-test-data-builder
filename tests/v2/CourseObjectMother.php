<?php


declare(strict_types=1);

namespace App\Tests\v2;

use App\Course;

class CourseObjectMother
{
    public static function anAcceptedCourse(): Course
    {
        return new Course(
            1,
            [LessonObjectMother::aLesson('name', 500)]
        );
    }

    public static function anInProgressCourse(): Course
    {
        $course = new Course(
            1,
            [LessonObjectMother::aLesson('name', 500)]
        );
        $course->start();

        return $course;
    }

    public static function aCancelledCourse(): Course
    {

        $course = new Course(
            1,
            [LessonObjectMother::aLesson('name', 500)]
        );
        $course->cancel();

        return $course;
    }

    public static function aFinishedCourse(): Course
    {

        $course = new Course(
            1,
            [LessonObjectMother::aLesson('name', 500)]
        );
        $course->start();
        $course->finish();

        return $course;
    }
}
