<?php

namespace Database\Seeders;

use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::role('Super Admin')->first();
        $authorId = $admin ? $admin->id : null;

        $catCareer = BlogCategory::firstOrCreate(['slug' => 'career'], ['name' => 'Career', 'status' => 'Active']);
        $catTech = BlogCategory::firstOrCreate(['slug' => 'technology'], ['name' => 'Technology', 'status' => 'Active']);
        $catDesign = BlogCategory::firstOrCreate(['slug' => 'design'], ['name' => 'Design', 'status' => 'Active']);
        $catData = BlogCategory::firstOrCreate(['slug' => 'data-science'], ['name' => 'Data Science', 'status' => 'Active']);

        $articles = [
            [
                'title' => 'How to Choose Your First Programming Language in 2026',
                'slug' => 'how-to-choose-your-first-programming-language-2026',
                'excerpt' => 'Python, JavaScript, or Go? Discover which language best aligns with your career goals.',
                'content' => 'Choosing your first programming language can feel overwhelming. Python is unmatched for data and automation, JavaScript powers every modern browser, and languages like Go and Rust excel in systems architecture. Consider your immediate goals before diving in.',
                'featured_image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catCareer->id,
                'author_id' => $authorId,
                'status' => 'Published',
                'published_at' => now()->subDays(14),
                'seo_title' => 'How to Choose Your First Programming Language (2026 Guide)',
                'seo_description' => 'A comprehensive comparison between Python, JavaScript, and Go for new developers.',
            ],
            [
                'title' => 'The Rise of AI-Assisted Software Engineering',
                'slug' => 'the-rise-of-ai-assisted-software-engineering',
                'excerpt' => 'Why developer velocity is accelerating and how to stay ahead of the curve.',
                'content' => 'AI tools are transforming boilerplate coding into high-level architectural problem solving. Modern software engineers must cultivate strong system design, testing discipline, and review judgment.',
                'featured_image' => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catTech->id,
                'author_id' => $authorId,
                'status' => 'Published',
                'published_at' => now()->subDays(12),
                'seo_title' => 'AI in Software Engineering: Trends and Predictions',
                'seo_description' => 'Understand how artificial intelligence is changing developer workflows and skills.',
            ],
            [
                'title' => 'Design Tokens: Bridging the Gap Between Designers and Engineers',
                'slug' => 'design-tokens-bridging-the-gap-designers-engineers',
                'excerpt' => 'Eliminate visual discrepancies by establishing a unified tokenized source of truth.',
                'content' => 'Design tokens represent design decisions as structured data (JSON). By syncing colors, typography, spacing, and elevation between Figma and CSS, cross-functional teams save hundreds of hours in handoff.',
                'featured_image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catDesign->id,
                'author_id' => $authorId,
                'status' => 'Published',
                'published_at' => now()->subDays(10),
                'seo_title' => 'Design Tokens Explained: A Unified Workflow for Designers & Devs',
                'seo_description' => 'Learn how to implement design tokens to unify Figma and CSS architecture.',
            ],
            [
                'title' => 'SQL vs NoSQL: Making the Right Architectural Tradeoff',
                'slug' => 'sql-vs-nosql-making-the-right-architectural-tradeoff',
                'excerpt' => 'Understanding ACID compliance, document stores, and relational data modeling.',
                'content' => 'Relational databases provide strict schema integrity and expressive relational joins. Document databases offer rapid prototyping and flexible schemas. Here is how to evaluate the right choice for your workload.',
                'featured_image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catData->id,
                'author_id' => $authorId,
                'status' => 'Published',
                'published_at' => now()->subDays(8),
                'seo_title' => 'SQL vs NoSQL: Database Architecture Comparison',
                'seo_description' => 'Deep dive into ACID guarantees, horizontal scalability, and storage models.',
            ],
            [
                'title' => 'Mastering Technical Interviews: A Practical Roadmap',
                'slug' => 'mastering-technical-interviews-a-practical-roadmap',
                'excerpt' => 'Move beyond memorizing algorithms to communicating clear tradeoffs and system designs.',
                'content' => 'Top engineering companies assess how you think through ambiguity. Learn how to ask clarifying questions, validate boundary cases, and write structured, readable code under pressure.',
                'featured_image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catCareer->id,
                'author_id' => $authorId,
                'status' => 'Published',
                'published_at' => now()->subDays(6),
                'seo_title' => 'Technical Interview Roadmap: How to Pass Coding Assessments',
                'seo_description' => 'Actionable strategies for problem-solving communication and whiteboard coding.',
            ],
            [
                'title' => 'Zero-Downtime Deployments with Docker and CI/CD Pipelines',
                'slug' => 'zero-downtime-deployments-with-docker-ci-cd',
                'excerpt' => 'Implement blue-green deployments and automated health checks in production.',
                'content' => 'Downtime costs revenue and user trust. Learn how container health probes, rolling updates, and reverse proxies route traffic seamlessly while deploying new software versions.',
                'featured_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catTech->id,
                'author_id' => $authorId,
                'status' => 'Published',
                'published_at' => now()->subDays(4),
                'seo_title' => 'Zero-Downtime Deployment Guide with Docker and GitHub Actions',
                'seo_description' => 'Step-by-step setup for automated testing and rolling deployment pipelines.',
            ],
            [
                'title' => 'Why Web Accessibility (a11y) is Essential for Every Business',
                'slug' => 'why-web-accessibility-a11y-is-essential-for-business',
                'excerpt' => 'Accessible interfaces improve SEO, expand market reach, and avoid legal compliance risks.',
                'content' => 'Over one billion people experience some form of disability. Building accessible digital products through semantic HTML, contrast ratios, and keyboard navigation benefits every single user.',
                'featured_image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catDesign->id,
                'author_id' => $authorId,
                'status' => 'Published',
                'published_at' => now()->subDays(2),
                'seo_title' => 'Web Accessibility (a11y) Best Practices and Business Case',
                'seo_description' => 'Why digital accessibility matters and how to implement WCAG 2.1 compliance.',
            ],
            [
                'title' => 'The Fundamentals of Machine Learning Model Evaluation',
                'slug' => 'the-fundamentals-of-machine-learning-model-evaluation',
                'excerpt' => 'Precision, recall, ROC-AUC, and avoiding overfitting on validation data.',
                'content' => 'High accuracy can be deceptive on imbalanced datasets. Learn how to interpret confusion matrices, compute F1-scores, and validate models with k-fold cross-validation.',
                'featured_image' => 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catData->id,
                'author_id' => $authorId,
                'status' => 'Published',
                'published_at' => now()->subDay(),
                'seo_title' => 'Machine Learning Evaluation Metrics Explained Simply',
                'seo_description' => 'A practical guide to Precision, Recall, F1-Score, and ROC curves in ML.',
            ],
            [
                'title' => 'Building Secure RESTful APIs with Token Authentication',
                'slug' => 'building-secure-restful-apis-with-token-authentication',
                'excerpt' => 'Explore stateless JWTs, refresh tokens, rate limiting, and CORS best practices.',
                'content' => 'Securing API endpoints requires defense in depth. In this draft guide, we cover signature verification, token expiration, HTTP-only cookie storage, and rate limiting against brute force attacks.',
                'featured_image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catTech->id,
                'author_id' => $authorId,
                'status' => 'Draft', // DRAFT EXAMPLE (Requirement)
                'published_at' => null,
                'seo_title' => 'Building Secure REST APIs (Draft)',
                'seo_description' => 'Draft article on API security mechanisms and authentication tokens.',
            ],
            [
                'title' => 'Remote Work Productivity: Habits for High-Output Engineers',
                'slug' => 'remote-work-productivity-habits-high-output-engineers',
                'excerpt' => 'Time-blocking, asynchronous communication, and sustaining deep cognitive focus.',
                'content' => 'Working remotely presents constant interruptions. Here are research-backed routines to protect blocks of uninterrupted deep work, write effective async documentation, and prevent burnout.',
                'featured_image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=70',
                'blog_category_id' => $catCareer->id,
                'author_id' => $authorId,
                'status' => 'Draft', // DRAFT EXAMPLE (Requirement)
                'published_at' => null,
                'seo_title' => 'Remote Engineering Productivity Habits',
                'seo_description' => 'Tips for managing cognitive load and deep work as a remote developer.',
            ],
        ];

        foreach ($articles as $art) {
            BlogArticle::updateOrCreate(
                ['slug' => $art['slug']],
                $art
            );
        }
    }
}
