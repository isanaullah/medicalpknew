<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('category')->get();
        return view('dashboard.admin.courses.manage', compact('courses'));
    }

    public function create()
    {
        $categories = CourseCategory::where('status', 'active')->get();
        return view('dashboard.admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_category_id' => 'required|exists:course_categories,id',
            'title' => 'required|string|max:255|unique:courses,title',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'nullable|integer|min:0',
            'discount_price' => 'nullable|integer|min:0|lt:price',
            'duration_minutes' => 'nullable|integer|min:1',
            'level' => 'required|in:beginner,intermediate,expert',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/courses', $imageName);
        }

        Course::create([
            'course_category_id' => $request->course_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $imageName,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'duration_minutes' => $request->duration_minutes,
            'level' => $request->level,
            'status' => $request->status,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course Created Successfully!');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = CourseCategory::where('status', 'active')->get();
        return view('dashboard.admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'course_category_id' => 'required|exists:course_categories,id',
            'title' => 'required|string|max:255|unique:courses,title,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'price' => 'nullable|integer|min:0',
            'discount_price' => 'nullable|integer|min:0|lt:price',
            'duration_minutes' => 'nullable|integer|min:1',
            'level' => 'required|in:beginner,intermediate,expert',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle image upload
        $imageName = $course->image;
        if ($request->hasFile('image')) {
            if ($course->image && Storage::exists('public/courses/' . $course->image)) {
                Storage::delete('public/courses/' . $course->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/courses', $imageName);
        }

        $course->update([
            'course_category_id' => $request->course_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $imageName,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'duration_minutes' => $request->duration_minutes,
            'level' => $request->level,
            'status' => $request->status,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course Updated Successfully!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Delete image
        if ($course->image && Storage::exists('public/courses/' . $course->image)) {
            Storage::delete('public/courses/' . $course->image);
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course Deleted Successfully!');
    }
}
