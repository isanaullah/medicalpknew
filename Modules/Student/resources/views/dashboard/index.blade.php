@extends('student::dashboard.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<!-- Welcome Section -->
<div class="mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Good {{ now()->format('a') == 'am' ? 'Morning' : 'Evening' }}, {{ Auth::user()->name ?? 'Student' }}! 👋</h1>
    <p class="text-gray-500 text-sm mt-1">Here's what's happening with your learning journey today.</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
    <div class="stat-card bg-white rounded-xl p-4 md:p-5 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Enrolled</p>
                <p class="text-2xl md:text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['enrolled'] }}</p>
                <p class="text-xs text-green-600 mt-1">
                    <i class="fas fa-arrow-up"></i> {{ $stats['enrolled'] > 0 ? 'Active courses' : 'Start learning!' }}
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                <i class="fas fa-book-open text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white rounded-xl p-4 md:p-5 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Completed</p>
                <p class="text-2xl md:text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['completed'] }}</p>
                <p class="text-xs text-green-600 mt-1">
                    <i class="fas fa-arrow-up"></i> 
                    {{ $stats['enrolled'] > 0 ? round(($stats['completed'] / $stats['enrolled']) * 100) . '% complete' : '0% complete' }}
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white rounded-xl p-4 md:p-5 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Notes</p>
                <p class="text-2xl md:text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['notes'] }}</p>
                <p class="text-xs text-blue-600 mt-1">
                    <i class="fas fa-arrow-up"></i> Available to read
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                <i class="fas fa-sticky-note text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="stat-card bg-white rounded-xl p-4 md:p-5 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Tests Taken</p>
                <p class="text-2xl md:text-3xl font-extrabold text-gray-800 mt-1">{{ $stats['tests'] }}</p>
                <p class="text-xs text-orange-600 mt-1">
                    <i class="fas fa-arrow-up"></i> Keep practicing!
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center">
                <i class="fas fa-tasks text-orange-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Continue Learning -->
@if($enrollments && $enrollments->count() > 0)
    @php
        $firstEnrollment = $enrollments->first();
        $firstCourse = $firstEnrollment->course;
    @endphp
    <div class="bg-white rounded-xl border border-gray-200 p-4 md:p-6 mb-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-start md:items-center justify-between flex-col md:flex-row gap-4">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center text-white text-2xl font-bold shrink-0">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                        <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-1 rounded">{{ $firstCourse->category->name ?? 'Course' }}</span>
                        <span class="text-xs text-gray-400">•</span>
                        <span class="text-xs text-gray-500">{{ $firstCourse->chapters->count() ?? 0 }} Chapters</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">{{ $firstCourse->title ?? 'No Course' }}</h3>
                    <p class="text-sm text-gray-500">Progress: {{ $firstEnrollment->progress ?? 0 }}%</p>
                </div>
            </div>
            <div class="w-full md:w-48">
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-500">Progress</span>
                    <span class="font-semibold text-blue-600">{{ $firstEnrollment->progress ?? 0 }}%</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-600 rounded-full progress-bar" style="width: {{ $firstEnrollment->progress ?? 0 }}%;"></div>
                </div>
                <a href="{{ route('student.course.detail', $firstCourse->id) }}" class="block w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-4 py-2 rounded-lg transition-colors text-center">
                    Continue Learning <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
@endif

<!-- My Courses & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- My Courses -->
    <div class="lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-800">My Courses</h2>
            <a href="{{ route('student.courses') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All <i class="fas fa-arrow-right ml-1"></i></a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($enrollments->take(4) as $enrollment)
                <div class="course-card bg-white rounded-xl border border-gray-200 p-4 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br 
                            @if($enrollment->course->category->name == 'MDCAT') from-[#2563EB] to-[#4338CA]
                            @elseif($enrollment->course->category->name == 'NUMS') from-[#059669] to-[#0891B2]
                            @elseif($enrollment->course->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                            @else from-[#2563EB] to-[#4338CA]
                            @endif
                            flex items-center justify-center text-white shrink-0">
                            <i class="fas fa-book text-white text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $enrollment->course->title ?? 'Course' }}</h4>
                            <p class="text-xs text-gray-500">{{ $enrollment->course->chapters->count() ?? 0 }} Chapters</p>
                        </div>
                    </div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-500">Progress</span>
                        <span class="font-semibold text-blue-600">{{ $enrollment->progress ?? 0 }}%</span>
                    </div>
                    <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden mb-3">
                        <div class="h-full bg-blue-600 rounded-full" style="width: {{ $enrollment->progress ?? 0 }}%;"></div>
                    </div>
                    <a href="{{ route('student.course.detail', $enrollment->course_id) }}" class="block w-full bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium text-sm px-3 py-2 rounded-lg transition-colors text-center">
                        Open Course <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            @empty
                <div class="col-span-2 bg-gray-50 rounded-xl p-8 text-center">
                    <i class="fas fa-book-open text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500">You haven't enrolled in any courses yet.</p>
                    <a href="{{ route('courses') }}" class="inline-block mt-3 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-4 py-2 rounded-lg transition-colors">
                        Browse Courses
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Activity -->
    <div>
        <h2 class="text-lg font-bold text-gray-800 mb-4">Recent Activity</h2>

        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            @if($recentEnrollments && $recentEnrollments->count() > 0)
                <div class="space-y-4">
                    @foreach($recentEnrollments as $enrollment)
                        <div class="activity-item flex items-start gap-3 pb-3 border-b border-gray-100 last:border-0">
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0 mt-0.5">
                                <i class="fas fa-check text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate">Enrolled in {{ $enrollment->course->title ?? 'Course' }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $enrollment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-clock text-gray-300 text-2xl mb-2"></i>
                    <p class="text-gray-500 text-sm">No recent activity</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection