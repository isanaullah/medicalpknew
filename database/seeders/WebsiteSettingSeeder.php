<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaultSettings = [
            'website_name' => 'Verdant Academy',
            'tagline' => 'Craft, Depth, and Distraction-Free Technical Mastery',
            'contact_email' => 'admissions@verdantacademy.com',
            'contact_phone' => '+1 (800) 555-0199',
            'address' => '742 Evergreen Terrace, Suite 400, San Francisco, CA 94107',
            'social_facebook' => 'https://facebook.com/verdantacademy',
            'social_twitter' => 'https://twitter.com/verdantacademy',
            'social_linkedin' => 'https://linkedin.com/company/verdantacademy',
            'social_youtube' => 'https://youtube.com/@verdantacademy',
            'social_instagram' => 'https://instagram.com/verdantacademy',
            'default_seo_title' => 'Verdant Academy — Professional Engineering & Design Education',
            'default_seo_description' => 'Master web development, data science, product design, and cloud architecture through project-driven curriculums.',
        ];

        foreach ($defaultSettings as $key => $val) {
            WebsiteSetting::firstOrCreate(
                ['key' => $key],
                ['value' => $val, 'group' => 'general']
                
            );
        }
    }
}
