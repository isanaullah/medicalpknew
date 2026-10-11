<?php

namespace Database\Seeders;

use App\Models\WebsitePage;
use Illuminate\Database\Seeder;

class WebsitePageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Verdant Academy',
                'slug' => 'about',
                'content' => 'Verdant Academy was founded with a singular conviction: technical education should be rigorous, beautifully designed, and taught by practitioners currently writing production code. We empower engineers, designers, and data professionals worldwide.',
                'meta_title' => 'About Us — Verdant Academy',
                'meta_description' => 'Learn about the mission, faculty, and educational philosophy of Verdant Academy.',
                'status' => 'Published',
            ],
            [
                'title' => 'Contact Us & Student Support',
                'slug' => 'contact',
                'content' => 'Have questions about our curriculums, enterprise training packages, or student admissions? Reach out to our admissions advisors and faculty support staff.',
                'meta_title' => 'Contact Us — Verdant Academy',
                'meta_description' => 'Get in touch with the Verdant Academy team for admissions and technical support.',
                'status' => 'Published',
            ],
            [
                'title' => 'Help Center & Documentation',
                'slug' => 'help-center',
                'content' => 'Find answers to common questions regarding student dashboard setup, course enrollment, video playback, billing inquiries, and certificate validation.',
                'meta_title' => 'Help Center & FAQs — Verdant Academy',
                'meta_description' => 'Browse answers and troubleshooting guides for Verdant Academy students.',
                'status' => 'Published',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy',
                'content' => 'At Verdant Academy, we treat your personal information with deep respect. We do not sell your data to third-party brokers. This policy outlines how information is collected, processed, and safeguarded.',
                'meta_title' => 'Privacy Policy — Verdant Academy',
                'meta_description' => 'Read our complete privacy policy and information handling practices.',
                'status' => 'Published',
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms',
                'content' => 'By creating an account or purchasing access to Verdant Academy educational services, you agree to these Terms of Service. Please review academic integrity rules and intellectual property protections.',
                'meta_title' => 'Terms of Service — Verdant Academy',
                'meta_description' => 'The terms, conditions, and usage policies governing Verdant Academy.',
                'status' => 'Published',
            ],
            [
                'title' => 'Legal Disclaimer',
                'slug' => 'disclaimer',
                'content' => 'Course materials and technical guidance provided on Verdant Academy are for educational purposes. Results depend on individual application, practice, and market conditions.',
                'meta_title' => 'Legal Disclaimer — Verdant Academy',
                'meta_description' => 'Educational disclaimers and liability limitations.',
                'status' => 'Published',
            ],
            [
                'title' => 'Cookie Policy',
                'slug' => 'cookies',
                'content' => 'We utilize essential session cookies to keep you securely signed in and remember your video playback preferences. Learn how we configure analytical and functional cookies.',
                'meta_title' => 'Cookie Policy — Verdant Academy',
                'meta_description' => 'Details on cookies and tracking technologies used on our website.',
                'status' => 'Published',
            ],
            [
                'title' => 'Home',
                'slug' => 'home',
                'content' => 'The premier academy for high-impact technical mastery. Master modern full-stack development, cloud infrastructure, AI systems, and security architecture.',
                'meta_title' => 'Verdant Academy — Professional Technical Education',
                'meta_description' => 'Master software engineering, cloud systems, and modern AI with expert-led courses and career tracks.',
                'status' => 'Published',
            ],
            [
                'title' => 'Courses Catalog',
                'slug' => 'courses',
                'content' => 'Explore our complete curriculum of rigorous, production-focused engineering courses.',
                'meta_title' => 'All Courses — Verdant Academy',
                'meta_description' => 'Explore our complete library of professional software development and engineering courses.',
                'status' => 'Published',
            ],
            [
                'title' => 'Our Faculty & Leadership',
                'slug' => 'team',
                'content' => 'Meet the industry veterans, principal engineers, and distinguished researchers leading instruction at Verdant Academy.',
                'meta_title' => 'Faculty & Team — Verdant Academy',
                'meta_description' => 'Meet the instructors and engineering leaders teaching at Verdant Academy.',
                'status' => 'Published',
            ],
            [
                'title' => 'Structured Learning Paths',
                'slug' => 'paths',
                'content' => 'End-to-end curriculums mapped to modern job roles, from foundational competencies to staff-level architectural mastery.',
                'meta_title' => 'Learning Paths — Verdant Academy',
                'meta_description' => 'Structured step-by-step career tracks taking you from foundations to engineering leadership.',
                'status' => 'Published',
            ],
            [
                'title' => 'Technical Books & Handbooks',
                'slug' => 'books',
                'content' => 'Comprehensive technical field manuals, architectural handbooks, and reference volumes written by our lead faculty.',
                'meta_title' => 'Library & Books — Verdant Academy',
                'meta_description' => 'Deep dive into comprehensive technical textbooks, architectural field guides, and reference manuals.',
                'status' => 'Published',
            ],
            [
                'title' => 'Frequently Asked Questions',
                'slug' => 'faq',
                'content' => 'Find clear answers regarding tuition, cohort schedules, prerequisites, hardware specs, and certificates.',
                'meta_title' => 'Frequently Asked Questions — Verdant Academy',
                'meta_description' => 'Everything you need to know about our courses, mentorship, admissions, and certifications.',
                'status' => 'Published',
            ],
            [
                'title' => 'Engineering Blog & Articles',
                'slug' => 'blog',
                'content' => 'Architectural case studies, deep dives into modern frameworks, and career strategies written by our faculty.',
                'meta_title' => 'Blog & Publications — Verdant Academy',
                'meta_description' => 'Technical articles, architectural breakdowns, and engineering insights from Verdant Academy.',
                'status' => 'Published',
            ],
        ];

        foreach ($pages as $page) {
            WebsitePage::firstOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
