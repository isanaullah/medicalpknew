<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonNoteRequest;
use App\Models\Lesson;
use App\Models\LessonNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonNoteController extends Controller
{
    public function index(Lesson $lesson)
    {
        $notes = $lesson->notes()->orderBy('order')->get();
        return view('admin.lesson-notes.index', compact('lesson', 'notes'));
    }

    public function create(Lesson $lesson)
    {
        return view('admin.lessons.notes.create', compact('lesson'));
    }

    public function store(LessonNoteRequest $request)
    {
        $data = $request->validated();
        $lesson = Lesson::findOrFail($data['lesson_id']);

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $path = $file->store('lesson_notes', 'local'); // private storage
            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        if (!isset($data['order']) || $data['order'] === null) {
            $maxOrder = LessonNote::where('lesson_id', $lesson->id)->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        LessonNote::create($data);

        return redirect()->route('admin.lessons.notes.index', $lesson->slug)
            ->with('success', 'PDF note uploaded successfully.');
    }

    public function edit(LessonNote $note)
    {
        $lesson = $note->lesson;
        return view('admin.lessons.notes.edit', compact('note', 'lesson'));
    }

    public function update(LessonNoteRequest $request, LessonNote $note)
    {
        $data = $request->validated();

        if ($request->hasFile('pdf_file')) {
            // Delete old file
            if ($note->file_path && Storage::disk('local')->exists($note->file_path)) {
                Storage::disk('local')->delete($note->file_path);
            }

            $file = $request->file('pdf_file');
            $path = $file->store('lesson_notes', 'local');
            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        $note->update($data);

        return redirect()->route('admin.lessons.notes.index', $note->lesson->slug)
            ->with('success', 'PDF note updated successfully.');
    }

    public function destroy(LessonNote $note)
    {
        $lessonSlug = $note->lesson->slug;

        if ($note->file_path && Storage::disk('local')->exists($note->file_path)) {
            Storage::disk('local')->delete($note->file_path);
        }

        $note->delete();

        return redirect()->route('admin.lessons.notes.index', $lessonSlug)
            ->with('success', 'PDF note deleted successfully.');
    }

    /**
     * Authorized download route.
     * Enforces that student has enrolled entitlement if paid course,
     * or Super Admin role.
     */
    public function download(LessonNote $note)
    {
        $user = auth()->user();
        if (!$user) {
            abort(403, 'Unauthorized access.');
        }

        $course = $note->lesson->course;

        if (!$user->hasAccessToCourse($course)) {
            abort(403, 'You do not have access to download notes for this course. Please enroll or purchase first.');
        }

        if (!Storage::disk('local')->exists($note->file_path)) {
            abort(404, 'File not found in storage.');
        }

        return Storage::disk('local')->download(
            $note->file_path,
            $note->file_name ?? ($note->title . '.pdf'),
            ['Content-Type' => 'application/pdf']
        );
    }
}
