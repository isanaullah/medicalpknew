<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'title' => 'Web Development',
                'description' => 'Articles about web development technologies, frameworks, and best practices.',
                'page_title' => 'Web Development Blog - Learn Coding',
                'meta_desc' => 'Learn web development with our comprehensive guides on HTML, CSS, JavaScript, PHP, and more.',
                'status' => 1,
            ],
            [
                'title' => 'Laravel',
                'description' => 'Everything about Laravel PHP framework - tips, tutorials, and advanced techniques.',
                'page_title' => 'Laravel Tutorials and Tips',
                'meta_desc' => 'Master Laravel with our in-depth tutorials, best practices, and real-world examples.',
                'status' => 1,
            ],
            [
                'title' => 'JavaScript',
                'description' => 'JavaScript programming tutorials, frameworks like React, Vue, and Node.js.',
                'page_title' => 'JavaScript Programming Guide',
                'meta_desc' => 'Learn JavaScript from basics to advanced concepts. ES6, React, Node.js and more.',
                'status' => 1,
            ],
            [
                'title' => 'Python',
                'description' => 'Python programming tutorials for web development, data science, and automation.',
                'page_title' => 'Python Programming Tutorials',
                'meta_desc' => 'Learn Python programming with practical examples and real-world projects.',
                'status' => 1,
            ],
            [
                'title' => 'Database',
                'description' => 'Database design, SQL, NoSQL, and database optimization techniques.',
                'page_title' => 'Database Management Guide',
                'meta_desc' => 'Learn database design, SQL queries, optimization, and best practices.',
                'status' => 1,
            ],
            [
                'title' => 'DevOps',
                'description' => 'DevOps practices, Docker, Kubernetes, CI/CD, and cloud computing.',
                'page_title' => 'DevOps and Cloud Computing',
                'meta_desc' => 'Learn DevOps practices, containerization, orchestration, and cloud services.',
                'status' => 1,
            ],
            [
                'title' => 'UI/UX Design',
                'description' => 'User interface and user experience design principles, tools, and best practices.',
                'page_title' => 'UI/UX Design Guide',
                'meta_desc' => 'Master UI/UX design with our comprehensive guides on design principles and tools.',
                'status' => 0,
            ],
            [
                'title' => 'Mobile Development',
                'description' => 'Mobile app development with Flutter, React Native, and native technologies.',
                'page_title' => 'Mobile App Development',
                'meta_desc' => 'Learn mobile app development with Flutter, React Native, and native platforms.',
                'status' => 1,
            ],
            [
                'title' => 'Machine Learning',
                'description' => 'Machine learning, artificial intelligence, and data science tutorials.',
                'page_title' => 'Machine Learning Guide',
                'meta_desc' => 'Learn machine learning, AI, and data science with practical implementations.',
                'status' => 0,
            ],
            [
                'title' => 'Security',
                'description' => 'Cybersecurity, web security, ethical hacking, and security best practices.',
                'page_title' => 'Cybersecurity Guide',
                'meta_desc' => 'Learn cybersecurity best practices, ethical hacking, and web security.',
                'status' => 1,
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::create([
                'title' => $category['title'],
                'slug' => Str::slug($category['title']),
                'description' => $category['description'],
                'page_title' => $category['page_title'],
                'meta_desc' => $category['meta_desc'],
                'image' => 'blog/category/no_img.jpg',
                'views_count' => rand(100, 5000),
                'status' => $category['status'],
            ]);
        }

        $this->command->info('Blog categories seeded successfully!');
    }
}
