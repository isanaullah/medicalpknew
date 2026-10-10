<?php

namespace Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Order;
use App\Models\ChapterNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Get enrollments with course data
        $enrollments = Enrollment::with(['course', 'course.category'])
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->get();

        // Get completed enrollments
        $completedEnrollments = Enrollment::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        // Get enrolled courses count
        $enrolledCount = $enrollments->count();

        // Get recent activity (latest enrollments)
        $recentEnrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get course progress
        $courseProgress = [];
        foreach ($enrollments as $enrollment) {
            $courseProgress[$enrollment->course_id] = [
                'course_id' => $enrollment->course_id,
                'title' => $enrollment->course->title ?? 'Course',
                'progress' => $enrollment->progress ?? 0,
                'status' => $enrollment->status,
            ];
        }

        // Get total notes from enrolled courses
        $courseIds = $enrollments->pluck('course_id')->toArray();
        $totalNotes = ChapterNote::whereHas('chapter.course', function($query) use ($courseIds) {
            $query->whereIn('id', $courseIds);
        })->count();

        // Get stats
        $stats = [
            'enrolled' => $enrolledCount,
            'completed' => $completedEnrollments,
            'notes' => $totalNotes,
            'tests' => 0,
        ];

        return view('student::dashboard.index', compact(
            'user',
            'enrollments',
            'recentEnrollments',
            'courseProgress',
            'stats'
        ));
    }

    /**
     * Display student courses.
     */
    public function courses()
    {
        $user = Auth::user();

        $enrollments = Enrollment::with(['course', 'course.category'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('student::dashboard.courses', compact('enrollments', 'user'));
    }

    /**
     * Display course detail with progress.
     */
    public function courseDetail($id)
    {
        $user = Auth::user();

        $enrollment = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->where('course_id', $id)
            ->firstOrFail();

        $course = $enrollment->course;

        $chapters = $course->chapters()
            ->where('status', 'published')
            ->orderBy('order')
            ->with(['notes' => function($query) {
                $query->where('status', 'published')->orderBy('order');
            }])
            ->get();

        $progress = $enrollment->progress ?? 0;

        return view('student::dashboard.course-detail', compact(
            'course',
            'enrollment',
            'chapters',
            'progress',
            'user'
        ));
    }

    /**
     * Display student notes.
     */
    public function notes()
    {
        $user = Auth::user();

        $courseIds = Enrollment::where('user_id', $user->id)
            ->where('status', 'active')
            ->pluck('course_id')
            ->toArray();

        $notes = ChapterNote::whereHas('chapter.course', function($query) use ($courseIds) {
            $query->whereIn('id', $courseIds);
        })
        ->where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->paginate(12);

        return view('student::dashboard.notes', compact('notes', 'user'));
    }

    /**
     * Display note detail.
     */
    public function noteDetail($id)
    {
        $user = Auth::user();

        $note = ChapterNote::with(['chapter.course'])
            ->where('status', 'published')
            ->findOrFail($id);

        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $note->chapter->course_id)
            ->first();

        if (!$enrollment) {
            abort(403, 'You are not enrolled in this course.');
        }

        return view('student::dashboard.note-detail', compact('note', 'user'));
    }

    /**
     * Display tests page.
     */
    public function tests()
    {
        $user = Auth::user();

        $courseIds = Enrollment::where('user_id', $user->id)
            ->where('status', 'active')
            ->pluck('course_id')
            ->toArray();

        $tests = ChapterNote::whereHas('chapter.course', function($query) use ($courseIds) {
            $query->whereIn('id', $courseIds);
        })
        ->where('type', 'quiz')
        ->where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('student::dashboard.tests', compact('tests', 'user'));
    }

    /**
     * Display settings page.
     */
    public function settings()
    {
        $user = Auth::user();
        return view('student::dashboard.settings', compact('user'));
    }

    /**
     * Update profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        return redirect()->route('student.settings')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Display student orders.
     */
    public function orders()
    {
        $user = Auth::user();

        $orders = Order::with(['items'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('student::dashboard.orders', compact('orders', 'user'));
    }

    /**
     * Display order detail.
     */
    public function orderDetail($id)
    {
        $user = Auth::user();

        $order = Order::with(['items'])
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return view('student::dashboard.order-detail', compact('order', 'user'));
    }

    /**
     * Upload payment proof for order.
     */
    public function uploadPaymentProof(Request $request, $id)
    {
        $user = Auth::user();

        $order = Order::where('user_id', $user->id)
            ->where('order_status', 'pending')
            ->findOrFail($id);

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,pdf|max:5120',
        ]);

        // Delete old proof if exists
        if ($order->payment_proof && Storage::exists('public/payment_proofs/' . $order->payment_proof)) {
            Storage::delete('public/payment_proofs/' . $order->payment_proof);
        }

        // Upload new proof
        $file = $request->file('payment_proof');
        $fileName = time() . '_' . $order->order_number . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/payment_proofs', $fileName);

        $order->update([
            'payment_proof' => $fileName,
            'payment_status' => 'pending', // Wait for admin verification
        ]);

        return redirect()->route('student.order.detail', $order->id)
            ->with('success', 'Payment proof uploaded successfully!');
    }

}
