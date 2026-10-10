@extends('student::dashboard.layouts.app')

@section('title', 'My Courses')
@section('page_title', 'My Courses')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">My Courses</h1>
    <p class="text-gray-500 text-sm mt-1">All the courses you're enrolled in</p>
</div>

@if($enrollments && $enrollments->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($enrollments as $enrollment)
            <div class="course-card bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br 
                        @if($enrollment->course->category->name == 'MDCAT') from-[#2563EB] to-[#4338CA]
                        @elseif($enrollment->course->category->name == 'NUMS') from-[#059669] to-[#0891B2]
                        @elseif($enrollment->course->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                        @else from-[#2563EB] to-[#4338CA]
                        @endif
                        flex items-center justify-center text-white shrink-0">
                        <i class="fas fa-book text-white text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold text-gray-800 truncate">{{ $enrollment->course->title ?? 'Course' }}</h4>
                        <p class="text-xs text-gray-500">{{ $enrollment->course->chapters->count() ?? 0 }} Chapters</p>
                        <p class="text-xs text-gray-500 mt-0.5">Enrolled: {{ $enrollment->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-gray-500">Progress</span>
                    <span class="font-semibold text-blue-600">{{ $enrollment->progress ?? 0 }}%</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden mb-3">
                    <div class="h-full bg-blue-600 rounded-full" style="width: {{ $enrollment->progress ?? 0 }}%;"></div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('student.course.detail', $enrollment->course_id) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-3 py-2 rounded-lg transition-colors text-center">
                        Continue <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $enrollments->links() }}
    </div>
@else
    <div class="bg-gray-50 rounded-xl p-12 text-center">
        <i class="fas fa-book-open text-gray-300 text-5xl mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">No Courses Enrolled</h3>
        <p class="text-gray-500">You haven't enrolled in any courses yet. Start learning today!</p>
        <a href="{{ route('courses') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-6 py-3 rounded-lg transition-colors">
            Browse Courses
        </a>
    </div>
@endif

@endsection