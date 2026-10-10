<?php

namespace App\Http\Controllers;

use App\Models\YouTubeVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class YouTubeVideoController extends Controller
{
    /**
     * Display a listing of the videos.
     */
    public function index()
    {
        $videos = YouTubeVideo::orderBy('order', 'asc')->paginate(10);
        return view('dashboard.admin.youtube.index', compact('videos'));
    }

    /**
     * Show the form for creating a new video.
     */
    public function create()
    {
        return view('dashboard.admin.youtube.create');
    }

    /**
     * Store a newly created video in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'subject' => 'nullable|string|max:255',
            'views' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        // Create new video instance
        $video = new YouTubeVideo();
        $video->title = $request->title;
        $video->slug = Str::slug($request->title) . '-' . time();
        $video->video_url = $request->video_url;
        $video->video_id = $video->extractVideoId($request->video_url);
        $video->subject = $request->subject;
        $video->views = $request->views;
        $video->order = $request->order ?? 0;
        $video->is_featured = $request->has('is_featured');
        $video->status = $request->has('status');

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/youtube', $imageName);
            $video->thumbnail = $imageName;
        }

        $video->save();

        return redirect()->route('youtube.index')
            ->with('success', 'YouTube Video Added Successfully!');
    }

    /**
     * Show the form for editing the specified video.
     */
    public function edit($id)
    {
        $video = YouTubeVideo::findOrFail($id);
        return view('dashboard.admin.youtube.edit', compact('video'));
    }

    /**
     * Update the specified video in storage.
     */
    public function update(Request $request, $id)
    {
        $video = YouTubeVideo::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'subject' => 'nullable|string|max:255',
            'views' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $video->title = $request->title;
        $video->slug = Str::slug($request->title) . '-' . time();
        $video->video_url = $request->video_url;
        $video->video_id = $video->extractVideoId($request->video_url);
        $video->subject = $request->subject;
        $video->views = $request->views;
        $video->order = $request->order ?? 0;
        $video->is_featured = $request->has('is_featured');
        $video->status = $request->has('status');

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail && Storage::exists('public/youtube/' . $video->thumbnail)) {
                Storage::delete('public/youtube/' . $video->thumbnail);
            }
            $image = $request->file('thumbnail');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/youtube', $imageName);
            $video->thumbnail = $imageName;
        }

        $video->save();

        return redirect()->route('youtube.index')
            ->with('success', 'YouTube Video Updated Successfully!');
    }

    /**
     * Remove the specified video from storage.
     */
    public function destroy($id)
    {
        $video = YouTubeVideo::findOrFail($id);

        // Delete thumbnail
        if ($video->thumbnail && Storage::exists('public/youtube/' . $video->thumbnail)) {
            Storage::delete('public/youtube/' . $video->thumbnail);
        }

        $video->delete();

        return redirect()->route('youtube.index')
            ->with('success', 'YouTube Video Deleted Successfully!');
    }

    /**
     * Update video status via AJAX
     */
    public function updateStatus(Request $request)
    {
        $video = YouTubeVideo::find($request->video_id);
        if ($video) {
            $video->status = $request->status;
            $video->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Video not found!']);
    }

    /**
     * Update featured status via AJAX
     */
    public function updateFeatured(Request $request)
    {
        $video = YouTubeVideo::find($request->video_id);
        if ($video) {
            $video->is_featured = $request->is_featured;
            $video->save();
            return response()->json(['success' => true, 'message' => 'Featured status updated successfully!']);
        }
        return response()->json(['success' => false, 'message' => 'Video not found!']);
    }
}
