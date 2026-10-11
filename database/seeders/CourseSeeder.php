<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::role('Super Admin')->first();
        $instructorId = $admin ? $admin->id : null;

        $catWeb = Category::where('slug', 'web-development')->first()?->id;
        $catData = Category::where('slug', 'data-science-analytics')->first()?->id;
        $catDesign = Category::where('slug', 'product-design-ux')->first()?->id;
        $catCloud = Category::where('slug', 'cloud-devops')->first()?->id;
        $catMarketing = Category::where('slug', 'digital-marketing')->first()?->id;
        $catCyber = Category::where('slug', 'cybersecurity-ethical-hacking')->first()?->id;

        $courses = [
            // 5 PAID COURSES
            [
                'title' => 'The Complete Web Development Bootcamp',
                'slug' => 'the-complete-web-development-bootcamp',
                'short_description' => 'Go from zero to deploying full-stack applications with modern web technologies.',
                'description' => 'This bootcamp is the most complete web development programme we offer. You will build eleven real projects, including an e-commerce storefront, a real-time chat application and a REST API with authentication. Each module ends with practical assignments.',
                'thumbnail' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70',
                'category_id' => $catWeb,
                'level' => 'Beginner',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '52h',
                'learning_objectives' => "Build responsive interfaces with modern HTML, CSS and JavaScript\nCreate REST APIs with Node.js and SQL\nDeploy production applications to cloud platforms",
                'prerequisites' => "A computer with any modern operating system\nNo prior programming experience required",
                'type' => 'Paid',
                'price' => 89.00,
                'discount_price' => 49.00,
                'preview_video_url' => 'https://www.youtube.com/watch?v=UB1O30fR-EE',
                'status' => 'Published',
                'is_featured' => true,
            ],
            [
                'title' => 'Data Analytics with Python & SQL',
                'slug' => 'data-analytics-with-python-sql',
                'short_description' => 'Turn raw business data into actionable decisions using pandas and SQL querying.',
                'description' => 'Learn the full analyst workflow: sourcing data, cleaning messy datasets, querying at scale and communicating findings clearly to non-technical stakeholders.',
                'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=70',
                'category_id' => $catData,
                'level' => 'Intermediate',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '44h',
                'learning_objectives' => "Write advanced analytical SQL queries\nClean and reshape data with pandas\nBuild interactive business dashboards",
                'prerequisites' => 'Basic spreadsheet experience and comfort with arithmetic.',
                'type' => 'Paid',
                'price' => 99.00,
                'discount_price' => 79.00,
                'preview_video_url' => 'https://www.youtube.com/watch?v=HXV3zeQKqGY',
                'status' => 'Published',
                'is_featured' => true,
            ],
            [
                'title' => 'Product Design Foundations & Figma Systems',
                'slug' => 'product-design-foundations-figma-systems',
                'short_description' => 'Learn user research, wireframing, high-fidelity prototypes and design systems in Figma.',
                'description' => 'A practical introduction to product design that treats design as a problem-solving discipline. You will complete a full case study from research brief to handoff.',
                'thumbnail' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=70',
                'category_id' => $catDesign,
                'level' => 'Beginner',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '36h',
                'learning_objectives' => "Run user interviews and synthesize insights\nConstruct interactive prototypes in Figma\nBuild scalable design systems",
                'prerequisites' => 'A free Figma account and passion for user experience.',
                'type' => 'Paid',
                'price' => 79.00,
                'discount_price' => 59.00,
                'preview_video_url' => 'https://www.youtube.com/watch?v=c8aN7i_M6oI',
                'status' => 'Published',
                'is_featured' => true,
            ],
            [
                'title' => 'AWS Certified Cloud Practitioner Bootcamp',
                'slug' => 'aws-certified-cloud-practitioner-bootcamp',
                'short_description' => 'Master core AWS services, architecture security and prepare for certification.',
                'description' => 'A focused exam-preparation and hands-on course covering core AWS services, pricing models, security responsibilities and architectural best practices.',
                'thumbnail' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=70',
                'category_id' => $catCloud,
                'level' => 'Beginner',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '28h',
                'learning_objectives' => "Explain core AWS services and architectural patterns\nUnderstand IAM and cloud security\nCalculate multi-tier infrastructure costs",
                'prerequisites' => 'General computer literacy.',
                'type' => 'Paid',
                'price' => 69.00,
                'discount_price' => 45.00,
                'preview_video_url' => 'https://www.youtube.com/watch?v=SOTamWNgDKc',
                'status' => 'Published',
                'is_featured' => false,
            ],
            [
                'title' => 'Cybersecurity Defense & Incident Response',
                'slug' => 'cybersecurity-defense-incident-response',
                'short_description' => 'Hands-on network analysis, vulnerability assessment and incident mitigation.',
                'description' => 'Learn how security teams detect, analyze, and neutralize cyber threats. Covers packet inspection, log auditing, threat hunting and secure configurations.',
                'thumbnail' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=70',
                'category_id' => null, // UNCATEGORIZED COURSE REQUIREMENT
                'level' => 'Advanced',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '40h',
                'learning_objectives' => "Identify common security vulnerabilities\nAnalyze malicious traffic with Wireshark\nFormulate incident response playbooks",
                'prerequisites' => 'Basic networking concepts (TCP/IP, DNS, HTTP).',
                'type' => 'Paid',
                'price' => 129.00,
                'discount_price' => null,
                'preview_video_url' => 'https://www.youtube.com/watch?v=inWWhr5tnEA',
                'status' => 'Published',
                'is_featured' => false,
            ],

            // 5 FREE COURSES
            [
                'title' => 'Python for Automation & Beginners',
                'slug' => 'python-for-automation-beginners',
                'short_description' => 'Automate repetitive daily tasks and build practical scripts in Python.',
                'description' => 'A hands-on introductory course solving everyday problems: file management, Excel processing, web scraping, and calling REST APIs.',
                'thumbnail' => 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?auto=format&fit=crop&w=800&q=70',
                'category_id' => $catData,
                'level' => 'Beginner',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '16h',
                'learning_objectives' => "Write clean Python scripts\nAutomate Excel spreadsheets and CSV parsing\nFetch live data from JSON APIs",
                'prerequisites' => 'A computer with internet access.',
                'type' => 'Free',
                'price' => 0.00,
                'discount_price' => null,
                'preview_video_url' => 'https://www.youtube.com/watch?v=kqtD5dpn9C8',
                'status' => 'Published',
                'is_featured' => true,
            ],
            [
                'title' => 'HTML5 & Modern CSS Essentials',
                'slug' => 'html5-modern-css-essentials',
                'short_description' => 'Master semantic markup, Flexbox layouts, CSS Grid, and responsive web styling.',
                'description' => 'Start building beautiful web pages from scratch. Learn how modern browser rendering works, semantic structure, accessibility, and modern responsive layouts.',
                'thumbnail' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=70',
                'category_id' => $catWeb,
                'level' => 'Beginner',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '12h',
                'learning_objectives' => "Understand HTML semantics\nMaster CSS Flexbox and Grid\nBuild mobile-responsive layouts",
                'prerequisites' => 'No prerequisites.',
                'type' => 'Free',
                'price' => 0.00,
                'discount_price' => null,
                'preview_video_url' => 'https://www.youtube.com/watch?v=UB1O30fR-EE',
                'status' => 'Published',
                'is_featured' => false,
            ],
            [
                'title' => 'Git & GitHub Collaboration Masterclass',
                'slug' => 'git-github-collaboration-masterclass',
                'short_description' => 'Learn version control, branching strategies, pull requests and team workflows.',
                'description' => 'Essential version control skills for every developer. Master branches, merge conflicts, pull request reviews, and open-source contributions.',
                'thumbnail' => 'https://images.unsplash.com/photo-1618401471353-b98aedd04e11?auto=format&fit=crop&w=800&q=70',
                'category_id' => null, // UNCATEGORIZED COURSE REQUIREMENT
                'level' => 'Beginner',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '8h',
                'learning_objectives' => "Master Git CLI commands\nResolve merge conflicts confidently\nCollaborate via GitHub pull requests",
                'prerequisites' => 'Any command line shell.',
                'type' => 'Free',
                'price' => 0.00,
                'discount_price' => null,
                'preview_video_url' => 'https://www.youtube.com/watch?v=RGOj5yH7evk',
                'status' => 'Published',
                'is_featured' => false,
            ],
            [
                'title' => 'Digital Marketing Fundamentals',
                'slug' => 'digital-marketing-fundamentals',
                'short_description' => 'Introduction to organic search, social media funnels and digital audience building.',
                'description' => 'Discover the essential principles of growth marketing. Understand how search engines rank content, how to run social campaigns, and how to measure ROI.',
                'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=70',
                'category_id' => $catMarketing,
                'level' => 'Beginner',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '10h',
                'learning_objectives' => "Understand customer acquisition funnels\nBasic SEO keyword research\nMeasure web traffic analytics",
                'prerequisites' => 'Curiosity about digital channels.',
                'type' => 'Free',
                'price' => 0.00,
                'discount_price' => null,
                'preview_video_url' => 'https://www.youtube.com/watch?v=nU-IIXBWlS4',
                'status' => 'Published',
                'is_featured' => false,
            ],
            [
                'title' => 'Intro to Prompt Engineering & Generative AI',
                'slug' => 'intro-to-prompt-engineering-generative-ai',
                'short_description' => 'Craft high-performing prompts and integrate AI models into your workflows.',
                'description' => 'Unlock the power of large language models. Learn zero-shot, few-shot prompting, chain-of-thought reasoning, and avoiding common hallucinations.',
                'thumbnail' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=800&q=70',
                'category_id' => null, // UNCATEGORIZED COURSE REQUIREMENT
                'level' => 'Beginner',
                'language' => 'English',
                'instructor_id' => $instructorId,
                'duration' => '6h',
                'learning_objectives' => "Apply few-shot prompting techniques\nStructure outputs reliably in JSON\nAutomate research summaries with AI",
                'prerequisites' => 'No coding experience needed.',
                'type' => 'Free',
                'price' => 0.00,
                'discount_price' => null,
                'preview_video_url' => 'https://www.youtube.com/watch?v=jC4v5AS4RIM',
                'status' => 'Draft',
                'is_featured' => false,
            ],
        ];

        foreach ($courses as $c) {
            Course::updateOrCreate(
                ['slug' => $c['slug']],
                $c
            );
        }
    }
}
