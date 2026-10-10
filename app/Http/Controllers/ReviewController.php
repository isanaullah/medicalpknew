<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Course;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['course', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('dashboard.admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $courses = Course::where('status', 'active')->get();
        return view('dashboard.admin.reviews.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'title' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_approved' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        Review::create([
            'course_id' => $request->course_id,
            'user_id' => auth()->id() ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'review' => $request->review,
            'rating' => $request->rating,
            'is_approved' => $request->has('is_approved'),
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('reviews.index')
            ->with('success', 'Review Added Successfully!');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $courses = Course::where('status', 'active')->get();
        return view('dashboard.admin.reviews.edit', compact('review', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'title' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_approved' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $review->update([
            'course_id' => $request->course_id,
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'review' => $request->review,
            'rating' => $request->rating,
            'is_approved' => $request->has('is_approved'),
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('reviews.index')
            ->with('success', 'Review Updated Successfully!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')
            ->with('success', 'Review Deleted Successfully!');
    }

    public function updateStatus(Request $request)
    {
        $review = Review::find($request->review_id);
        if ($review) {
            $review->is_approved = $request->is_approved;
            $review->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function updateFeatured(Request $request)
    {
        $review = Review::find($request->review_id);
        if ($review) {
            $review->is_featured = $request->is_featured;
            $review->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    public function frontendStore(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'title' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'course_id' => $request->course_id,
            'user_id' => auth()->id() ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'review' => $request->review,
            'rating' => $request->rating,
            'is_approved' => true,
            'is_featured' => false,
        ]);

        return redirect()->back()->with('review_success', 'Review submitted! It will appear after admin approval.');
    }
}