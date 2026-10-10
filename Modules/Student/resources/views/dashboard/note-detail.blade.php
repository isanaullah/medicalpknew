@extends('student::dashboard.layouts.app')

@section('title', $note->title)
@section('page_title', $note->title)

@section('content')

<div class="mb-4">
    <a href="{{ route('student.course.detail', $note->chapter->course_id) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors">
        <i class="fas fa-arrow-left mr-1"></i> Back to Course
    </a>
</div>

<!-- Note Content -->
<div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
    <!-- Header -->
    <div class="flex items-start gap-4 mb-4">
        <div class="w-14 h-14 rounded-lg
            @if($note->type == 'video') bg-red-50 text-red-600
            @elseif($note->type == 'pdf') bg-orange-50 text-orange-600
            @elseif($note->type == 'quiz') bg-purple-50 text-purple-600
            @elseif($note->type == 'audio') bg-green-50 text-green-600
            @elseif($note->type == 'assignment') bg-indigo-50 text-indigo-600
            @else bg-blue-50 text-blue-600
            @endif
            flex items-center justify-center shrink-0">
            <i class="fas text-2xl
                @if($note->type == 'video') fa-video
                @elseif($note->type == 'pdf') fa-file-pdf
                @elseif($note->type == 'quiz') fa-question-circle
                @elseif($note->type == 'audio') fa-music
                @elseif($note->type == 'assignment') fa-tasks
                @else fa-file-alt
                @endif
            "></i>
        </div>
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800">{{ $note->title }}</h1>
            <div class="flex items-center gap-3 mt-1 flex-wrap">
                <span class="text-sm text-gray-500">{{ $note->chapter->title ?? 'Chapter' }}</span>
                <span class="text-xs text-gray-400">•</span>
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded">{{ ucfirst($note->type) }}</span>
                @if($note->is_free_preview)
                    <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded">Free Preview</span>
                @endif
                @if($note->status == 'published')
                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded">Published</span>
                @endif
                @if($note->video_url)
                    <span class="text-xs bg-red-50 text-red-600 px-2 py-0.5 rounded">
                        <i class="fas fa-video mr-1"></i> Video Available
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    @if($note->featured_image)
        <div class="mb-6 rounded-lg overflow-hidden border border-gray-200">
            <img src="{{ asset('storage/notes/images/' . $note->featured_image) }}"
                 alt="{{ $note->title }}"
                 class="w-full h-auto max-h-96 object-cover">
        </div>
    @endif

    <!-- Excerpt -->
    @if($note->excerpt)
        <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
            <p class="text-sm text-gray-600 italic">{{ $note->excerpt }}</p>
        </div>
    @endif

    <!-- ============================================ -->
    <!-- VIDEO URL - Show if exists (for any type)    -->
    <!-- ============================================ -->
    @if($note->video_url)
        <div class="mb-6">
            <div class="aspect-w-16 aspect-h-9 bg-gray-900 rounded-lg overflow-hidden">
                @php
                    // Convert YouTube URL to embed URL
                    $videoUrl = $note->video_url;

                    // Check if it's a YouTube URL
                    if (strpos($videoUrl, 'youtube.com/watch?v=') !== false) {
                        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                        $videoId = $query['v'] ?? null;
                        if ($videoId) {
                            $videoUrl = 'https://www.youtube.com/embed/' . $videoId . '?rel=0&modestbranding=1&iv_load_policy=3';
                        }
                    } elseif (strpos($videoUrl, 'youtu.be/') !== false) {
                        $videoId = substr($videoUrl, strpos($videoUrl, 'youtu.be/') + 9);
                        $videoId = explode('?', $videoId)[0];
                        $videoUrl = 'https://www.youtube.com/embed/' . $videoId . '?rel=0&modestbranding=1&iv_load_policy=3';
                    } elseif (strpos($videoUrl, 'vimeo.com/') !== false) {
                        $videoId = substr($videoUrl, strpos($videoUrl, 'vimeo.com/') + 10);
                        $videoUrl = 'https://player.vimeo.com/video/' . $videoId;
                    }
                @endphp
                <iframe src="{{ $videoUrl }}"
                        class="w-full h-full"
                        frameborder="0"
                        allowfullscreen
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                </iframe>
            </div>
            @if($note->video_duration)
                <p class="text-sm text-gray-500 mt-2"><i class="fas fa-clock mr-1"></i> Duration: {{ $note->video_duration }}</p>
            @endif
            <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-link mr-1"></i>
                <a href="{{ $note->video_url }}" target="_blank" class="text-blue-600 hover:underline">Watch on Original Platform</a>
            </p>
        </div>
    @endif

    <!-- ============================================ -->
    <!-- CONTENT BASED ON TYPE                        -->
    <!-- ============================================ -->

    <!-- 1. PDF TYPE -->
    @if($note->type == 'pdf' && $note->file_path)
        <div class="bg-gray-50 rounded-lg p-6 text-center border border-gray-200 mb-6">
            <i class="fas fa-file-pdf text-red-500 text-5xl mb-3"></i>
            <h4 class="font-semibold text-gray-800 mb-1">{{ $note->title }}</h4>
            <p class="text-sm text-gray-600 mb-3">
                @if($note->file_size)
                    File size: {{ $note->file_size }}
                @else
                    PDF Document
                @endif
            </p>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                   target="_blank"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg transition-colors inline-flex items-center">
                    <i class="fas fa-eye mr-2"></i> View PDF
                </a>
                <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                   download
                   class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-lg transition-colors inline-flex items-center">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </a>
            </div>
        </div>
    @endif

    <!-- 2. AUDIO TYPE -->
    @if($note->type == 'audio' && $note->file_path)
        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 mb-6">
            <div class="text-center mb-4">
                <i class="fas fa-music text-green-500 text-4xl mb-2"></i>
                <h4 class="font-semibold text-gray-800">{{ $note->title }}</h4>
                @if($note->file_size)
                    <p class="text-sm text-gray-500">File size: {{ $note->file_size }}</p>
                @endif
            </div>
            <audio controls class="w-full">
                <source src="{{ asset('storage/notes/files/' . $note->file_path) }}" type="{{ $note->mime_type ?? 'audio/mpeg' }}">
                Your browser does not support the audio element.
            </audio>
            <div class="text-center mt-3">
                <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                   download
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition-colors inline-flex items-center">
                    <i class="fas fa-download mr-2"></i> Download Audio
                </a>
            </div>
        </div>
    @endif

    <!-- 3. QUIZ TYPE -->
    @if($note->type == 'quiz')
        <div class="bg-purple-50 rounded-lg p-6 text-center border border-purple-200 mb-6">
            <div class="w-20 h-20 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-question-circle text-purple-500 text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Interactive Quiz</h3>
            <p class="text-sm text-gray-600 mb-3">Test your knowledge with this quiz</p>
            @if($note->excerpt)
                <p class="text-sm text-gray-500 mb-4">{{ $note->excerpt }}</p>
            @endif
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-8 py-3 rounded-lg transition-colors inline-flex items-center">
                <i class="fas fa-play mr-2"></i> Start Quiz
            </button>
        </div>
    @endif

    <!-- 4. ASSIGNMENT TYPE -->
    @if($note->type == 'assignment')
        <div class="bg-indigo-50 rounded-lg p-6 border border-indigo-200 mb-6">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-lg bg-indigo-100 flex items-center justify-center shrink-0">
                    <i class="fas fa-tasks text-indigo-600 text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Assignment</h3>
                    <p class="text-sm text-gray-600">Complete this assignment to practice your skills</p>
                    @if($note->excerpt)
                        <p class="text-sm text-gray-500 mt-2">{{ $note->excerpt }}</p>
                    @endif
                </div>
            </div>
            @if($note->file_path)
                <div class="mt-4 pt-4 border-t border-indigo-200">
                    <p class="text-sm text-gray-600 mb-2">Assignment file:</p>
                    <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                       download
                       class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2 rounded-lg transition-colors inline-flex items-center">
                        <i class="fas fa-download mr-2"></i> Download Assignment
                    </a>
                </div>
            @endif
        </div>
    @endif

    <!-- 5. TEXT TYPE (Default) -->
    @if($note->type == 'text' || $note->type == 'assignment' || $note->type == 'quiz')
        @if($note->content)
            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br($note->content) !!}
            </div>
        @endif
    @endif

    <!-- 6. FILE ATTACHMENT (General - if file exists but not handled above) -->
    @if($note->file_path && !in_array($note->type, ['pdf', 'audio', 'video', 'assignment']))
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mb-6">
            <div class="flex items-center gap-3">
                <i class="fas fa-file text-gray-500 text-2xl"></i>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Attached File</p>
                    @if($note->file_size)
                        <p class="text-xs text-gray-500">Size: {{ $note->file_size }}</p>
                    @endif
                </div>
                <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                   download
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors inline-flex items-center text-sm">
                    <i class="fas fa-download mr-1"></i> Download
                </a>
            </div>
        </div>
    @endif

    <!-- Note Meta -->
    <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-4 text-sm text-gray-500">
            <span><i class="far fa-eye mr-1"></i> {{ $note->views_count ?? 0 }} views</span>
            @if($note->downloads_count)
                <span><i class="fas fa-download mr-1"></i> {{ $note->downloads_count }} downloads</span>
            @endif
            @if($note->file_size)
                <span><i class="fas fa-file mr-1"></i> {{ $note->file_size }}</span>
            @endif
            @if($note->video_url)
                <span><i class="fas fa-video mr-1"></i> Video included</span>
            @endif
            <span><i class="far fa-calendar-alt mr-1"></i> {{ $note->created_at->format('M d, Y') }}</span>
            @if($note->published_at)
                <span><i class="far fa-clock mr-1"></i> Published: {{ $note->published_at->format('M d, Y') }}</span>
            @endif
        </div>
        <a href="{{ route('student.course.detail', $note->chapter->course_id) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors">
            Back to Course <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>

