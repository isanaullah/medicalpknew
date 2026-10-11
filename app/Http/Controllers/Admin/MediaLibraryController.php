<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaLibraryController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::with('uploader');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type') && $request->input('type') !== 'All types') {
            $type = $request->input('type');
            if ($type === 'Images') {
                $query->where('mime_type', 'like', 'image/%');
            } elseif ($type === 'Documents' || $type === 'PDFs') {
                $query->where('mime_type', 'like', '%pdf%');
            } elseif ($type === 'Videos') {
                $query->where('mime_type', 'like', 'video/%');
            }
        }

        $mediaItems = $query->latest()->paginate(12)->withQueryString();

        return view('admin.media-library.index', compact('mediaItems'));
    }

    public function store(MediaRequest $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();
        $fileSize = $file->getSize();

        $path = $file->store('media', 'public');

        Media::create([
            'name' => $fileName,
            'file_path' => $path,
            'mime_type' => $mimeType,
            'file_size' => $fileSize,
            'alt_text' => $request->input('alt_text', pathinfo($fileName, PATHINFO_FILENAME)),
            'title' => $request->input('title', pathinfo($fileName, PATHINFO_FILENAME)),
            'description' => $request->input('description'),
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('admin.media')->with('success', 'File uploaded successfully.');
    }

    public function destroy(Media $media)
    {
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return redirect()->route('admin.media')->with('success', 'File deleted successfully.');
    }
}
