<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogArticleRequest;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogArticle::with(['category', 'author']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'All categories') {
            $query->where('blog_category_id', $request->input('category'));
        }

        if ($request->filled('status') && $request->input('status') !== 'All statuses') {
            $query->where('status', $request->input('status'));
        }

        $articles = $query->latest()->paginate(10)->withQueryString();
        $categories = BlogCategory::where('status', 'Active')->orderBy('name')->get();

        return view('admin.blogs.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status', 'Active')->orderBy('name')->get();
        $authors = User::role('Super Admin')->get();
        return view('admin.blogs.create', compact('categories', 'authors'));
    }

    public function store(BlogArticleRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('blog', 'public');
            $data['featured_image'] = $path;
        }

        if (empty($data['author_id'])) {
            $data['author_id'] = auth()->id();
        }

        if ($data['status'] === 'Published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        BlogArticle::create($data);

        return redirect()->route('admin.blog')->with('success', 'Article created successfully.');
    }

    public function edit(BlogArticle $blog)
    {
        $categories = BlogCategory::where('status', 'Active')->orderBy('name')->get();
        $authors = User::role('Super Admin')->get();
        return view('admin.blogs.edit', compact('blog', 'categories', 'authors'));
    }

    public function update(BlogArticleRequest $request, BlogArticle $blog)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('image_file')) {
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $path = $request->file('image_file')->store('blog', 'public');
            $data['featured_image'] = $path;
        }

        if ($data['status'] === 'Published' && empty($blog->published_at) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $blog->update($data);

        return redirect()->route('admin.blog')->with('success', 'Article updated successfully.');
    }

    public function destroy(BlogArticle $blog)
    {
        if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blog')->with('success', 'Article deleted successfully.');
    }
}
