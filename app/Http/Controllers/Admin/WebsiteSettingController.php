<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebsiteSettingRequest;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::pluck('value', 'key')->all();
        return view('admin.website-settings.index', compact('settings'));
    }

    public function update(WebsiteSettingRequest $request)
    {
        $data = $request->validated();

        $textFields = [
            'website_name',
            'tagline',
            'contact_email',
            'contact_phone',
            'address',
            'social_facebook',
            'social_twitter',
            'social_linkedin',
            'social_youtube',
            'social_instagram',
            'default_seo_title',
            'default_seo_description',
        ];

        foreach ($textFields as $field) {
            if (array_key_exists($field, $data)) {
                WebsiteSetting::set($field, $data[$field]);
            }
        }

        // Logo upload
        if ($request->hasFile('logo_file')) {
            $oldLogo = WebsiteSetting::get('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $logoPath = $request->file('logo_file')->store('settings', 'public');
            WebsiteSetting::set('logo', $logoPath);
        }

        // Favicon upload
        if ($request->hasFile('favicon_file')) {
            $oldFavicon = WebsiteSetting::get('favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $faviconPath = $request->file('favicon_file')->store('settings', 'public');
            WebsiteSetting::set('favicon', $faviconPath);
        }

        return redirect()->route('admin.settings')->with('success', 'Website settings updated successfully.');
    }
}
