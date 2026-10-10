<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('articles')->paginate(10);
        return view('dashboard.admin.blog_category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.admin.blog_category.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:blog_categories,title',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Handle image upload
        $imagePath = 'blog/category/no_img.jpg';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/blog/category', $imageName);
            $imagePath = 'blog/category/' . $imageName;
        }

        BlogCategory::create([
            'page_title' => $request->page_title,
            'meta_desc' => $request->meta_desc,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('blog.category.view')
            ->with('success', 'Blog Category Created Successfully!');
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('dashboard.admin.blog_category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|string|max:255|unique:blog_categories,title,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image && $category->image != 'blog/category/no_img.jpg') {
                Storage::delete('public/' . $category->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/blog/category', $imageName);
            $imagePath = 'blog/category/' . $imageName;
        }

        $category->update([
            'page_title' => $request->page_title,
            'meta_desc' => $request->meta_desc,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('blog.category.view')
            ->with('success', 'Blog Category Updated Successfully!');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);

        // Delete image
        if ($category->image && $category->image != 'blog/category/no_img.jpg') {
            Storage::delete('public/' . $category->image);
        }

        $category->delete();

        return redirect()->route('blog.category.view')
            ->with('success', 'Blog Category Deleted Successfully!');
    }

    public function updateStatus(Request $request)
    {
        $category = BlogCategory::find($request->blog_category_id);
        if ($category) {
            $category->status = $request->status;
            $category->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function updateApproval(Request $request)
    {
        $category = BlogCategory::find($request->blog_category_id);
        if ($category) {
            $category->approval = $request->approval;
            $category->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
