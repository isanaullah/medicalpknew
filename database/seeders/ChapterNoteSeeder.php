<?php

namespace Database\Seeders;

use App\Models\CourseChapter;
use App\Models\ChapterNote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChapterNoteSeeder extends Seeder
{
    public function run()
    {
        $chapters = CourseChapter::all();

        $noteTypes = ['text', 'text', 'text', 'pdf', 'video', 'text', 'quiz', 'text', 'assignment'];
        $statuses = ['published', 'published', 'published', 'draft', 'published', 'archived', 'published'];

        foreach ($chapters as $chapter) {
            $numNotes = rand(3, 8);
            $order = 1;

            for ($i = 1; $i <= $numNotes; $i++) {
                $type = $noteTypes[array_rand($noteTypes)];
                $status = $statuses[array_rand($statuses)];
                $isFree = ($order <= 2) ? true : (rand(0, 1) ? true : false);

                $title = $this->getNoteTitle($type, $i);

                ChapterNote::create([
                    'course_chapter_id' => $chapter->id,
                    'title' => $title,
                    'slug' => Str::slug($title . '-' . $chapter->id . '-' . $order),
                    'excerpt' => 'This note covers ' . $title . ' in detail with practical examples.',
                    'content' => $this->getNoteContent($type, $title),
                    'featured_image' => null,
                    'file_path' => $type == 'pdf' ? 'notes/files/sample_' . $i . '.pdf' : null,
                    'file_url' => $type == 'pdf' ? asset('storage/notes/files/sample_' . $i . '.pdf') : null,
                    'file_size' => $type == 'pdf' ? '1.2 MB' : null,
                    'mime_type' => $type == 'pdf' ? 'application/pdf' : null,
                    'video_url' => $type == 'video' ? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' : null,
                    'video_duration' => $type == 'video' ? '10:30' : null,
                    'type' => $type,
                    'order' => $order,
                    'is_free_preview' => $isFree,
                    'views_count' => rand(10, 500),
                    'downloads_count' => $type == 'pdf' ? rand(5, 100) : 0,
                    'status' => $status,
                    'published_at' => $status == 'published' ? now()->subDays(rand(1, 30)) : null,
                ]);

                $order++;
            }
        }

        $this->command->info('Chapter notes seeded successfully!');
    }

    private function getNoteTitle($type, $index)
    {
        $titles = [
            'text' => [
                'Introduction to the Topic',
                'Understanding the Basics',
                'Deep Dive into Concepts',
                'Practical Applications',
                'Best Practices and Tips',
                'Common Mistakes to Avoid',
                'Advanced Strategies',
                'Real-world Examples',
                'Summary and Key Takeaways',
                'Additional Resources',
            ],
            'pdf' => [
                'Course Material - Part 1',
                'Course Material - Part 2',
                'Reference Guide',
                'Cheat Sheet',
                'Supplementary Reading',
                'Practice Exercises',
                'Project Documentation',
                'Additional Notes',
            ],
            'video' => [
                'Video Tutorial - Getting Started',
                'Video Tutorial - Core Concepts',
                'Video Tutorial - Advanced Topics',
                'Video Tutorial - Project Walkthrough',
                'Video Tutorial - Best Practices',
                'Video Tutorial - Q&A Session',
            ],
            'quiz' => [
                'Quiz - Basic Concepts',
                'Quiz - Intermediate Level',
                'Quiz - Advanced Topics',
                'Practice Test - Section 1',
                'Practice Test - Section 2',
                'Final Assessment',
            ],
            'assignment' => [
                'Assignment - Basic Exercise',
                'Assignment - Intermediate Project',
                'Assignment - Advanced Challenge',
                'Assignment - Real-world Task',
                'Assignment - Final Project',
            ],
        ];

        $typeTitles = $titles[$type] ?? $titles['text'];
        return $typeTitles[$index % count($typeTitles)];
    }

    private function getNoteContent($type, $title)
    {
        $contents = [
            'text' => '
<h3>Introduction</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

<h3>Key Concepts</h3>
<ul>
    <li>Concept 1: Understanding the fundamentals</li>
    <li>Concept 2: Practical applications</li>
    <li>Concept 3: Advanced techniques</li>
    <li>Concept 4: Best practices</li>
</ul>

<h3>Examples</h3>
<pre><code>
// Sample code example
function example() {
    console.log("Hello World!");
    return true;
}
</code></pre>

<h3>Summary</h3>
<p>In this note, we covered ' . $title . ' and its practical applications. Remember to practice regularly and refer back to this material as needed.</p>
',
            'pdf' => 'This note contains PDF material for ' . $title . '. Please download the attached file for detailed content.',
            'video' => 'Watch the video tutorial on ' . $title . ' for a comprehensive walkthrough.',
            'quiz' => 'Test your knowledge with this quiz on ' . $title . '. Answer all questions to check your understanding.',
            'assignment' => 'Complete the following assignment on ' . $title . '. Submit your work for evaluation.',
        ];

        return $contents[$type] ?? $contents['text'];
    }
}
