<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseChapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseChapterController extends Controller
{
    public function index($course_id)
    {
        $course = Course::findOrFail($course_id);
        $chapters = CourseChapter::where('course_id', $course_id)->orderBy('order')->get();
        return view('dashboard.admin.chapters.manage', compact('course', 'chapters'));
    }

    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('dashboard.admin.chapters.create', compact('course'));
    }

    public function store(Request $request, $course_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:1',
            'is_free_preview' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
        ]);

        CourseChapter::create([
            'course_id' => $course_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'video_url' => $request->video_url,
            'order' => $request->order ?? 0,
            'duration_minutes' => $request->duration_minutes,
            'is_free_preview' => $request->has('is_free_preview'),
            'status' => $request->status,
        ]);

        return redirect()->route('chapters.index', $course_id)->with('success', 'Chapter Created Successfully!');
    }

    public function edit($course_id, $id)
    {
        $course = Course::findOrFail($course_id);
        $chapter = CourseChapter::findOrFail($id);
        return view('dashboard.admin.chapters.edit', compact('course', 'chapter'));
    }

    public function update(Request $request, $course_id, $id)
    {
        $chapter = CourseChapter::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'duration_minutes' => 'nullable|integer|min:1',
            'is_free_preview' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
        ]);

        $chapter->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'video_url' => $request->video_url,
            'order' => $request->order ?? 0,
            'duration_minutes' => $request->duration_minutes,
            'is_free_preview' => $request->has('is_free_preview'),
            'status' => $request->status,
        ]);

        return redirect()->route('chapters.index', $course_id)->with('success', 'Chapter Updated Successfully!');
    }

    public function destroy($course_id, $id)
    {
        $chapter = CourseChapter::findOrFail($id);
        $chapter->delete();
        return redirect()->route('chapters.index', $course_id)->with('success', 'Chapter Deleted Successfully!');
    }
}
