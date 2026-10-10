<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\WebSetting;
use App\Models\ChapterNote;
use App\Models\Faqs;
use App\Models\Review;
use App\Models\Enrollment;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use App\Models\YouTubeVideo;

class WebsiteController extends Controller
{

    public function index()
    {
        $featuredCourses = Course::with('category')
            ->where('status', 'active')
            ->take(6)
            ->get();

        $latestBlogs = BlogArticle::with('category')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $courseCategories = CourseCategory::withCount('courses')
            ->where('status', 'active')
            ->get();

        // Get YouTube videos
        $youtubeVideos = YouTubeVideo::where('status', true)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Get FAQs
        $faqs = Faqs::orderBy('created_at', 'asc')->take(05)->get();

        $settings = WebSetting::first();

        if (!$settings) {
            $settings = (object) [
                'site_title' => 'Medical.pk',
                'site_address' => 'Plot 42, Tech Valley, Gulberg III, Lahore, Pakistan',
                'site_phone' => '+92 300 1234567',
                'site_email' => 'support@medical.pk',
                'site_fb' => '#',
                'site_instagram' => '#',
                'site_twitter' => '#',
                'site_linkedn' => '#',
            ];
        }

        return view('frontend.index', compact('featuredCourses', 'latestBlogs', 'settings', 'courseCategories', 'youtubeVideos', 'faqs'));
    }

    public function courses(Request $request)
{
    $query = Course::with('category')->where('status', 'active');

    // Search filter
    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('short_description', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    // Category filter
    if ($request->has('category') && $request->category != 'All') {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('name', $request->category);
        });
    }

    $courses = $query->paginate(12);
    $categories = CourseCategory::where('status', 'active')->get();

    // Get enrolled course IDs for logged-in user
    $enrolledCourseIds = [];
    if (auth()->check()) {
        $enrolledCourseIds = Enrollment::where('user_id', auth()->id())
            ->where('status', 'active')
            ->pluck('course_id')
            ->toArray();
    }

    return view('frontend.courses', compact('courses', 'categories', 'enrolledCourseIds'));
}

public function courseDetail($id)
{
    $course = Course::with(['category', 'chapters' => function($query) {
        $query->where('status', 'published')->orderBy('order')->orderBy('id');
    }, 'chapters.notes' => function($query) {
        $query->orderBy('order')->orderBy('id');
    }])->findOrFail($id);

    // Check if course is free
    $isFree = ($course->price == 0 || $course->price == null);

    // Check if user is enrolled
    $isEnrolled = false;
    if (auth()->check()) {
        $isEnrolled = Enrollment::where('user_id', auth()->id())
            ->where('course_id', $id)
            ->where('status', 'active')
            ->exists();
    }

    // Get reviews
    $reviews = Review::where('course_id', $id)
        ->where('is_approved', true)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    $averageRating = $course->average_rating;
    $totalReviews = $course->reviews_count;
    $ratingDistribution = $this->getRatingDistribution($id);

    $relatedCourses = Course::with('category')
        ->where('status', 'active')
        ->where('course_category_id', $course->course_category_id)
        ->where('id', '!=', $course->id)
        ->take(4)
        ->get();

    return view('frontend.course-details', compact(
        'course',
        'relatedCourses',
        'reviews',
        'averageRating',
        'totalReviews',
        'ratingDistribution',
        'isEnrolled',
        'isFree'
    ));
}

    private function getRatingDistribution($courseId)
    {
        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = Review::where('course_id', $courseId)
                ->where('is_approved', true)
                ->where('rating', $i)
                ->count();
            $distribution[$i] = $count;
        }
        return $distribution;
    }

   public function blog(Request $request)
    {
        $query = BlogArticle::with('category')->where('status', 1);

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('meta_desc', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->has('category') && $request->category != 'All') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('title', $request->category);
            });
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(9);

        // Get featured post (first one)
        $featuredPost = $blogs->first();

        // Get categories for filter
        $categories = BlogCategory::withCount('articles')
            ->where('status', 1)
            ->get();

        // Get popular posts for sidebar
        $popularPosts = BlogArticle::where('status', 1)
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        // Pass ALL variables to view
        return view('frontend.blogs', compact('blogs', 'featuredPost', 'categories', 'popularPosts'));
    }

    public function blogDetail($id)
    {
        $blog = BlogArticle::with('category')->findOrFail($id);

        // Increment views
        $blog->increment('views_count');

        // Get related posts
        $relatedPosts = BlogArticle::with('category')
            ->where('status', 1)
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->take(3)
            ->get();

        // Get popular posts for sidebar
        $popularPosts = BlogArticle::where('status', 1)
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        // Pass ALL variables to view
        return view('frontend.blog-details', compact('blog', 'relatedPosts', 'popularPosts'));
    }

    public function contact()
    {
        $settings = WebSetting::first();
        return view('frontend.contact-us',compact('settings'));
    }

    public function about()
    {
        $settings = WebSetting::first();
        return view('frontend.about-us',compact('settings'));
    }

    public function privacyPolicy()
    {
        $settings = WebSetting::first();
        return view('frontend.privacy-policy',compact('settings'));
    }

    public function terms()
    {
        $settings = WebSetting::first();
        return view('frontend.terms-and-conditions',compact('settings'));
    }
    public function notes(Request $request)
    {
    $query = ChapterNote::with(['chapter.course', 'chapter'])
        ->where('status', 'published');

    // Search filter
    if ($request->has('search') && $request->search != '') {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('excerpt', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
        });
    }

    // Type filter
    if ($request->has('type') && $request->type != 'All') {
        $query->where('type', $request->type);
    }

    $notes = $query->orderBy('created_at', 'desc')->paginate(12);

    // Get all note types for filter
    $noteTypes = ['text', 'pdf', 'video', 'audio', 'quiz', 'assignment'];

    return view('frontend.notes', compact('notes', 'noteTypes'));
    }

    public function notesDetail($id)
    {
        $note = ChapterNote::with(['chapter.course', 'chapter'])
            ->where('status', 'published')
            ->findOrFail($id);

        // Increment views
        $note->increment('views_count');

        // Get related notes from same chapter
        $relatedNotes = ChapterNote::where('course_chapter_id', $note->course_chapter_id)
            ->where('status', 'published')
            ->where('id', '!=', $note->id)
            ->take(4)
            ->get();

        return view('frontend.notes-detail', compact('note', 'relatedNotes'));
    }
}
