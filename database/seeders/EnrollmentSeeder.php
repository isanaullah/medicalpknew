<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $student = User::role('Student')->first();
        if (!$student) {
            return;
        }

        $paidCourse = Course::where('slug', 'the-complete-web-development-bootcamp')->first();
        $freeCourse = Course::where('slug', 'python-for-automation-beginners')->first();

        if ($paidCourse) {
            Enrollment::updateOrCreate(
                [
                    'user_id' => $student->id,
                    'course_id' => $paidCourse->id,
                ],
                [
                    'status' => 'active',
                    'enrolled_at' => now()->subDays(5),
                    'payment_status' => 'paid',
                    'payment_amount' => $paidCourse->price,
                ]
            );
        }

        if ($freeCourse) {
            Enrollment::updateOrCreate(
                [
                    'user_id' => $student->id,
                    'course_id' => $freeCourse->id,
                ],
                [
                    'status' => 'active',
                    'enrolled_at' => now()->subDays(2),
                    'payment_status' => 'free',
                    'payment_amount' => 0.00,
                ]
            );
        }
    }
}
