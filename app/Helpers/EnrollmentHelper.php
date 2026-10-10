<?php

if (!function_exists('isUserEnrolled')) {
    function isUserEnrolled($courseId)
    {
        if (!auth()->check()) {
            return false;
        }

        return Enrollment::where('user_id', auth()->id())
            ->where('course_id', $courseId)
            ->where('status', 'active')
            ->exists();
    }
}

if (!function_exists('isCourseFree')) {
    function isCourseFree($course)
    {
        return $course->price == 0 || $course->price == null;
    }
}
