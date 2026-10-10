<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of enrollments.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = [
            'total' => Enrollment::count(),
            'active' => Enrollment::where('status', 'active')->count(),
            'completed' => Enrollment::where('status', 'completed')->count(),
            'cancelled' => Enrollment::where('status', 'cancelled')->count(),
        ];

        return view('dashboard.admin.enrollments.index', compact('enrollments', 'stats'));
    }

    /**
     * Show the form for creating a new enrollment.
     */
    public function create()
    {
        $users = User::where('status', 1)->orderBy('name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();

        return view('dashboard.admin.enrollments.create', compact('users', 'courses'));
    }

    /**
     * Store multiple enrollments.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_ids' => 'required|array|min:1',
            'course_ids.*' => 'exists:courses,id',
            'status' => 'required|in:active,completed,cancelled,expired',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $user = User::findOrFail($request->user_id);
        $courseIds = $request->course_ids;
        $successCount = 0;
        $failedCount = 0;

        foreach ($courseIds as $courseId) {
            // Check if already enrolled
            $existing = Enrollment::where('user_id', $user->id)
                ->where('course_id', $courseId)
                ->first();

            if ($existing) {
                $failedCount++;
                continue;
            }

            // Generate enrollment number
            $enrollmentNumber = 'ENR-' . strtoupper(uniqid());

            Enrollment::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
                'order_id' => null,
                'enrollment_number' => $enrollmentNumber,
                'status' => $request->status,
                'progress' => 0,
                'enrolled_at' => now(),
                'expires_at' => $request->expires_at,
            ]);

            $successCount++;
        }

        $message = $successCount . ' course(s) enrolled successfully!';
        if ($failedCount > 0) {
            $message .= ' ' . $failedCount . ' course(s) skipped (already enrolled).';
        }

        return redirect()->route('enrollments.index')
            ->with('success', $message);
    }

    /**
     * Display the specified enrollment.
     */
    public function show($id)
    {
        $enrollment = Enrollment::with(['user', 'course', 'order'])
            ->findOrFail($id);

        return view('dashboard.admin.enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified enrollment.
     */
    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $users = User::where('status', 1)->orderBy('name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();

        return view('dashboard.admin.enrollments.edit', compact('enrollment', 'users', 'courses'));
    }

    /**
     * Update the specified enrollment in storage.
     */
    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:active,completed,cancelled,expired',
            'progress' => 'nullable|integer|min:0|max:100',
            'expires_at' => 'nullable|date|after:now',
        ]);

        // Check if another enrollment exists with same user and course
        $existing = Enrollment::where('user_id', $request->user_id)
            ->where('course_id', $request->course_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existing) {
            return back()->with('error', 'This user is already enrolled in this course!');
        }

        $enrollment->update([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'status' => $request->status,
            'progress' => $request->progress ?? 0,
            'expires_at' => $request->expires_at,
            'completed_at' => $request->status == 'completed' ? now() : null,
        ]);

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment updated successfully!');
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully!');
    }

    /**
     * Update enrollment status via AJAX.
     */
    public function updateStatus(Request $request)
    {
        $enrollment = Enrollment::findOrFail($request->enrollment_id);
        $enrollment->status = $request->status;

        if ($request->status == 'completed') {
            $enrollment->completed_at = now();
        }

        $enrollment->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }

    /**
     * Get courses for a user (AJAX).
     */
    public function getUserCourses($userId)
    {
        $enrolledCourseIds = Enrollment::where('user_id', $userId)
            ->pluck('course_id')
            ->toArray();

        $availableCourses = Course::where('status', 'active')
            ->whereNotIn('id', $enrolledCourseIds)
            ->get(['id', 'title']);

        return response()->json($availableCourses);
    }

    /**
     * Get enrolled courses for a user (AJAX).
     */
    public function getEnrolledCourses($userId)
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', $userId)
            ->get();

        return response()->json($enrollments);
    }

    /**
     * Bulk enrollment form.
     */
    public function bulkEnroll()
    {
        $users = User::where('status', 1)->orderBy('name')->get();
        $courses = Course::where('status', 'active')->orderBy('title')->get();

        return view('dashboard.admin.enrollments.bulk', compact('users', 'courses'));
    }

    /**
     * Process bulk enrollment.
     */
    public function bulkStore(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
            'course_ids' => 'required|array|min:1',
            'course_ids.*' => 'exists:courses,id',
            'status' => 'required|in:active,completed,cancelled,expired',
        ]);

        $userIds = $request->user_ids;
        $courseIds = $request->course_ids;
        $successCount = 0;
        $failedCount = 0;

        foreach ($userIds as $userId) {
            foreach ($courseIds as $courseId) {
                // Check if already enrolled
                $existing = Enrollment::where('user_id', $userId)
                    ->where('course_id', $courseId)
                    ->first();

                if ($existing) {
                    $failedCount++;
                    continue;
                }

                $user = User::find($userId);
                $enrollmentNumber = 'ENR-' . strtoupper(uniqid());

                Enrollment::create([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'order_id' => null,
                    'enrollment_number' => $enrollmentNumber,
                    'status' => $request->status,
                    'progress' => 0,
                    'enrolled_at' => now(),
                ]);

                $successCount++;
            }
        }

        $message = $successCount . ' enrollment(s) created successfully!';
        if ($failedCount > 0) {
            $message .= ' ' . $failedCount . ' enrollment(s) skipped (already exists).';
        }

        return redirect()->route('enrollments.index')
            ->with('success', $message);
    }
    public function enrollFree($courseId)
    {
        $user = Auth::user();
        $course = Course::findOrFail($courseId);

        // Check if course is free
        if ($course->price > 0) {
            return redirect()->back()->with('error', 'This course is not free. Please purchase it.');
        }

        // Check if already enrolled
        $existing = Enrollment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'You are already enrolled in this course.');
        }

        // Create enrollment
        $enrollmentNumber = 'ENR-' . strtoupper(uniqid());

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'enrollment_number' => $enrollmentNumber,
            'status' => 'active',
            'progress' => 0,
            'enrolled_at' => now(),
        ]);

        return redirect()->route('courses.detail', $courseId)
            ->with('success', 'You have successfully enrolled in this course!');
    }

    /**
     * Enroll user via cart/order (for paid courses)
     */
    public function enrollPaid($orderId)
    {
        // This will be handled by the order system
        // The enrollment is created when order is placed
    }
}