<!-- Related Notes from same chapter -->
@php
    $relatedNotes = App\Models\ChapterNote::where('course_chapter_id', $note->course_chapter_id)
        ->where('id', '!=', $note->id)
        ->where('status', 'published')
        ->orderBy('order')
        ->take(4)
        ->get();
@endphp

@if($relatedNotes && $relatedNotes->count() > 0)
<div class="mt-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">More Notes from this Chapter</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach($relatedNotes as $related)
            <a href="{{ route('student.note.detail', $related->id) }}" class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md hover:border-blue-400 transition-all group">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg
                        @if($related->type == 'video') bg-red-50 text-red-600
                        @elseif($related->type == 'pdf') bg-orange-50 text-orange-600
                        @elseif($related->type == 'quiz') bg-purple-50 text-purple-600
                        @elseif($related->type == 'audio') bg-green-50 text-green-600
                        @else bg-blue-50 text-blue-600
                        @endif
                        flex items-center justify-center shrink-0">
                        <i class="fas text-xs
                            @if($related->type == 'video') fa-video
                            @elseif($related->type == 'pdf') fa-file-pdf
                            @elseif($related->type == 'quiz') fa-question-circle
                            @elseif($related->type == 'audio') fa-music
                            @else fa-file-alt
                            @endif
                        "></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 group-hover:text-blue-600 transition-colors truncate">{{ $related->title }}</p>
                        <div class="flex items-center gap-2">
                            <p class="text-xs text-gray-500">{{ ucfirst($related->type) }}</p>
                            @if($related->video_url)
                                <span class="text-xs text-red-400"><i class="fas fa-video"></i></span>
                            @endif
                        </div>
                    </div>
                    <i class="fas fa-arrow-right text-gray-300 group-hover:text-blue-500 transition-colors"></i>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
    // Auto-play audio if needed
    document.addEventListener('DOMContentLoaded', function() {
        const audioElements = document.querySelectorAll('audio');
        audioElements.forEach(audio => {
            audio.addEventListener('play', function() {
                // Pause other audio elements
                audioElements.forEach(other => {
                    if (other !== audio) {
                        other.pause();
                    }
                });
            });
        });
    });
</script>
@endpush
