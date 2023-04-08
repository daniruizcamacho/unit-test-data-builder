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
        $order = new Course(
            1,
            [LessonObjectMother::aLesson('name', 500)]
        );
        $order->start();

        return $order;
    }

    public static function aCancelledCourse(): Course
    {

        $order = new Course(
            1,
            [LessonObjectMother::aLesson('name', 500)]
        );
        $order->cancel();

        return $order;
    }

    public static function aFinishedCourse(): Course
    {

        $order = new Course(
            1,
            [LessonObjectMother::aLesson('name', 500)]
        );
        $order->start();
        $order->finish();

        return $order;
    }
}
