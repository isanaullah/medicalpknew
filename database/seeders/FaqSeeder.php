<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'category' => 'General',
                'question' => 'How does enrollment work on Verdant Academy?',
                'answer' => 'You can browse any course in our catalog. For Free courses, click "Enroll for Free" to get immediate lifetime access. For Paid courses, complete your purchase to unlock all lessons, PDF notes, assignments, and quizzes.',
                'order' => 1,
                'status' => 'Published',
            ],
            [
                'category' => 'General',
                'question' => 'Can I watch course preview videos without paying?',
                'answer' => 'Yes! Every course on Verdant Academy includes an accessible course preview video so you can evaluate the instructor, curriculum depth, and teaching style before purchasing.',
                'order' => 2,
                'status' => 'Published',
            ],
            [
                'category' => 'Payments',
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept all major credit and debit cards (Visa, MasterCard, American Express) as well as secure digital payment gateways.',
                'order' => 3,
                'status' => 'Published',
            ],
            [
                'category' => 'Payments',
                'question' => 'What is your refund policy?',
                'answer' => 'We offer a 30-day money-back guarantee on all purchased courses if you have completed less than 25% of the coursework and have not downloaded proprietary course materials.',
                'order' => 4,
                'status' => 'Published',
            ],
            [
                'category' => 'Certificates',
                'question' => 'Do I receive a certificate upon course completion?',
                'answer' => 'Yes, once you complete all course modules and achieve a passing score on required quizzes, an official verifiable digital certificate is generated in your student portal.',
                'order' => 5,
                'status' => 'Published',
            ],
            [
                'category' => 'Access',
                'question' => 'How long do I maintain access to my enrolled courses?',
                'answer' => 'You enjoy lifetime access to all enrolled courses, including future syllabus updates, new lesson notes, and community discussions.',
                'order' => 6,
                'status' => 'Published',
            ],
            [
                'category' => 'Learning',
                'question' => 'Can I download lesson notes and study guides for offline reading?',
                'answer' => 'Enrolled students can download full PDF study guides, cheatsheets, and reference slides directly from the lesson viewer.',
                'order' => 7,
                'status' => 'Published',
            ],
            [
                'category' => 'Learning',
                'question' => 'Can I retake quizzes if I do not pass on my first attempt?',
                'answer' => 'Yes, most quizzes allow multiple attempts with a cooling-off period so you can review lesson concepts before testing again.',
                'order' => 8,
                'status' => 'Published',
            ],
            [
                'category' => 'Technical',
                'question' => 'What browsers and devices are supported?',
                'answer' => 'Verdant Academy is optimized for all modern browsers including Google Chrome, Mozilla Firefox, Apple Safari, and Microsoft Edge across desktop, tablet, and mobile devices.',
                'order' => 9,
                'status' => 'Published',
            ],
            [
                'category' => 'Support',
                'question' => 'How can I get help if I encounter an issue with a course?',
                'answer' => 'Our dedicated student support team is available 7 days a week. You can reach out via our contact page or directly email support@verdantacademy.com.',
                'order' => 10,
                'status' => 'Published',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
