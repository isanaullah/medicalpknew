<?php

namespace Database\Seeders;

use App\Models\PageSection;
use App\Models\WebsitePage;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            /*
             |--------------------------------------------------------------------------
             | Home Page
             |--------------------------------------------------------------------------
             */
            'home' => [
                [
                    'section_key' => 'hero',
                    'title' => "Build a career you're proud of, one skill at a time.",
                    'subtitle' => 'Accredited Online Academy',
                    'description' => 'Verdant Academy delivers structured, expert-led programmes and books in technology, business and design — with mentor feedback, graded projects and certificates recognised by hiring teams.',
                    'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1100&q=75',
                    'config' => [
                        'badge_icon' => 'award',
                        'primary_btn_label' => 'Explore Courses',
                        'primary_btn_url' => '/courses',
                        'secondary_btn_label' => 'Shop Books',
                        'secondary_btn_url' => '/books',
                        'rating' => '4.9',
                        'reviews_count' => '12,480',
                        'outcome_stat' => '87%',
                        'outcome_label' => 'Career outcomes',
                        'outcome_desc' => 'of graduates report a role change within 8 months of finishing.',
                        'avatars' => [
                            'https://i.pravatar.cc/160?img=20',
                            'https://i.pravatar.cc/160?img=15',
                            'https://i.pravatar.cc/160?img=32',
                            'https://i.pravatar.cc/160?img=51',
                        ],
                    ],
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'stats_bar',
                    'title' => 'Academy Numbers',
                    'config' => [
                        'items' => [
                            ['value' => 48500, 'label' => 'Enrolled Students', 'suffix' => ''],
                            ['value' => 216, 'label' => 'Expert-Led Courses', 'suffix' => ''],
                            ['value' => 64, 'label' => 'Industry Instructors', 'suffix' => ''],
                            ['value' => 96, 'label' => 'Student Satisfaction', 'suffix' => '%'],
                        ],
                    ],
                    'sort_order' => 2,
                ],
                [
                    'section_key' => 'categories_intro',
                    'subtitle' => 'Browse by field',
                    'title' => 'Popular course categories',
                    'description' => 'Choose a discipline and follow a curriculum designed with hiring managers, not just academics.',
                    'sort_order' => 3,
                ],
                [
                    'section_key' => 'featured_courses_intro',
                    'subtitle' => 'Handpicked',
                    'title' => 'Featured courses this term',
                    'description' => 'Our most enrolled programmes, updated for the 2025 curriculum.',
                    'config' => [
                        'btn_label' => 'View all courses',
                        'btn_url' => '/courses',
                    ],
                    'sort_order' => 4,
                ],
                [
                    'section_key' => 'why_verdant',
                    'subtitle' => 'Why Verdant',
                    'title' => 'An academy built around how adults actually learn',
                    'description' => 'We started Verdant Academy in 2016 after watching too many online courses end in an unfinished video playlist. Our programmes are paced, mentored and assessed — because accountability is what turns information into ability.',
                    'config' => [
                        'btn_label' => 'Our story',
                        'btn_url' => '/about',
                        'features' => [
                            [
                                'icon' => 'users',
                                'title' => 'Live mentor sessions',
                                'desc' => 'Weekly small-group calls with practising professionals, not teaching assistants.',
                            ],
                            [
                                'icon' => 'folder-check',
                                'title' => 'Portfolio projects',
                                'desc' => 'Every programme ends with graded, real-world work you can show an employer.',
                            ],
                            [
                                'icon' => 'badge-check',
                                'title' => 'Verified certificates',
                                'desc' => 'Shareable credentials with a unique verification ID for each graduate.',
                            ],
                            [
                                'icon' => 'calendar-clock',
                                'title' => 'Learn at your pace',
                                'desc' => 'Lifetime access to lessons, with structured weekly milestones to keep momentum.',
                            ],
                        ],
                    ],
                    'sort_order' => 5,
                ],
                [
                    'section_key' => 'learning_paths',
                    'subtitle' => 'Structured programmes',
                    'title' => 'Popular learning paths',
                    'description' => 'Multi-course tracks that take you from fundamentals to job-ready in a defined number of weeks.',
                    'config' => [
                        'items' => [
                            [
                                'icon' => 'code-2',
                                'title' => 'Full-Stack Developer Path',
                                'desc' => 'Six courses taking you from HTML fundamentals to deploying production applications.',
                                'courses' => '6 courses',
                                'duration' => '28 weeks',
                                'level' => 'Beginner → Advanced',
                            ],
                            [
                                'icon' => 'bar-chart-3',
                                'title' => 'Data Analyst Path',
                                'desc' => 'SQL, Python, statistics and visual storytelling, ending with a portfolio case study.',
                                'courses' => '5 courses',
                                'duration' => '22 weeks',
                                'level' => 'Beginner → Intermediate',
                            ],
                            [
                                'icon' => 'pen-tool',
                                'title' => 'Product Designer Path',
                                'desc' => 'Research, interface design, design systems and a full portfolio-ready case study.',
                                'courses' => '5 courses',
                                'duration' => '20 weeks',
                                'level' => 'Beginner → Intermediate',
                            ],
                            [
                                'icon' => 'cloud',
                                'title' => 'Cloud Engineer Path',
                                'desc' => 'AWS core services, containers, infrastructure as code and CI/CD pipelines.',
                                'courses' => '4 courses',
                                'duration' => '18 weeks',
                                'level' => 'Intermediate',
                            ],
                        ],
                    ],
                    'sort_order' => 6,
                ],
                [
                    'section_key' => 'books_promo',
                    'subtitle' => 'New: Books & Workbooks',
                    'title' => 'Learn deeper with our printed workbooks and companion guides.',
                    'description' => 'Written by the same instructors who teach our courses. Each book pairs with a specific programme, with 40–60 guided exercises, code samples and end-of-chapter assessments.',
                    'config' => [
                        'primary_btn_label' => 'Browse the collection',
                        'primary_btn_url' => '/books',
                        'secondary_btn_label' => 'View bundles',
                        'secondary_btn_url' => '/books',
                        'images' => [
                            'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=75',
                            'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=75',
                            'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=600&q=75',
                            'https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=600&q=75',
                        ],
                    ],
                    'sort_order' => 7,
                ],
                [
                    'section_key' => 'how_it_works',
                    'subtitle' => 'Getting started',
                    'title' => 'How enrolment and learning works',
                    'config' => [
                        'steps' => [
                            [
                                'num' => '01',
                                'title' => 'Create your account',
                                'desc' => 'Register free in under a minute. No card required to browse or preview lessons.',
                            ],
                            [
                                'num' => '02',
                                'title' => 'Choose your course',
                                'desc' => 'Compare curriculum, level and duration. Read reviews from verified graduates.',
                            ],
                            [
                                'num' => '03',
                                'title' => 'Enrol and start learning',
                                'desc' => 'Get instant access to all modules, downloadable resources and the student community.',
                            ],
                            [
                                'num' => '04',
                                'title' => 'Earn your certificate',
                                'desc' => 'Complete assessments and receive a verifiable certificate for your profile.',
                            ],
                        ],
                    ],
                    'sort_order' => 8,
                ],
                [
                    'section_key' => 'instructors_intro',
                    'subtitle' => 'Our faculty',
                    'title' => 'Learn from practitioners',
                    'description' => 'Instructors who still work in their field, teaching what they use daily.',
                    'config' => [
                        'btn_label' => 'Browse their courses',
                        'btn_url' => '/courses',
                    ],
                    'sort_order' => 9,
                ],
                [
                    'section_key' => 'testimonials',
                    'subtitle' => 'Student stories',
                    'title' => 'What graduates say',
                    'config' => [
                        'items' => [
                            [
                                'quote' => 'I had tried three other online courses before this. The difference here is the accountability — mentors actually review your work and tell you what to fix.',
                                'name' => 'Elena Petrova',
                                'role' => 'Data Analyst at Northwind',
                                'avatar' => 'https://i.pravatar.cc/160?img=20',
                            ],
                            [
                                'quote' => 'The system design module changed how I run my team. I now have a shared vocabulary for architecture decisions that we use every sprint.',
                                'name' => 'Tomasz Kowalski',
                                'role' => 'Engineering Lead at Vireo',
                                'avatar' => 'https://i.pravatar.cc/160?img=60',
                            ],
                            [
                                'quote' => 'I built a complete case study during the course and used it in every interview. I had three offers within six weeks of finishing.',
                                'name' => 'Claire Dubois',
                                'role' => 'Product Designer at Lumière',
                                'avatar' => 'https://i.pravatar.cc/160?img=24',
                            ],
                        ],
                    ],
                    'sort_order' => 10,
                ],
                [
                    'section_key' => 'blog_latest_intro',
                    'subtitle' => 'Learning resources',
                    'title' => 'Latest from the academy journal',
                    'config' => [
                        'btn_label' => 'All articles',
                        'btn_url' => '/blog',
                    ],
                    'sort_order' => 11,
                ],
                [
                    'section_key' => 'faq_home_intro',
                    'subtitle' => 'Questions',
                    'title' => 'Frequently asked',
                    'description' => "Can't find what you need? Our support team replies within one business day.",
                    'config' => [
                        'btn_label' => 'Contact support',
                        'btn_url' => '/contact',
                    ],
                    'sort_order' => 12,
                ],
                [
                    'section_key' => 'newsletter',
                    'title' => 'New courses, straight to your inbox',
                    'description' => 'One email a fortnight with new course launches, free lessons and scholarship openings. No spam, unsubscribe anytime.',
                    'sort_order' => 13,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | About Page
             |--------------------------------------------------------------------------
             */
            'about' => [
                [
                    'section_key' => 'hero',
                    'subtitle' => 'Since 2016',
                    'title' => 'We build structured learning for people with real responsibilities.',
                    'description' => 'Verdant Academy exists because most online education is designed for people with unlimited time. Our programmes are built for working adults who need a clear path, honest pacing and someone to hold them accountable.',
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'hero_image',
                    'title' => 'Teaching Studio',
                    'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1000&q=75',
                    'sort_order' => 2,
                ],
                [
                    'section_key' => 'mission',
                    'subtitle' => 'Our mission',
                    'title' => 'Make high-quality professional education genuinely completable.',
                    'description' => 'We measure ourselves on completion rates, not enrolments. Every design decision — from lesson length to assignment frequency — is made to help a working adult finish what they started. That means shorter videos, weekly milestones, real mentor feedback and assessments that prove understanding rather than attendance.',
                    'body' => 'Since 2016 we have helped more than 48,000 students across 74 countries change roles, earn promotions and build businesses. Our average course completion rate is 68% — roughly four times the industry average for self-paced online learning.',
                    'config' => [
                        'vision_title' => 'Our vision',
                        'vision_desc' => 'A world where professional education is judged by what graduates can do, not by how many hours they watched.',
                        'values_title' => 'Our values',
                        'values' => [
                            'Teach only what we practise professionally',
                            'Give honest feedback, even when it is uncomfortable',
                            'Pace for real life, not ideal schedules',
                            'Publish pricing and outcomes openly',
                        ],
                    ],
                    'sort_order' => 3,
                ],
                [
                    'section_key' => 'story_timeline',
                    'subtitle' => 'Our story',
                    'title' => 'From a single evening class to a global academy',
                    'config' => [
                        'timeline' => [
                            [
                                'year' => '2016',
                                'title' => 'The first cohort',
                                'desc' => 'Twelve students in a rented room in Shoreditch learning JavaScript fundamentals over eight weeks.',
                            ],
                            [
                                'year' => '2018',
                                'title' => 'Going fully online',
                                'desc' => 'We rebuilt the curriculum around short lessons and weekly mentor calls, and launched our first remote cohort.',
                            ],
                            [
                                'year' => '2021',
                                'title' => 'Accreditation',
                                'desc' => 'Our programmes received independent accreditation, and certificates became verifiable by employers.',
                            ],
                            [
                                'year' => '2025',
                                'title' => '48,000 students',
                                'desc' => 'Today we run 216 courses across eight disciplines with 64 practising instructors worldwide.',
                            ],
                        ],
                    ],
                    'sort_order' => 4,
                ],
                [
                    'section_key' => 'faculty_intro',
                    'subtitle' => 'Faculty',
                    'title' => 'The people who will teach you',
                    'description' => 'Every instructor at Verdant still works in their field. They teach what they use.',
                    'sort_order' => 5,
                ],
                [
                    'section_key' => 'stats_strip',
                    'title' => 'Our Impact in Numbers',
                    'config' => [
                        'items' => [
                            ['value' => 48500, 'label' => 'Students enrolled', 'suffix' => ''],
                            ['value' => 74, 'label' => 'Countries reached', 'suffix' => ''],
                            ['value' => 68, 'label' => 'Course completion rate', 'suffix' => '%'],
                            ['value' => 87, 'label' => 'Report career progression', 'suffix' => '%'],
                        ],
                    ],
                    'sort_order' => 6,
                ],
                [
                    'section_key' => 'cta_banner',
                    'title' => 'Ready to start learning?',
                    'description' => 'Browse 216 courses across eight disciplines, or speak to our team about corporate training for your organisation.',
                    'config' => [
                        'primary_btn_label' => 'Browse courses',
                        'primary_btn_url' => '/courses',
                        'secondary_btn_label' => 'Meet the team',
                        'secondary_btn_url' => '/team',
                    ],
                    'sort_order' => 7,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Contact Page
             |--------------------------------------------------------------------------
             */
            'contact' => [
                [
                    'section_key' => 'hero',
                    'title' => 'Contact Us',
                    'description' => 'Questions about a course, a book order, corporate training or your account? Send us a message and we will reply within one business day.',
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'form_header',
                    'title' => 'Send us a message',
                    'subtitle' => 'Fields marked with * are required.',
                    'sort_order' => 2,
                ],
                [
                    'section_key' => 'info',
                    'title' => 'Contact information',
                    'config' => [
                        'address_title' => 'Address',
                        'address' => "42 Alder House, Kingsway\nLondon WC2B 6AN, United Kingdom",
                        'email_title' => 'Email',
                        'email' => "hello@verdantacademy.com\nsupport@verdantacademy.com",
                        'phone_title' => 'Phone',
                        'phone' => "+44 20 7123 4567\nMon–Fri, 09:00–18:00 GMT",
                        'corporate_title' => 'Corporate',
                        'corporate' => 'enterprise@verdantacademy.com',
                    ],
                    'sort_order' => 3,
                ],
                [
                    'section_key' => 'office_hours',
                    'title' => 'Office hours',
                    'description' => 'Student support replies within one business day. Urgent account issues are prioritised.',
                    'config' => [
                        'hours' => [
                            ['day' => 'Monday – Friday', 'time' => '09:00 – 18:00'],
                            ['day' => 'Saturday', 'time' => '10:00 – 14:00'],
                            ['day' => 'Sunday', 'time' => 'Closed'],
                        ],
                    ],
                    'sort_order' => 4,
                ],
                [
                    'section_key' => 'hq_map',
                    'title' => 'Verdant Academy HQ',
                    'subtitle' => 'Kingsway, London WC2B 6AN',
                    'description' => 'Interactive map placeholder',
                    'sort_order' => 5,
                ],
                [
                    'section_key' => 'faq_preview',
                    'subtitle' => 'Before you write',
                    'title' => 'Common contact questions',
                    'description' => 'Many enquiries are answered instantly in our help centre.',
                    'config' => [
                        'btn_label' => 'Visit help centre',
                        'btn_url' => '/faq',
                    ],
                    'sort_order' => 6,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | FAQ / Help Center Page
             |--------------------------------------------------------------------------
             */
            'faq' => [
                [
                    'section_key' => 'hero',
                    'title' => 'Help Centre & FAQ',
                    'description' => 'Answers to the questions we receive most often. Still stuck? Our support team replies within one business day.',
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'topic_cards',
                    'title' => 'Browse by topic',
                    'config' => [
                        'cards' => [
                            [
                                'icon' => 'book-open',
                                'title' => 'Getting started',
                                'desc' => 'Enrolment, accounts and first steps',
                                'url' => '/contact',
                            ],
                            [
                                'icon' => 'credit-card',
                                'title' => 'Payments & refunds',
                                'desc' => 'Pricing, invoices and our 30-day policy',
                                'url' => '/contact',
                            ],
                            [
                                'icon' => 'award',
                                'title' => 'Certificates',
                                'desc' => 'Verification and sharing credentials',
                                'url' => '/contact',
                            ],
                            [
                                'icon' => 'book',
                                'title' => 'Books & shipping',
                                'desc' => 'Orders, delivery and returns',
                                'url' => '/contact',
                            ],
                            [
                                'icon' => 'video',
                                'title' => 'Technical issues',
                                'desc' => 'Playback, downloads and devices',
                                'url' => '/contact',
                            ],
                            [
                                'icon' => 'briefcase',
                                'title' => 'Corporate training',
                                'desc' => 'Team plans and invoicing',
                                'url' => '/contact',
                            ],
                        ],
                    ],
                    'sort_order' => 2,
                ],
                [
                    'section_key' => 'faq_accordion_intro',
                    'title' => 'All frequently asked questions',
                    'subtitle' => '6 articles in this section',
                    'sort_order' => 3,
                ],
                [
                    'section_key' => 'support_cta',
                    'title' => 'Still need help?',
                    'description' => 'Our student support team is available Monday to Friday, 09:00–18:00 GMT, and replies to every message within one business day.',
                    'config' => [
                        'btn_label' => 'Contact support',
                        'btn_url' => '/contact',
                        'icon' => 'mail',
                    ],
                    'sort_order' => 4,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Privacy Policy Page
             |--------------------------------------------------------------------------
             */
            'privacy' => [
                [
                    'section_key' => 'hero',
                    'title' => 'Privacy Policy',
                    'subtitle' => 'Last updated: 22 June 2025',
                    'description' => 'This policy explains what personal data Verdant Academy collects, why we collect it, and the rights you have over it.',
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'legal_articles',
                    'title' => 'Policy Details',
                    'config' => [
                        'articles' => [
                            [
                                'title' => '1. Information we collect',
                                'text' => 'We collect the information you provide when you create an account, enrol in a course, purchase a book, contact support or subscribe to our newsletter. This includes your name, email address, billing details, shipping address and learning activity within the platform.',
                            ],
                            [
                                'title' => '2. How we use your data',
                                'text' => 'Your data is used to deliver courses and books, track progress, issue certificates, process payments, respond to support requests and — where you have opted in — send you course announcements and educational content.',
                            ],
                            [
                                'title' => '3. Legal basis for processing',
                                'text' => 'We process personal data on the basis of contract performance (delivering courses and books you have purchased), legitimate interest (improving our platform) and consent (marketing communications).',
                            ],
                            [
                                'title' => '4. Data retention',
                                'text' => 'Account data is retained for as long as your account remains active. Learning records are retained for seven years to support certificate verification. You may request deletion at any time.',
                            ],
                            [
                                'title' => '5. Your rights',
                                'text' => 'You have the right to access, correct, export or delete your personal data, and to withdraw consent for marketing at any time. Requests are handled within 30 days.',
                            ],
                            [
                                'title' => '6. Contacting us',
                                'text' => 'For any privacy question, contact our data protection team at privacy@verdantacademy.com.',
                            ],
                        ],
                    ],
                    'body' => 'This document is sample content created for a frontend demonstration and does not constitute legal advice.',
                    'sort_order' => 2,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Terms of Service Page
             |--------------------------------------------------------------------------
             */
            'terms' => [
                [
                    'section_key' => 'hero',
                    'title' => 'Terms & Conditions',
                    'subtitle' => 'Last updated: 22 June 2025',
                    'description' => 'These terms govern your use of the Verdant Academy platform, the courses and books purchased through it.',
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'legal_articles',
                    'title' => 'Terms Details',
                    'config' => [
                        'articles' => [
                            [
                                'title' => '1. Account responsibilities',
                                'text' => 'You are responsible for maintaining the confidentiality of your account credentials and for all activity that occurs under your account. Accounts are personal and may not be shared.',
                            ],
                            [
                                'title' => '2. Course access and licence',
                                'text' => 'Purchasing a course grants you a personal, non-transferable licence to access its content for your own learning. Redistribution, resale or public performance of course materials is prohibited.',
                            ],
                            [
                                'title' => '3. Book purchases',
                                'text' => 'Books sold through Verdant Press are covered by our shipping and returns policy. eBooks are licensed for personal use only and may not be redistributed.',
                            ],
                            [
                                'title' => '4. Payments and refunds',
                                'text' => 'All prices are displayed in US dollars and include applicable taxes where required. Course refunds are available within 30 days of purchase provided less than 30% of the course has been completed. Physical books may be returned within 30 days in original condition.',
                            ],
                            [
                                'title' => '5. Intellectual property',
                                'text' => 'All course and book content, including videos, written materials, code samples and assessments, remains the intellectual property of Verdant Academy or its instructors.',
                            ],
                            [
                                'title' => '6. Acceptable use',
                                'text' => 'You agree not to harass instructors or other students, post unlawful content, attempt to circumvent platform security, or use the platform to distribute unsolicited commercial messages.',
                            ],
                            [
                                'title' => '7. Changes to these terms',
                                'text' => 'We may update these terms to reflect changes in our services or legal obligations. Material changes will be communicated by email at least 14 days in advance.',
                            ],
                        ],
                    ],
                    'body' => 'This document is sample content created for a frontend demonstration and does not constitute legal advice.',
                    'sort_order' => 2,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Disclaimer Page
             |--------------------------------------------------------------------------
             */
            'disclaimer' => [
                [
                    'section_key' => 'hero',
                    'title' => 'Disclaimer',
                    'subtitle' => 'Last updated: 22 June 2025',
                    'description' => 'Please read this disclaimer carefully before relying on any content published on the Verdant Academy platform.',
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'legal_articles',
                    'title' => 'Disclaimer Details',
                    'config' => [
                        'articles' => [
                            [
                                'title' => '1. Educational purpose only',
                                'text' => 'All content on this platform is provided for general educational purposes. It does not constitute professional, legal, financial or medical advice and should not be relied upon as such.',
                            ],
                            [
                                'title' => '2. No guarantee of outcomes',
                                'text' => 'While we publish completion and career outcome statistics honestly, we cannot and do not guarantee that any student will obtain employment, a promotion or a specific level of income after completing a course.',
                            ],
                            [
                                'title' => '3. Accuracy of information',
                                'text' => 'We make reasonable efforts to keep course and book content current, but technology and industry practices change rapidly. We make no warranty that all content is complete, accurate or up to date.',
                            ],
                            [
                                'title' => '4. External links',
                                'text' => 'Our platform may link to third-party websites. We are not responsible for the content, accuracy or privacy practices of those sites.',
                            ],
                            [
                                'title' => '5. Limitation of liability',
                                'text' => 'To the maximum extent permitted by law, Verdant Academy is not liable for any indirect, incidental or consequential loss arising from your use of the platform.',
                            ],
                        ],
                    ],
                    'body' => 'This document is sample content created for a frontend demonstration and does not constitute legal advice.',
                    'sort_order' => 2,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Cookie Policy Page
             |--------------------------------------------------------------------------
             */
            'cookies' => [
                [
                    'section_key' => 'hero',
                    'title' => 'Cookie Policy',
                    'subtitle' => 'Last updated: 22 June 2025',
                    'description' => 'This policy explains how Verdant Academy uses cookies and similar technologies on our website.',
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'legal_articles',
                    'title' => 'Cookies Details',
                    'config' => [
                        'articles' => [
                            [
                                'title' => '1. What cookies are',
                                'text' => 'Cookies are small text files placed on your device when you visit a website. They allow the site to remember your actions and preferences over time.',
                            ],
                            [
                                'title' => '2. Strictly necessary cookies',
                                'text' => 'These cookies are required for the platform to function — for example, maintaining your login session and remembering your shopping cart. They cannot be disabled.',
                            ],
                            [
                                'title' => '3. Analytics cookies',
                                'text' => 'We use analytics cookies to understand how visitors navigate the platform, which pages are most visited and where users encounter problems. Data is aggregated and anonymised.',
                            ],
                            [
                                'title' => '4. Marketing cookies',
                                'text' => 'Where you have consented, we use marketing cookies to measure the effectiveness of our advertising campaigns and to avoid showing you the same advertisement repeatedly.',
                            ],
                            [
                                'title' => '5. Managing cookies',
                                'text' => 'You can control cookies through your browser settings. Disabling strictly necessary cookies will prevent parts of the platform from working correctly.',
                            ],
                            [
                                'title' => '6. Contact',
                                'text' => 'Questions about our use of cookies can be sent to privacy@verdantacademy.com.',
                            ],
                        ],
                    ],
                    'body' => 'This document is sample content created for a frontend demonstration and does not constitute legal advice.',
                    'sort_order' => 2,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Team Page
             |--------------------------------------------------------------------------
             */
            'team' => [
                [
                    'section_key' => 'hero',
                    'subtitle' => 'The people behind Verdant',
                    'title' => 'A small, senior team building education we would want our own children to take.',
                    'description' => 'We are 64 people across 14 countries — instructors, curriculum designers, engineers and student-support specialists who believe professional education should be completable, honest and genuinely useful.',
                    'config' => [
                        'primary_btn_label' => 'See open roles',
                        'primary_btn_url' => '#careers',
                        'secondary_btn_label' => 'Get in touch',
                        'secondary_btn_url' => '/contact',
                    ],
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'stats_strip',
                    'title' => 'Team Overview',
                    'config' => [
                        'items' => [
                            ['value' => 64, 'label' => 'Team members', 'suffix' => ''],
                            ['value' => 14, 'label' => 'Countries', 'suffix' => ''],
                            ['value' => 4, 'label' => 'Offices worldwide', 'suffix' => ''],
                            ['value' => 9, 'label' => 'Average experience', 'suffix' => ' yrs'],
                        ],
                    ],
                    'sort_order' => 2,
                ],
                [
                    'section_key' => 'leadership_intro',
                    'subtitle' => 'Leadership',
                    'title' => 'The people leading Verdant',
                    'description' => 'Between them, our leadership team has run learning platforms used by over four million students and built curricula for three accredited universities.',
                    'sort_order' => 3,
                ],
                [
                    'section_key' => 'values',
                    'subtitle' => 'What we believe',
                    'title' => 'Four principles that shape every decision',
                    'config' => [
                        'items' => [
                            [
                                'num' => '01',
                                'title' => 'Teach only what we practise',
                                'desc' => 'Every instructor at Verdant still works in their field. We teach what we use daily, not what we read about.',
                            ],
                            [
                                'num' => '02',
                                'title' => 'Pace for real life',
                                'desc' => 'Lessons are short, milestones are weekly, and completion is the measure we optimise for — not enrolment.',
                            ],
                            [
                                'num' => '03',
                                'title' => 'Give honest feedback',
                                'desc' => 'Mentors tell students what is not working as clearly as what is. That honesty is why our completion rate is 4× the industry average.',
                            ],
                            [
                                'num' => '04',
                                'title' => 'Publish outcomes openly',
                                'desc' => 'Pricing, completion rates and career outcomes are public. If we cannot measure it, we do not claim it.',
                            ],
                        ],
                    ],
                    'sort_order' => 4,
                ],
                [
                    'section_key' => 'culture',
                    'subtitle' => 'Life at Verdant',
                    'title' => 'Distributed, deliberate, and quiet by default',
                    'description' => 'We work asynchronously, meet in person twice a year, and protect long blocks of focused time — because good courses are built slowly.',
                    'config' => [
                        'photos' => [
                            'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=75',
                            'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=75',
                            'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=75',
                            'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=75',
                            'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1000&q=75',
                        ],
                    ],
                    'sort_order' => 5,
                ],
                [
                    'section_key' => 'offices',
                    'subtitle' => 'Where we work',
                    'title' => 'Four hubs, one academy',
                    'config' => [
                        'hubs' => [
                            [
                                'city' => 'London',
                                'country' => 'United Kingdom',
                                'address' => '42 Alder House, Kingsway<br>London WC2B 6AN',
                                'team' => '18 people',
                            ],
                            [
                                'city' => 'Berlin',
                                'country' => 'Germany',
                                'address' => 'Friedrichstraße 68<br>10117 Berlin',
                                'team' => '9 people',
                            ],
                            [
                                'city' => 'Toronto',
                                'country' => 'Canada',
                                'address' => '120 Adelaide Street West<br>Toronto, ON M5H 1T1',
                                'team' => '6 people',
                            ],
                            [
                                'city' => 'Remote',
                                'country' => 'Worldwide',
                                'address' => 'Distributed across 14 countries<br>Supporting students 24/5',
                                'team' => '31 people',
                            ],
                        ],
                    ],
                    'sort_order' => 6,
                ],
                [
                    'section_key' => 'careers',
                    'subtitle' => 'Join us',
                    'title' => 'We are hiring thoughtful people.',
                    'description' => 'We look for people who have built things they are proud of, care about craft and want to work on education that actually helps people change their careers. We hire slowly and deliberately — usually one or two people per quarter.',
                    'config' => [
                        'primary_btn_label' => 'Send us your CV',
                        'primary_btn_url' => '/contact',
                        'secondary_btn_label' => 'General enquiries',
                        'secondary_btn_url' => '/contact',
                        'openings_title' => 'Currently hiring',
                        'roles' => [
                            'Senior Curriculum Designer (Remote, EU)',
                            'Platform Engineer — Node & PostgreSQL (London)',
                            'Student Support Specialist (Toronto)',
                            'Growth Marketing Manager (Berlin)',
                        ],
                    ],
                    'sort_order' => 7,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Learning Paths Page
             |--------------------------------------------------------------------------
             */
            'paths' => [
                [
                    'section_key' => 'hero',
                    'title' => 'Learning Paths',
                    'description' => 'Multi-course programmes with a defined sequence, weekly milestones and a capstone project. Enrol once and follow the path at your own pace.',
                    'sort_order' => 1,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Books Page
             |--------------------------------------------------------------------------
             */
            'books' => [
                [
                    'section_key' => 'hero',
                    'subtitle' => 'The Verdant Press',
                    'title' => 'Books & Workbooks',
                    'description' => 'Written by the instructors who teach our courses. Each title pairs with a specific programme and includes 40–60 guided exercises, code samples and end-of-chapter assessments.',
                    'config' => [
                        'badges' => [
                            ['label' => 'Free shipping over $50', 'icon' => 'truck', 'class' => 'badge-sage'],
                            ['label' => 'Instant eBook delivery', 'icon' => 'zap', 'class' => 'badge-gold'],
                        ],
                    ],
                    'sort_order' => 1,
                ],
                [
                    'section_key' => 'featured_bundle',
                    'subtitle' => 'Collection bundle',
                    'title' => "The Full-Stack Developer's Library",
                    'description' => 'Four titles covering the entire modern stack — JavaScript patterns, SQL for analysts, cloud architecture and engineering leadership. Everything you need for a full-stack career, in a single bundle at 32% off.',
                    'config' => [
                        'price' => '$112',
                        'original_price' => '$164',
                        'discount_label' => 'Save $52',
                        'primary_btn_label' => 'Add bundle to cart',
                        'primary_btn_action' => 'buy-bundle',
                        'secondary_btn_label' => "See what's inside",
                        'secondary_btn_url' => '/books',
                        'images' => [
                            'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=75',
                            'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=75',
                            'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=600&q=75',
                            'https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=600&q=75',
                        ],
                    ],
                    'sort_order' => 2,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Courses Page
             |--------------------------------------------------------------------------
             */
            'courses' => [
                [
                    'section_key' => 'hero',
                    'title' => 'All Courses',
                    'description' => 'Explore our complete curriculum across development, data, design, business and cloud.',
                    'sort_order' => 1,
                ],
            ],

            /*
             |--------------------------------------------------------------------------
             | Blog Page
             |--------------------------------------------------------------------------
             */
            'blog' => [
                [
                    'section_key' => 'hero',
                    'title' => 'Learning Resources',
                    'description' => 'Practical articles on learning, career development and the skills employers are actually hiring for.',
                    'sort_order' => 1,
                ],
            ],
        ];

        foreach ($pages as $slug => $sections) {
            $page = WebsitePage::where('slug', $slug)->first();
            if (!$page) {
                continue;
            }

            foreach ($sections as $sectionData) {
                PageSection::firstOrCreate(
                    [
                        'website_page_id' => $page->id,
                        'section_key' => $sectionData['section_key'],
                    ],
                    [
                        'title' => $sectionData['title'] ?? null,
                        'subtitle' => $sectionData['subtitle'] ?? null,
                        'description' => $sectionData['description'] ?? null,
                        'body' => $sectionData['body'] ?? null,
                        'config' => $sectionData['config'] ?? null,
                        'image' => $sectionData['image'] ?? null,
                        'is_visible' => $sectionData['is_visible'] ?? true,
                        'sort_order' => $sectionData['sort_order'] ?? 0,
                    ]
                );
            }
        }
    }
}
