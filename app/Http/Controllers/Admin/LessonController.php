<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function curriculum(Request $request)
    {
        $courses = Course::orderBy('title')->get();
        $selected = $request->input('course_id');
        
        if ($selected) {
            $course = Course::with(['lessons.notes', 'lessons.quizzes.questions'])
                ->where('slug', $selected)
                ->when(is_numeric($selected), fn($q) => $q->orWhere('id', $selected))
                ->first();
        } else {
            $course = $courses->first() ? Course::with(['lessons.notes', 'lessons.quizzes.questions'])->find($courses->first()->id) : null;
        }

        return view('admin.lessons.index', compact('courses', 'course'));
    }

    public function create(Request $request)
    {
        $courseId = $request->input('course_id');
        $course = Course::findOrFail($courseId);
        return view('admin.lessons.create', compact('course'));
    }

    public function store(LessonRequest $request)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if (!isset($data['order']) || $data['order'] === null) {
            $maxOrder = Lesson::where('course_id', $data['course_id'])->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        $data['is_free_preview'] = $request->boolean('is_free_preview');

        $lesson = Lesson::create($data);

        return redirect()->route('admin.curriculum', ['course_id' => $lesson->course_id])
            ->with('success', "Lesson '{$lesson->title}' added successfully.");
    }

    public function edit(Lesson $lesson)
    {
        $course = $lesson->course;
        return view('admin.lessons.edit', compact('lesson', 'course'));
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $data['is_free_preview'] = $request->boolean('is_free_preview');

        $lesson->update($data);

        return redirect()->route('admin.curriculum', ['course_id' => $lesson->course_id])
            ->with('success', "Lesson '{$lesson->title}' updated successfully.");
    }

    public function destroy(Lesson $lesson)
    {
        $courseId = $lesson->course_id;
        $lesson->delete();

        return redirect()->route('admin.curriculum', ['course_id' => $courseId])
            ->with('success', 'Lesson deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:lessons,id',
        ]);

        foreach ($request->input('order') as $index => $lessonId) {
            Lesson::where('id', $lessonId)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
