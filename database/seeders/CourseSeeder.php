<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $categories = CourseCategory::where('status', 'active')->get();

        $courses = [
            [
                'title' => 'Full Stack Web Development Bootcamp',
                'short_description' => 'Learn HTML, CSS, JavaScript, React, Node.js, and MongoDB to become a full stack developer.',
                'description' => 'This comprehensive bootcamp covers everything you need to become a professional full stack developer. Starting from HTML and CSS basics to advanced React and Node.js concepts, you\'ll build real-world projects and gain hands-on experience. The course includes modern JavaScript, database integration, API development, and deployment strategies.',
                'price' => 299,
                'discount_price' => 149,
                'duration_minutes' => 3600,
                'level' => 'beginner',
                'status' => 'active',
            ],
            [
                'title' => 'Data Science Mastery with Python',
                'short_description' => 'Master data science and machine learning using Python, pandas, numpy, and scikit-learn.',
                'description' => 'Dive deep into data science and machine learning with Python. This course covers data analysis, visualization, statistical modeling, and machine learning algorithms. You\'ll work with real datasets and build predictive models using scikit-learn, tensorflow, and other powerful libraries.',
                'price' => 399,
                'discount_price' => 199,
                'duration_minutes' => 4800,
                'level' => 'intermediate',
                'status' => 'active',
            ],
            [
                'title' => 'React Native Mobile App Development',
                'short_description' => 'Build cross-platform mobile apps with React Native from scratch.',
                'description' => 'Learn to build beautiful and performant mobile applications using React Native. This course covers core React concepts, native components, navigation, state management, API integration, and deployment to both iOS and Android app stores.',
                'price' => 249,
                'discount_price' => null,
                'duration_minutes' => 2400,
                'level' => 'intermediate',
                'status' => 'active',
            ],
            [
                'title' => 'DevOps Engineering Guide',
                'short_description' => 'Learn Docker, Kubernetes, CI/CD, and cloud deployment strategies.',
                'description' => 'Master DevOps practices and tools including Docker, Kubernetes, Jenkins, GitHub Actions, and cloud platforms. This course covers containerization, orchestration, infrastructure as code, and automated deployment pipelines with real-world scenarios.',
                'price' => 349,
                'discount_price' => 179,
                'duration_minutes' => 3000,
                'level' => 'expert',
                'status' => 'active',
            ],
            [
                'title' => 'PHP & Laravel Advanced Course',
                'short_description' => 'Master Laravel and PHP development with advanced concepts and best practices.',
                'description' => 'Take your PHP skills to the next level with Laravel. This course covers advanced concepts like design patterns, service containers, advanced Eloquent, API development, testing, and deployment strategies. Build real-world applications and learn best practices.',
                'price' => 199,
                'discount_price' => 99,
                'duration_minutes' => 1800,
                'level' => 'intermediate',
                'status' => 'inactive',
            ],
            [
                'title' => 'Artificial Intelligence Fundamentals',
                'short_description' => 'Learn AI concepts, neural networks, and deep learning with practical implementations.',
                'description' => 'Understand the fundamentals of artificial intelligence and deep learning. This course covers neural networks, computer vision, natural language processing, and reinforcement learning. You\'ll implement AI models using TensorFlow and PyTorch.',
                'price' => 499,
                'discount_price' => 299,
                'duration_minutes' => 4200,
                'level' => 'expert',
                'status' => 'active',
            ],
            [
                'title' => 'JavaScript Algorithms & Data Structures',
                'short_description' => 'Master algorithms and data structures using JavaScript with practical examples.',
                'description' => 'Learn essential algorithms and data structures for coding interviews and competitive programming. This course covers arrays, linked lists, trees, graphs, sorting algorithms, searching, dynamic programming, and more with JavaScript implementations.',
                'price' => 149,
                'discount_price' => 79,
                'duration_minutes' => 1500,
                'level' => 'intermediate',
                'status' => 'active',
            ],
            [
                'title' => 'Cybersecurity Essentials',
                'short_description' => 'Learn cybersecurity fundamentals, ethical hacking, and network security.',
                'description' => 'Build a strong foundation in cybersecurity. This course covers network security, ethical hacking, cryptography, security best practices, and incident response. Learn to identify vulnerabilities and protect systems from attacks.',
                'price' => 299,
                'discount_price' => null,
                'duration_minutes' => 2000,
                'level' => 'beginner',
                'status' => 'active',
            ],
            [
                'title' => 'Vue.js 3 Advanced Patterns',
                'short_description' => 'Master Vue.js 3 with advanced patterns, state management, and performance optimization.',
                'description' => 'Take your Vue.js skills to the professional level. This course covers Vue 3 composition API, Vuex/Pinia state management, routing, server-side rendering, and performance optimization techniques for building large-scale applications.',
                'price' => 179,
                'discount_price' => 89,
                'duration_minutes' => 1200,
                'level' => 'intermediate',
                'status' => 'inactive',
            ],
            [
                'title' => 'MongoDB & NoSQL Database Design',
                'short_description' => 'Learn NoSQL database design and MongoDB with advanced querying and aggregation.',
                'description' => 'Master NoSQL database design with MongoDB. This course covers document modeling, advanced queries, aggregation pipelines, indexing strategies, sharding, and replication. Learn to build scalable and performant database solutions.',
                'price' => 219,
                'discount_price' => 119,
                'duration_minutes' => 1500,
                'level' => 'intermediate',
                'status' => 'active',
            ],
        ];

        foreach ($courses as $index => $course) {
            $category = $categories->get($index % count($categories));

            Course::create([
                'course_category_id' => $category->id,
                'title' => $course['title'],
                'slug' => Str::slug($course['title']),
                'image' => null,
                'short_description' => $course['short_description'],
                'description' => $course['description'],
                'price' => $course['price'],
                'discount_price' => $course['discount_price'],
                'duration_minutes' => $course['duration_minutes'],
                'level' => $course['level'],
                'status' => $course['status'],
            ]);
        }

        // Generate more courses
        $this->generateAdditionalCourses($categories);

        $this->command->info('Courses seeded successfully!');
    }

    private function generateAdditionalCourses($categories)
    {
        $moreCourses = [
            'Flutter Complete Course' => [
                'desc' => 'Build beautiful cross-platform apps with Flutter and Dart from zero to hero.',
                'level' => 'beginner',
                'price' => 199,
                'discount' => 99,
                'duration' => 1800,
            ],
            'Linux Server Administration' => [
                'desc' => 'Learn Linux server administration, security, and web hosting management.',
                'level' => 'intermediate',
                'price' => 249,
                'discount' => null,
                'duration' => 1200,
            ],
            'GraphQL API Development' => [
                'desc' => 'Build GraphQL APIs with Apollo Server, Express, and React client.',
                'level' => 'intermediate',
                'price' => 179,
                'discount' => 89,
                'duration' => 900,
            ],
            'TypeScript Masterclass' => [
                'desc' => 'Master TypeScript for large-scale JavaScript applications with advanced typing.',
                'level' => 'intermediate',
                'price' => 149,
                'discount' => 69,
                'duration' => 800,
            ],
            'Angular Framework Complete Guide' => [
                'desc' => 'Build enterprise applications with Angular, RxJS, and NgRx state management.',
                'level' => 'expert',
                'price' => 299,
                'discount' => 149,
                'duration' => 2500,
            ],
            'Python Web Development with Django' => [
                'desc' => 'Build professional web applications with Django and Python.',
                'level' => 'beginner',
                'price' => 199,
                'discount' => 99,
                'duration' => 1600,
            ],
            'CSS Mastery & Advanced Layouts' => [
                'desc' => 'Master CSS with Grid, Flexbox, animations, and advanced layouts.',
                'level' => 'beginner',
                'price' => 99,
                'discount' => 49,
                'duration' => 600,
            ],
            'Cloud Architecture with AWS' => [
                'desc' => 'Design and deploy scalable cloud applications on AWS with best practices.',
                'level' => 'expert',
                'price' => 399,
                'discount' => 199,
                'duration' => 3000,
            ],
            'Machine Learning with TensorFlow' => [
                'desc' => 'Build and deploy machine learning models using TensorFlow and Keras.',
                'level' => 'expert',
                'price' => 449,
                'discount' => 249,
                'duration' => 3500,
            ],
            'REST API Design & Development' => [
                'desc' => 'Design and build RESTful APIs with best practices and security.',
                'level' => 'intermediate',
                'price' => 149,
                'discount' => 79,
                'duration' => 700,
            ],
        ];

        foreach ($moreCourses as $title => $data) {
            $category = $categories->random();

            Course::create([
                'course_category_id' => $category->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'image' => null,
                'short_description' => $data['desc'],
                'description' => $data['desc'] . ' This comprehensive course includes practical projects, real-world examples, and expert tips to help you master the subject. Suitable for all skill levels.',
                'price' => $data['price'],
                'discount_price' => $data['discount'],
                'duration_minutes' => $data['duration'],
                'level' => $data['level'],
                'status' => ['active', 'inactive', 'active', 'active'][rand(0, 3)],
            ]);
        }
    }
}
