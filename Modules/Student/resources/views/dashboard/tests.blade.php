@extends('student::dashboard.layouts.app')

@section('title', 'My Tests')
@section('page_title', 'My Tests')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">My Tests</h1>
    <p class="text-gray-500 text-sm mt-1">All quizzes and tests from your enrolled courses</p>
</div>

@if(isset($tests) && $tests->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($tests as $test)
            <div class="test-card bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-question-circle text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-800">{{ $test->title }}</h3>
                        <p class="text-xs text-gray-500">{{ $test->chapter->course->title ?? 'Course' }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $test->chapter->title ?? 'Chapter' }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                    <div class="text-xs text-gray-500">
                        <span><i class="far fa-calendar-alt mr-1"></i> {{ $test->created_at->format('M d, Y') }}</span>
                    </div>
                    <button class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium px-4 py-1.5 rounded-lg transition-colors">
                        Start Quiz <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $tests->links() }}
    </div>
@else
    <div class="bg-gray-50 rounded-xl p-12 text-center">
        <i class="fas fa-tasks text-gray-300 text-5xl mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">No Tests Available</h3>
        <p class="text-gray-500">You don't have any tests yet. Enroll in courses to access quizzes.</p>
        <a href="{{ route('courses') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-6 py-3 rounded-lg transition-colors">
            Browse Courses
        </a>
    </div>
@endif

@endsection
