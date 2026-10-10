@extends('student::dashboard.layouts.app')

@section('title', 'My Notes')
@section('page_title', 'My Notes')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">My Notes</h1>
    <p class="text-gray-500 text-sm mt-1">All notes from your enrolled courses</p>
</div>

@if($notes && $notes->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($notes as $note)
            <a href="{{ route('student.note.detail', $note->id) }}" class="note-card bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md hover:border-blue-400 transition-all group">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-lg
                        @if($note->type == 'video') bg-red-50 text-red-600
                        @elseif($note->type == 'pdf') bg-orange-50 text-orange-600
                        @elseif($note->type == 'quiz') bg-purple-50 text-purple-600
                        @elseif($note->type == 'audio') bg-green-50 text-green-600
                        @else bg-blue-50 text-blue-600
                        @endif
                        flex items-center justify-center shrink-0">
                        <i class="fas
                            @if($note->type == 'video') fa-video
                            @elseif($note->type == 'pdf') fa-file-pdf
                            @elseif($note->type == 'quiz') fa-question-circle
                            @elseif($note->type == 'audio') fa-music
                            @else fa-file-alt
                            @endif
                        text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors truncate">{{ $note->title }}</p>
                        <div class="flex items-center gap-2 mt-1 flex-wrap">
                            <span class="text-xs text-gray-500">{{ ucfirst($note->type) }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-500">{{ $note->chapter->course->title ?? 'Course' }}</span>
                        </div>
                        @if($note->excerpt)
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ Str::limit($note->excerpt, 80) }}</p>
                        @endif
                    </div>
                    <i class="fas fa-arrow-right text-gray-300 group-hover:text-blue-500 transition-colors"></i>
                </div>
                <div class="flex items-center gap-3 mt-3 pt-3 border-t border-gray-100 text-xs text-gray-400">
                    <span><i class="far fa-eye mr-1"></i> {{ $note->views_count ?? 0 }}</span>
                    @if($note->file_path)
                        <span><i class="fas fa-download mr-1"></i> {{ $note->downloads_count ?? 0 }}</span>
                    @endif
                    <span><i class="far fa-calendar-alt mr-1"></i> {{ $note->created_at->format('M d, Y') }}</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $notes->links() }}
    </div>
@else
    <div class="bg-gray-50 rounded-xl p-12 text-center">
        <i class="fas fa-sticky-note text-gray-300 text-5xl mb-4"></i>
        <h3 class="text-xl font-bold text-gray-800 mb-2">No Notes Available</h3>
        <p class="text-gray-500">You don't have any notes yet. Enroll in courses to access notes.</p>
        <a href="{{ route('courses') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-6 py-3 rounded-lg transition-colors">
            Browse Courses
        </a>
    </div>
@endif

@endsection
