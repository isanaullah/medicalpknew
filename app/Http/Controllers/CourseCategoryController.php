<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = CourseCategory::withCount('courses')->get();
        return view('dashboard.admin.course-categories.manage', compact('categories'));
    }

    // Show the create category form
    public function create()
    {
        return view('dashboard.admin.course-categories.create');
    }

    // Store the new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_categories,name',
            'icon' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        CourseCategory::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'icon' => $request->input('icon'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('course-categories.index')->with('success', 'Category Created Successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $category = CourseCategory::findOrFail($id);
        return view('dashboard.admin.course-categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = CourseCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:course_categories,name,' . $id,
            'icon' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'icon' => $request->input('icon'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('course-categories.index')->with('success', 'Category Updated Successfully!');
    }

    // Delete category
    public function destroy($id)
    {
        $category = CourseCategory::findOrFail($id);

        // Check if category has courses
        if ($category->courses()->count() > 0) {
            return redirect()->route('course-categories.index')->with('error', 'Cannot delete category with existing courses!');
        }

        $category->delete();
        return redirect()->route('course-categories.index')->with('success', 'Category Deleted Successfully!');
    }
}
