<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogArticle;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogArticleController extends Controller
{
    public function index($id)
    {
        $category = BlogCategory::findOrFail($id);
        $articles = BlogArticle::where('category_id', $id)
            ->with('category')
            ->paginate(10);

        return view('dashboard.admin.blog_article.index', compact('articles', 'category'));
    }

    public function create($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('dashboard.admin.blog_article.add', compact('category'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:blog_articles,title',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $imagePath = 'blog/article/no_img.jpg';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/blog/article', $imageName);
            $imagePath = 'blog/article/' . $imageName;
        }

        BlogArticle::create([
            'category_id' => $id,
            'page_title' => $request->page_title,
            'meta_desc' => $request->meta_desc,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('blog.article.view', $id)
            ->with('success', 'Blog Article Created Successfully!');
    }

    public function edit($id)
    {
        $article = BlogArticle::findOrFail($id);
        $category = BlogCategory::findOrFail($article->category_id);

        return view('dashboard.admin.blog_article.edit', compact('article', 'category'));
    }

    public function update(Request $request, $id)
    {
        $article = BlogArticle::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|string|max:255|unique:blog_articles,title,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $imagePath = $article->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image && $article->image != 'blog/article/no_img.jpg') {
                Storage::delete('public/' . $article->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/blog/article', $imageName);
            $imagePath = 'blog/article/' . $imageName;
        }

        $article->update([
            'page_title' => $request->page_title,
            'meta_desc' => $request->meta_desc,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('blog.article.view', $article->category_id)
            ->with('success', 'Blog Article Updated Successfully!');
    }

    public function destroy($id)
    {
        $article = BlogArticle::findOrFail($id);
        $categoryId = $article->category_id;

        // Delete image
        if ($article->image && $article->image != 'blog/article/no_img.jpg') {
            Storage::delete('public/' . $article->image);
        }

        $article->delete();

        return redirect()->route('blog.article.view', $categoryId)
            ->with('success', 'Blog Article Deleted Successfully!');
    }

    public function updateStatus(Request $request)
    {
        $article = BlogArticle::find($request->article_id);
        if ($article) {
            $article->status = $request->status;
            $article->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function updateApproval(Request $request)
    {
        $article = BlogArticle::find($request->article_id);
        if ($article) {
            $article->approval = $request->approval;
            $article->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
