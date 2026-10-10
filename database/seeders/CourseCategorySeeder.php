<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Web Development',
                'icon' => 'fas fa-code',
                'status' => 'active',
            ],
            [
                'name' => 'Data Science',
                'icon' => 'fas fa-chart-bar',
                'status' => 'active',
            ],
            [
                'name' => 'Mobile Development',
                'icon' => 'fas fa-mobile-alt',
                'status' => 'active',
            ],
            [
                'name' => 'DevOps & Cloud',
                'icon' => 'fas fa-cloud',
                'status' => 'active',
            ],
            [
                'name' => 'Programming Languages',
                'icon' => 'fas fa-laptop-code',
                'status' => 'active',
            ],
            [
                'name' => 'Database & SQL',
                'icon' => 'fas fa-database',
                'status' => 'active',
            ],
            [
                'name' => 'UI/UX Design',
                'icon' => 'fas fa-pencil-ruler',
                'status' => 'inactive',
            ],
            [
                'name' => 'Artificial Intelligence',
                'icon' => 'fas fa-robot',
                'status' => 'active',
            ],
            [
                'name' => 'Cybersecurity',
                'icon' => 'fas fa-shield-alt',
                'status' => 'active',
            ],
            [
                'name' => 'Game Development',
                'icon' => 'fas fa-gamepad',
                'status' => 'inactive',
            ],
        ];

        foreach ($categories as $category) {
            CourseCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'icon' => $category['icon'],
                'views_count' => rand(100, 10000),
                'status' => $category['status'],
            ]);
        }

        $this->command->info('Course categories seeded successfully!');
    }
}
