<?php

namespace Database\Seeders;

use App\Models\BlogArticle;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogArticleSeeder extends Seeder
{
    public function run()
    {
        $categories = BlogCategory::all();

        $articles = [
            [
                'title' => 'Getting Started with Laravel 10',
                'description' => 'Learn how to build your first web application with Laravel 10. This comprehensive guide covers installation, routing, controllers, views, and database integration.',
                'page_title' => 'Laravel 10 Tutorial - Complete Guide',
                'meta_desc' => 'Step-by-step guide to getting started with Laravel 10. Learn routing, controllers, Blade templates, and Eloquent ORM.',
                'status' => 1,
            ],
            [
                'title' => 'Mastering JavaScript ES6 Features',
                'description' => 'Explore the powerful features of ES6 JavaScript including arrow functions, destructuring, spread operators, classes, and modules. Perfect for modern web development.',
                'page_title' => 'ES6 JavaScript Guide',
                'meta_desc' => 'Master ES6 JavaScript features like arrow functions, destructuring, classes, and modules with practical examples.',
                'status' => 1,
            ],
            [
                'title' => 'Building RESTful APIs with Python Django',
                'description' => 'Create robust RESTful APIs using Django REST Framework. Learn about authentication, serializers, viewsets, and best practices for API development.',
                'page_title' => 'Django REST API Tutorial',
                'meta_desc' => 'Build production-ready RESTful APIs with Django REST Framework. Learn authentication, serialization, and best practices.',
                'status' => 1,
            ],
            [
                'title' => 'Database Optimization Techniques',
                'description' => 'Master database performance optimization with indexing, query optimization, caching strategies, and database sharding techniques.',
                'page_title' => 'Database Performance Guide',
                'meta_desc' => 'Learn database optimization techniques including indexing, query optimization, and caching strategies.',
                'status' => 1,
            ],
            [
                'title' => 'Docker for Beginners',
                'description' => 'Learn Docker containerization from scratch. Understand containers, images, Dockerfile, docker-compose, and deployment strategies.',
                'page_title' => 'Docker Tutorial for Beginners',
                'meta_desc' => 'Learn Docker containerization with practical examples. Master containers, images, and deployment.',
                'status' => 0,
            ],
            [
                'title' => 'Vue.js 3 Composition API',
                'description' => 'Learn the new Composition API in Vue.js 3. Understand reactive refs, computed properties, lifecycle hooks, and building complex components.',
                'page_title' => 'Vue.js 3 Composition API Guide',
                'meta_desc' => 'Master Vue.js 3 Composition API with reactive refs, computed properties, and lifecycle hooks.',
                'status' => 1,
            ],
            [
                'title' => 'UI/UX Design Principles for Developers',
                'description' => 'Essential UI/UX design principles every developer should know. Learn about typography, color theory, spacing, and user experience best practices.',
                'page_title' => 'UI/UX Design Guide for Developers',
                'meta_desc' => 'Learn essential UI/UX design principles including typography, color theory, and user experience best practices.',
                'status' => 1,
            ],
            [
                'title' => 'Node.js Microservices Architecture',
                'description' => 'Build scalable microservices with Node.js. Learn about service discovery, API gateways, inter-service communication, and deployment.',
                'page_title' => 'Node.js Microservices Guide',
                'meta_desc' => 'Build scalable microservices with Node.js. Learn about service discovery, API gateways, and communication.',
                'status' => 1,
            ],
            [
                'title' => 'Flutter Mobile App Development',
                'description' => 'Build cross-platform mobile apps with Flutter. Learn widget-based UI, state management, navigation, and native integrations.',
                'page_title' => 'Flutter App Development Guide',
                'meta_desc' => 'Build cross-platform mobile apps with Flutter. Learn UI, state management, and native integrations.',
                'status' => 0,
            ],
            [
                'title' => 'Web Security Best Practices',
                'description' => 'Protect your web applications from common security threats. Learn about XSS, CSRF, SQL injection, and security headers.',
                'page_title' => 'Web Security Guide',
                'meta_desc' => 'Learn web security best practices to protect against XSS, CSRF, SQL injection, and other threats.',
                'status' => 1,
            ],
            [
                'title' => 'React Hooks Deep Dive',
                'description' => 'Master React Hooks including useState, useEffect, useContext, useReducer, and custom hooks. Learn the underlying principles and best practices.',
                'page_title' => 'React Hooks Tutorial',
                'meta_desc' => 'Master React Hooks including useState, useEffect, useContext, and custom hooks with practical examples.',
                'status' => 1,
            ],
            [
                'title' => 'CI/CD Pipeline with GitHub Actions',
                'description' => 'Automate your software delivery with GitHub Actions. Learn to create CI/CD pipelines for testing, building, and deploying applications.',
                'page_title' => 'GitHub Actions CI/CD Guide',
                'meta_desc' => 'Learn to build CI/CD pipelines with GitHub Actions for automated testing and deployment.',
                'status' => 1,
            ],
        ];

        foreach ($articles as $index => $article) {
            $category = $categories->get($index % count($categories));

            BlogArticle::create([
                'category_id' => $category->id,
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'description' => $article['description'],
                'page_title' => $article['page_title'],
                'meta_desc' => $article['meta_desc'],
                'image' => 'blog/article/no_img.jpg',
                'status' => $article['status'],
            ]);
        }

        // Generate more articles (50+)
        $this->generateAdditionalArticles($categories);

        $this->command->info('Blog articles seeded successfully!');
    }

    private function generateAdditionalArticles($categories)
    {
        $moreArticles = [
            'Understanding JavaScript Closures' => 'Learn about JavaScript closures, scope, and how they enable powerful programming patterns.',
            'Laravel Eloquent ORM Mastery' => 'Master Laravel\'s Eloquent ORM with relationships, queries, and advanced features.',
            'Python for Data Science' => 'Learn Python for data science with pandas, numpy, and matplotlib.',
            'CSS Grid Layout Guide' => 'Master CSS Grid Layout for modern responsive web design.',
            'React vs Vue.js Comparison' => 'Compare React and Vue.js frameworks for your next project.',
            'GraphQL API Development' => 'Build GraphQL APIs with Apollo Server and client.',
            'Linux Server Administration' => 'Learn Linux server administration for web hosting and deployment.',
            'Git Version Control Guide' => 'Master Git version control for collaborative development.',
            'TypeScript for Beginners' => 'Learn TypeScript and its benefits for JavaScript development.',
            'API Testing with Postman' => 'Master API testing with Postman and automated testing strategies.',
            'Microservices vs Monolith' => 'Compare microservices and monolithic architectures for your applications.',
            'Agile Development Methodology' => 'Learn Agile development methodology and Scrum practices.',
            'Docker Compose for Development' => 'Use Docker Compose for local development environments.',
            'Nginx Configuration Guide' => 'Master Nginx web server configuration and optimization.',
            'MongoDB with Node.js' => 'Build applications with MongoDB and Node.js.',
            'Angular Framework Guide' => 'Learn Angular framework for enterprise applications.',
            'PHP 8 Features' => 'Explore new features in PHP 8 and 8.1.',
            'Web Performance Optimization' => 'Optimize web performance with best practices and tools.',
            'AWS Cloud Services' => 'Learn AWS cloud services for web applications.',
            'Mobile App Design Principles' => 'Learn mobile app design principles for better user experience.',
        ];

        foreach ($moreArticles as $title => $description) {
            $category = $categories->random();

            BlogArticle::create([
                'category_id' => $category->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $description,
                'page_title' => $title . ' - Complete Guide',
                'meta_desc' => 'Learn about ' . $title . ' with our comprehensive guide and tutorials.',
                'image' => 'blog/article/no_img.jpg',
                'status' => rand(0, 1),
            ]);
        }
    }
}
