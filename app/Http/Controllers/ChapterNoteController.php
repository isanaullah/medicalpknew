<?php

namespace App\Http\Controllers;

use App\Models\CourseChapter;
use App\Models\ChapterNote;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ChapterNoteController extends Controller
{
    public function index($chapter_id)
    {
        $chapter = CourseChapter::with('course')->findOrFail($chapter_id);
        $notes = ChapterNote::where('course_chapter_id', $chapter_id)->orderBy('order')->get();
        return view('dashboard.admin.notes.manage', compact('chapter', 'notes'));
    }

    public function create($chapter_id)
    {
        $chapter = CourseChapter::with('course')->findOrFail($chapter_id);
        return view('dashboard.admin.notes.create', compact('chapter'));
    }

    public function store(Request $request, $chapter_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar',
            'video_url' => 'nullable|url',
            'type' => 'required|in:text,pdf,video,audio,quiz,assignment',
            'order' => 'nullable|integer|min:0',
            'is_free_preview' => 'nullable|boolean',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        // Handle featured image
        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $featuredImage = time() . '_featured_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/notes/images', $featuredImage);
        }

        // Handle file upload
        $filePath = null;
        $fileUrl = null;
        $fileSize = null;
        $mimeType = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = time() . '_file_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/notes/files', $filePath);
            $fileUrl = asset('storage/notes/files/' . $filePath);
            $fileSize = $this->formatFileSize($file->getSize());
            $mimeType = $file->getMimeType();
        }

        ChapterNote::create([
            'course_chapter_id' => $chapter_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $featuredImage,
            'file_path' => $filePath,
            'file_url' => $fileUrl,
            'file_size' => $fileSize,
            'mime_type' => $mimeType,
            'video_url' => $request->video_url,
            'video_duration' => $request->video_duration,
            'type' => $request->type,
            'order' => $request->order ?? 0,
            'is_free_preview' => $request->has('is_free_preview'),
            'status' => $request->status,
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('notes.index', $chapter_id)->with('success', 'Note Created Successfully!');
    }

    public function edit($chapter_id, $id)
    {
        $chapter = CourseChapter::with('course')->findOrFail($chapter_id);
        $note = ChapterNote::findOrFail($id);
        return view('dashboard.admin.notes.edit', compact('chapter', 'note'));
    }

    public function update(Request $request, $chapter_id, $id)
    {
        $note = ChapterNote::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar',
            'video_url' => 'nullable|url',
            'type' => 'required|in:text,pdf,video,audio,quiz,assignment',
            'order' => 'nullable|integer|min:0',
            'is_free_preview' => 'nullable|boolean',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        // Handle featured image
        $featuredImage = $note->featured_image;
        if ($request->hasFile('featured_image')) {
            if ($note->featured_image && Storage::exists('public/notes/images/' . $note->featured_image)) {
                Storage::delete('public/notes/images/' . $note->featured_image);
            }
            $image = $request->file('featured_image');
            $featuredImage = time() . '_featured_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/notes/images', $featuredImage);
        }

        // Handle file upload
        $filePath = $note->file_path;
        $fileUrl = $note->file_url;
        $fileSize = $note->file_size;
        $mimeType = $note->mime_type;
        if ($request->hasFile('file')) {
            if ($note->file_path && Storage::exists('public/notes/files/' . $note->file_path)) {
                Storage::delete('public/notes/files/' . $note->file_path);
            }
            $file = $request->file('file');
            $filePath = time() . '_file_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/notes/files', $filePath);
            $fileUrl = asset('storage/notes/files/' . $filePath);
            $fileSize = $this->formatFileSize($file->getSize());
            $mimeType = $file->getMimeType();
        }

        $note->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $featuredImage,
            'file_path' => $filePath,
            'file_url' => $fileUrl,
            'file_size' => $fileSize,
            'mime_type' => $mimeType,
            'video_url' => $request->video_url,
            'video_duration' => $request->video_duration,
            'type' => $request->type,
            'order' => $request->order ?? 0,
            'is_free_preview' => $request->has('is_free_preview'),
            'status' => $request->status,
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('notes.index', $chapter_id)->with('success', 'Note Updated Successfully!');
    }

    public function destroy($chapter_id, $id)
    {
        $note = ChapterNote::findOrFail($id);

        // Delete featured image
        if ($note->featured_image && Storage::exists('public/notes/images/' . $note->featured_image)) {
            Storage::delete('public/notes/images/' . $note->featured_image);
        }

        // Delete file
        if ($note->file_path && Storage::exists('public/notes/files/' . $note->file_path)) {
            Storage::delete('public/notes/files/' . $note->file_path);
        }

        $note->delete();
        return redirect()->route('notes.index', $chapter_id)->with('success', 'Note Deleted Successfully!');
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return '1 byte';
        } else {
            return '0 bytes';
        }
    }
}
