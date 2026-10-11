<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonNote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class LessonNoteSeeder extends Seeder
{
    public function run(): void
    {
        // Minimal valid PDF content
        $samplePdfContent = "%PDF-1.4\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>\nendobj\n4 0 obj\n<< /Length 72 >>\nstream\nBT\n/F1 20 Tf\n80 720 Td\n(Verdant Academy - Official Lesson Study Guide) Tj\nET\nendstream\nendobj\n5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\nxref\n0 6\n0000000000 65535 f \n0000000009 00000 n \n0000000058 00000 n \n0000000115 00000 n \n0000000224 00000 n \n0000000347 00000 n \ntrailer\n<< /Size 6 /Root 1 0 R >>\nstartxref\n429\n%%EOF\n";

        $lesson1 = Lesson::where('slug', 'how-the-web-actually-works-http-dns-servers')->first();
        $lesson2 = Lesson::where('slug', 'html5-semantic-structure-modern-accessibility')->first();
        $lesson3 = Lesson::where('slug', 'advanced-sql-queries-joins-subqueries-window-functions')->first();

        $notesData = [];

        if ($lesson1) {
            $path1 = 'lesson_notes/http_dns_networking_cheatsheet.pdf';
            Storage::disk('local')->put($path1, $samplePdfContent);

            $notesData[] = [
                'lesson_id' => $lesson1->id,
                'title' => 'HTTP & DNS Networking Architecture Cheatsheet',
                'description' => 'Comprehensive visual guide and summary notes covering TCP handshakes, DNS records, and HTTP request headers.',
                'file_path' => $path1,
                'file_name' => 'http_dns_networking_cheatsheet.pdf',
                'file_size' => strlen($samplePdfContent),
                'order' => 1,
                'status' => 'Active',
            ];

            $path2 = 'lesson_notes/web_security_headers_guide.pdf';
            Storage::disk('local')->put($path2, $samplePdfContent);

            $notesData[] = [
                'lesson_id' => $lesson1->id,
                'title' => 'Web Security Headers & Status Codes Reference',
                'description' => 'Quick reference list for standard HTTP status codes (2xx, 3xx, 4xx, 5xx) and essential security headers.',
                'file_path' => $path2,
                'file_name' => 'web_security_headers_guide.pdf',
                'file_size' => strlen($samplePdfContent),
                'order' => 2,
                'status' => 'Active',
            ];
        }

        if ($lesson2) {
            $path3 = 'lesson_notes/html5_semantic_tags_checklist.pdf';
            Storage::disk('local')->put($path3, $samplePdfContent);

            $notesData[] = [
                'lesson_id' => $lesson2->id,
                'title' => 'HTML5 Semantic Tags & Accessibility Audit Checklist',
                'description' => 'Printable checklist for auditing web page semantic hierarchies and screen-reader accessibility.',
                'file_path' => $path3,
                'file_name' => 'html5_semantic_tags_checklist.pdf',
                'file_size' => strlen($samplePdfContent),
                'order' => 1,
                'status' => 'Active',
            ];
        }

        if ($lesson3) {
            $path4 = 'lesson_notes/sql_window_functions_handbook.pdf';
            Storage::disk('local')->put($path4, $samplePdfContent);

            $notesData[] = [
                'lesson_id' => $lesson3->id,
                'title' => 'Advanced SQL Window Functions Handbook',
                'description' => 'Step-by-step query recipes for running totals, moving averages, ranking, and lag/lead calculations.',
                'file_path' => $path4,
                'file_name' => 'sql_window_functions_handbook.pdf',
                'file_size' => strlen($samplePdfContent),
                'order' => 1,
                'status' => 'Active',
            ];
        }

        foreach ($notesData as $note) {
            LessonNote::updateOrCreate(
                [
                    'lesson_id' => $note['lesson_id'],
                    'title' => $note['title'],
                ],
                $note
            );
        }
    }
}
