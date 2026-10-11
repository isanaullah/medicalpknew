<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Frontend, backend, APIs, and modern full-stack web applications.',
                'status' => 'Active',
            ],
            [
                'name' => 'Data Science & Analytics',
                'slug' => 'data-science-analytics',
                'description' => 'SQL queries, Python, data visualization, business intelligence, and machine learning.',
                'status' => 'Active',
            ],
            [
                'name' => 'Product Design & UX',
                'slug' => 'product-design-ux',
                'description' => 'UX research, user testing, wireframing, and Figma design systems.',
                'status' => 'Active',
            ],
            [
                'name' => 'Cloud & DevOps',
                'slug' => 'cloud-devops',
                'description' => 'AWS cloud infrastructure, Docker containers, Kubernetes, and CI/CD pipelines.',
                'status' => 'Active',
            ],
            [
                'name' => 'Digital Marketing',
                'slug' => 'digital-marketing',
                'description' => 'SEO, paid acquisition, conversion optimization, and email marketing.',
                'status' => 'Active',
            ],
            [
                'name' => 'Mobile App Development',
                'slug' => 'mobile-app-development',
                'description' => 'Cross-platform and native mobile apps with Flutter, React Native, and Swift.',
                'status' => 'Active',
            ],
            [
                'name' => 'Artificial Intelligence & ML',
                'slug' => 'artificial-intelligence-ml',
                'description' => 'Neural networks, large language models, NLP, and computer vision.',
                'status' => 'Active',
            ],
            [
                'name' => 'Cybersecurity & Ethical Hacking',
                'slug' => 'cybersecurity-ethical-hacking',
                'description' => 'Network defense, penetration testing, cryptography, and secure development.',
                'status' => 'Active',
            ],
            [
                'name' => 'Business & Management',
                'slug' => 'business-management',
                'description' => 'Strategic leadership, project management, financial modeling, and agile processes.',
                'status' => 'Active',
            ],
            [
                'name' => 'Career & Soft Skills',
                'slug' => 'career-soft-skills',
                'description' => 'Technical interviews, communication, leadership, and remote teamwork.',
                'status' => 'Active',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
