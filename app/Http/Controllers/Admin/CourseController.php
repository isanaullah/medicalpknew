<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with(['category', 'instructor'])->withCount(['lessons', 'enrollments']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->input('category') !== 'All categories') {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('level') && $request->input('level') !== 'All levels') {
            $query->where('level', $request->input('level'));
        }

        if ($request->filled('type') && $request->input('type') !== 'All types') {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('status') && $request->input('status') !== 'All statuses') {
            $query->where('status', $request->input('status'));
        }

        $sort = $request->input('sort', 'latest');
        if ($sort === 'title') {
            $query->orderBy('title', 'asc');
        } elseif ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $courses = $query->paginate(10)->withQueryString();
        $categories = Category::where('status', 'Active')->orderBy('name')->get();

        $stats = [
            'total' => Course::count(),
            'published' => Course::where('status', 'Published')->count(),
            'draft' => Course::where('status', 'Draft')->count(),
            'paid' => Course::where('type', 'Paid')->count(),
            'free' => Course::where('type', 'Free')->count(),
        ];

        return view('admin.courses.index', compact('courses', 'categories', 'stats'));
    }

    public function create()
    {
        $categories = Category::where('status', 'Active')->orderBy('name')->get();
        $instructors = User::role('Super Admin')->get(); // Admin or users
        return view('admin.courses.create', compact('categories', 'instructors'));
    }

    public function store(CourseRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('courses/thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        // Handle preview video upload
        if ($request->hasFile('preview_video_file')) {
            $videoPath = $request->file('preview_video_file')->store('courses/previews', 'public');
            $data['preview_video_path'] = $videoPath;
        }

        $data['is_featured'] = $request->boolean('is_featured');

        $course = Course::create($data);

        return redirect()->route('admin.courses')->with('success', "Course '{$course->title}' created successfully.");
    }

    public function show(Course $course)
    {
        $course->load(['category', 'instructor', 'lessons.notes', 'lessons.quizzes']);
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::where('status', 'Active')->orderBy('name')->get();
        $instructors = User::role('Super Admin')->get();
        return view('admin.courses.edit', compact('course', 'categories', 'instructors'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle thumbnail replacement or removal
        if ($request->boolean('remove_thumbnail')) {
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = null;
        } elseif ($request->hasFile('thumbnail_file')) {
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $path = $request->file('thumbnail_file')->store('courses/thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        // Handle preview video replacement or removal
        if ($request->boolean('remove_preview_video')) {
            if ($course->preview_video_path && Storage::disk('public')->exists($course->preview_video_path)) {
                Storage::disk('public')->delete($course->preview_video_path);
            }
            $data['preview_video_path'] = null;
            $data['preview_video_url'] = null;
        } elseif ($request->hasFile('preview_video_file')) {
            if ($course->preview_video_path && Storage::disk('public')->exists($course->preview_video_path)) {
                Storage::disk('public')->delete($course->preview_video_path);
            }
            $videoPath = $request->file('preview_video_file')->store('courses/previews', 'public');
            $data['preview_video_path'] = $videoPath;
        }

        $data['is_featured'] = $request->boolean('is_featured');

        $course->update($data);

        return redirect()->route('admin.courses')->with('success', "Course '{$course->title}' updated successfully.");
    }

    public function destroy(Course $course)
    {
        // Delete uploaded files
        if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        if ($course->preview_video_path && Storage::disk('public')->exists($course->preview_video_path)) {
            Storage::disk('public')->delete($course->preview_video_path);
        }

        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'Course deleted successfully.');
    }

    public function togglePublish(Course $course)
    {
        $newStatus = $course->status === 'Published' ? 'Draft' : 'Published';
        $course->update(['status' => $newStatus]);

        return redirect()->back()->with('success', "Course status changed to {$newStatus}.");
    }
}
