<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::role('Super Admin')->first();
        $uploaderId = $admin ? $admin->id : null;

        // Sample valid SVG file content
        $sampleSvg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 450" width="800" height="450"><rect width="800" height="450" fill="#3D1225"/><circle cx="400" cy="225" r="90" fill="#D9A521"/><text x="400" y="240" font-family="Arial, sans-serif" font-size="28" font-weight="bold" fill="#ffffff" text-anchor="middle">Verdant Academy</text></svg>';

        $fileName = 'verdant_academy_banner.svg';
        $storagePath = 'media/' . $fileName;

        Storage::disk('public')->put($storagePath, $sampleSvg);

        Media::updateOrCreate(
            ['file_path' => $storagePath],
            [
                'name' => $fileName,
                'mime_type' => 'image/svg+xml',
                'file_size' => strlen($sampleSvg),
                'alt_text' => 'Verdant Academy Brand Banner',
                'title' => 'Verdant Academy Official Banner',
                'description' => 'Vector graphic brand banner used across curriculum cards and social assets.',
                'uploaded_by' => $uploaderId,
            ]
        );
    }
}
