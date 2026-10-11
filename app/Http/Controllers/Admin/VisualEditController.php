<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use App\Models\WebsitePage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VisualEditController extends Controller
{
    /**
     * Map a page slug to its frontend route name.
     */
    protected array $routeMap = [
        'home' => 'home',
        'courses' => 'courses',
        'books' => 'books',
        'team' => 'team',
        'paths' => 'paths',
        'about' => 'about',
        'contact' => 'contact',
        'blog' => 'blog',
        'faq' => 'faq',
        'privacy' => 'privacy',
        'terms' => 'terms',
        'disclaimer' => 'disclaimer',
        'cookies' => 'cookies',
    ];

    /**
     * Redirect admin to the frontend page with visual editor enabled.
     */
    public function edit(WebsitePage $page)
    {
        return $this->editBySlug($page->slug);
    }

    /**
     * Redirect admin to the frontend page with visual editor enabled by slug.
     */
    public function editBySlug(string $slug)
    {
        $page = WebsitePage::where('slug', $slug)->firstOrFail();

        $routeName = $this->routeMap[$page->slug] ?? 'home';

        return redirect()->route($routeName, ['visual_edit' => 1]);
    }

    /**
     * Get section data as JSON for the visual edit modal.
     */
    public function getSection(WebsitePage $page, PageSection $section): JsonResponse
    {
        if ($section->website_page_id !== $page->id) {
            return response()->json(['error' => 'Section does not belong to this page.'], 403);
        }

        return response()->json([
            'success' => true,
            'section' => $section,
        ]);
    }

    /**
     * Update a page section via AJAX.
     */
    public function updateSection(Request $request, WebsitePage $page, PageSection $section): JsonResponse
    {
        if ($section->website_page_id !== $page->id) {
            return response()->json(['error' => 'Section does not belong to this page.'], 403);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'body' => 'nullable|string',
            'image' => 'nullable|string|max:1000',
            'is_visible' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'config' => 'nullable',
        ]);

        // Process config if passed as JSON string
        if ($request->has('config')) {
            $config = $request->input('config');
            if (is_string($config)) {
                $decoded = json_decode($config, true);
                $validated['config'] = json_last_error() === JSON_ERROR_NONE ? $decoded : $section->config;
            } elseif (is_array($config)) {
                $validated['config'] = $config;
            }
        }

        if ($request->has('is_visible')) {
            $validated['is_visible'] = filter_var($request->input('is_visible'), FILTER_VALIDATE_BOOLEAN);
        }

        $section->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Section "' . $section->section_key . '" updated successfully.',
            'section' => $section->fresh(),
        ]);
    }

    /**
     * Toggle visibility of a section.
     */
    public function toggleVisibility(WebsitePage $page, PageSection $section): JsonResponse
    {
        if ($section->website_page_id !== $page->id) {
            return response()->json(['error' => 'Section does not belong to this page.'], 403);
        }

        $section->update([
            'is_visible' => !$section->is_visible,
        ]);

        return response()->json([
            'success' => true,
            'is_visible' => $section->is_visible,
            'message' => 'Section visibility updated.',
        ]);
    }
}
