<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database in proper dependency order.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            SuperAdminSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            LessonNoteSeeder::class,
            QuizSeeder::class,
            BlogSeeder::class,
            FaqSeeder::class,
            WebsitePageSeeder::class,
            PageSectionSeeder::class,
            WebsiteSettingSeeder::class,
            MediaSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}
