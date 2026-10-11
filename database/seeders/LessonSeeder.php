<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $webBootcamp = Course::where('slug', 'the-complete-web-development-bootcamp')->first();
        $pythonAuto = Course::where('slug', 'python-for-automation-beginners')->first();
        $dataAnalytics = Course::where('slug', 'data-analytics-with-python-sql')->first();
        $productDesign = Course::where('slug', 'product-design-foundations-figma-systems')->first();
        $gitCourse = Course::where('slug', 'git-github-collaboration-masterclass')->first();

        $lessons = [
            // Course 1: The Complete Web Development Bootcamp (3 lessons - multiple lessons requirement)
            [
                'course_id' => $webBootcamp?->id,
                'title' => 'How the Web Actually Works: HTTP, DNS, & Servers',
                'slug' => 'how-the-web-actually-works-http-dns-servers',
                'description' => 'A foundational look at the client-server architecture, TCP handshakes, DNS resolution and HTTP protocol.',
                'content' => 'In this lesson, we break down what happens when you type an address into your browser and press Enter. You will explore DNS lookups, TCP handshakes, TLS certificates, request-response cycles, and status codes.',
                'video_url' => 'https://www.youtube.com/watch?v=UB1O30fR-EE',
                'duration' => '18:40',
                'order' => 1,
                'status' => 'Published',
                'is_free_preview' => true,
            ],
            [
                'course_id' => $webBootcamp?->id,
                'title' => 'HTML5 Semantic Structure & Modern Accessibility',
                'slug' => 'html5-semantic-structure-modern-accessibility',
                'description' => 'Construct accessible and search-engine friendly documents using native HTML5 landmark elements.',
                'content' => 'Explore semantic elements like header, main, nav, section, article, and footer. We cover ARIA attributes, heading hierarchy, and testing your pages with screen readers.',
                'video_url' => 'https://www.youtube.com/watch?v=kUMe1FH4CHE',
                'duration' => '24:15',
                'order' => 2,
                'status' => 'Published',
                'is_free_preview' => false,
            ],
            [
                'course_id' => $webBootcamp?->id,
                'title' => 'CSS Modern Layouts: Flexbox vs Grid Deep Dive',
                'slug' => 'css-modern-layouts-flexbox-vs-grid-deep-dive',
                'description' => 'Master 1D alignment with Flexbox and 2D responsive matrix layouts with CSS Grid.',
                'content' => 'Learn when to use Flexbox and when to use Grid. Build real component layouts like navigation bars, multi-column card galleries, and sticky dashboard sidebars.',
                'video_url' => 'https://www.youtube.com/watch?v=rg7Fvvl3taU',
                'duration' => '32:10',
                'order' => 3,
                'status' => 'Published',
                'is_free_preview' => false,
            ],

            // Course 2: Python for Automation & Beginners (2 lessons)
            [
                'course_id' => $pythonAuto?->id,
                'title' => 'Setting Up Python, Virtual Environments, & PIP',
                'slug' => 'setting-up-python-virtual-environments-pip',
                'description' => 'Configure your local developer environment, isolated virtual environments, and package management.',
                'content' => 'Step-by-step setup for Python 3. Learn how virtualenv works, how to freeze dependencies in requirements.txt, and how to run scripts via the terminal.',
                'video_url' => 'https://www.youtube.com/watch?v=kqtD5dpn9C8',
                'duration' => '15:20',
                'order' => 1,
                'status' => 'Published',
                'is_free_preview' => true,
            ],
            [
                'course_id' => $pythonAuto?->id,
                'title' => 'Automating File Processing & CSV Reports',
                'slug' => 'automating-file-processing-csv-reports',
                'description' => 'Read, transform, filter, and write thousands of spreadsheet rows programmatically.',
                'content' => 'Use Python built-in csv and pathlib modules to parse messy data files, deduplicate records, and generate clean summary reports automatically.',
                'video_url' => null, // Written lesson without video (allowed requirement)
                'duration' => '22:00',
                'order' => 2,
                'status' => 'Published',
                'is_free_preview' => false,
            ],

            // Course 3: Data Analytics with Python & SQL (2 lessons)
            [
                'course_id' => $dataAnalytics?->id,
                'title' => 'Advanced SQL Queries: JOINs, Subqueries, & Window Functions',
                'slug' => 'advanced-sql-queries-joins-subqueries-window-functions',
                'description' => 'Unlock business intelligence with multi-table joins, CTE expressions, and analytical partition functions.',
                'content' => 'Master inner, left, and full outer joins. Learn how to write Common Table Expressions (CTEs) and use ROW_NUMBER(), RANK(), and LEAD() over partitioned data.',
                'video_url' => 'https://www.youtube.com/watch?v=HXV3zeQKqGY',
                'duration' => '35:45',
                'order' => 1,
                'status' => 'Published',
                'is_free_preview' => true,
            ],
            [
                'course_id' => $dataAnalytics?->id,
                'title' => 'Data Wrangling with Pandas DataFrames',
                'slug' => 'data-wrangling-with-pandas-dataframes',
                'description' => 'Clean messy datasets, handle missing values, and reshape data using Pandas.',
                'content' => 'Learn how to filter, group, aggregate, and pivot DataFrames in Pandas. We will work with real e-commerce transactional data to compute customer retention metrics.',
                'video_url' => 'https://www.youtube.com/watch?v=vmEHCJofslg',
                'duration' => '28:30',
                'order' => 2,
                'status' => 'Published',
                'is_free_preview' => false,
            ],

            // Course 4: Product Design Foundations (2 lessons)
            [
                'course_id' => $productDesign?->id,
                'title' => 'User Research Methodologies & Problem Framing',
                'slug' => 'user-research-methodologies-problem-framing',
                'description' => 'Conduct qualitative interviews, synthesize findings into affinity maps, and define core problem statements.',
                'content' => 'Learn how to avoid leading questions during interviews, transcribe observations into themes, and formulate actionable "How Might We" opportunity statements.',
                'video_url' => 'https://www.youtube.com/watch?v=c8aN7i_M6oI',
                'duration' => '20:15',
                'order' => 1,
                'status' => 'Published',
                'is_free_preview' => true,
            ],
            [
                'course_id' => $productDesign?->id,
                'title' => 'Building Scalable Components & Auto Layout in Figma',
                'slug' => 'building-scalable-components-auto-layout-in-figma',
                'description' => 'Master constraints, nested auto-layouts, variants, and component properties in Figma.',
                'content' => 'Step-by-step creation of production-grade UI components including buttons, input fields, badges, and modals with responsive auto-layout rules.',
                'video_url' => 'https://www.youtube.com/watch?v=4W4LvknY24U',
                'duration' => '26:50',
                'order' => 2,
                'status' => 'Published',
                'is_free_preview' => false,
            ],

            // Course 5: Git & GitHub Collaboration (1 lesson)
            [
                'course_id' => $gitCourse?->id,
                'title' => 'Branching Workflows & Pull Request Collaboration',
                'slug' => 'branching-workflows-pull-request-collaboration',
                'description' => 'Feature branches, semantic commits, code reviews, and resolving merge conflicts cleanly.',
                'content' => 'Learn professional engineering team workflows using GitHub. We cover git checkout -b, interactive rebasing, writing helpful PR descriptions, and squashing commits.',
                'video_url' => 'https://www.youtube.com/watch?v=RGOj5yH7evk',
                'duration' => '25:00',
                'order' => 1,
                'status' => 'Published',
                'is_free_preview' => true,
            ],
        ];

        foreach ($lessons as $item) {
            if (!$item['course_id']) {
                continue;
            }

            Lesson::updateOrCreate(
                [
                    'course_id' => $item['course_id'],
                    'slug' => $item['slug'],
                ],
                $item
            );
        }
    }
}
