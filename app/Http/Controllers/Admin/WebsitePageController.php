<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebsitePageRequest;
use App\Models\WebsitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebsitePageController extends Controller
{
    public function index(Request $request)
    {
        $query = WebsitePage::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->input('status') !== 'All statuses') {
            $query->where('status', $request->input('status'));
        }

        $pages = $query->latest()->paginate(10)->withQueryString();

        return view('admin.website-pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(WebsitePageRequest $request)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        WebsitePage::create($data);

        return redirect()->route('admin.pages')->with('success', 'Page created successfully.');
    }

    public function edit(WebsitePage $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(WebsitePageRequest $request, WebsitePage $page)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $page->update($data);

        return redirect()->route('admin.pages')->with('success', 'Page updated successfully.');
    }

    public function destroy(WebsitePage $page)
    {
        $page->delete();

        return redirect()->route('admin.pages')->with('success', 'Page deleted successfully.');
    }
}
