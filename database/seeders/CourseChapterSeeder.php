<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseChapter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseChapterSeeder extends Seeder
{
    public function run()
    {
        $courses = Course::all();

        $chaptersData = [
            [
                'title' => 'Introduction to the Course',
                'description' => 'An overview of what you will learn and how to get the most out of this course.',
                'duration' => 15,
                'status' => 'published',
                'free_preview' => true,
            ],
            [
                'title' => 'Getting Started',
                'description' => 'Setting up your development environment and installing the required tools.',
                'duration' => 20,
                'status' => 'published',
                'free_preview' => true,
            ],
            [
                'title' => 'Core Concepts',
                'description' => 'Understanding the fundamental concepts that will be used throughout the course.',
                'duration' => 35,
                'status' => 'published',
                'free_preview' => false,
            ],
            [
                'title' => 'Building Your First Project',
                'description' => 'Apply what you\'ve learned by building a practical project from scratch.',
                'duration' => 45,
                'status' => 'published',
                'free_preview' => false,
            ],
            [
                'title' => 'Advanced Techniques',
                'description' => 'Explore advanced techniques and best practices for professional development.',
                'duration' => 40,
                'status' => 'published',
                'free_preview' => false,
            ],
            [
                'title' => 'Optimization & Performance',
                'description' => 'Learn how to optimize your applications for better performance.',
                'duration' => 30,
                'status' => 'published',
                'free_preview' => false,
            ],
            [
                'title' => 'Testing & Debugging',
                'description' => 'Master testing strategies and debugging techniques for robust applications.',
                'duration' => 25,
                'status' => 'draft',
                'free_preview' => false,
            ],
            [
                'title' => 'Deployment & Production',
                'description' => 'Learn how to deploy your applications to production environments.',
                'duration' => 20,
                'status' => 'draft',
                'free_preview' => false,
            ],
            [
                'title' => 'Final Project',
                'description' => 'Build a comprehensive final project applying all the concepts learned.',
                'duration' => 60,
                'status' => 'draft',
                'free_preview' => false,
            ],
            [
                'title' => 'Course Conclusion & Next Steps',
                'description' => 'Recap what you\'ve learned and explore next steps for continued learning.',
                'duration' => 10,
                'status' => 'draft',
                'free_preview' => false,
            ],
        ];

        foreach ($courses as $course) {
            $order = 1;
            $numChapters = rand(5, 10);
            $selectedChapters = array_slice($chaptersData, 0, $numChapters);

            foreach ($selectedChapters as $chapterData) {
                // Randomize status for some variety
                $status = ($order <= 6) ? 'published' : (rand(0, 1) ? 'published' : 'draft');

                CourseChapter::create([
                    'course_id' => $course->id,
                    'title' => $chapterData['title'],
                    'slug' => Str::slug($chapterData['title'] . '-' . $course->id . '-' . $order),
                    'description' => $chapterData['description'],
                    'order' => $order,
                    'duration_minutes' => $chapterData['duration'] + rand(0, 20),
                    'is_free_preview' => $chapterData['free_preview'],
                    'status' => $status,
                ]);
                $order++;
            }
        }

        $this->command->info('Course chapters seeded successfully!');
    }
}
