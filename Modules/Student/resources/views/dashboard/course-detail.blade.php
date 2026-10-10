@extends('student::dashboard.layouts.app')

@section('title', $course->title)
@section('page_title', $course->title)

@section('content')

<!-- Course Header -->
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6 shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-start gap-4">
            <div class="w-16 h-16 rounded-xl bg-gradient-to-br
                @if($course->category && $course->category->name == 'MDCAT') from-[#2563EB] to-[#4338CA]
                @elseif($course->category && $course->category->name == 'NUMS') from-[#059669] to-[#0891B2]
                @elseif($course->category && $course->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                @elseif($course->category && $course->category->name == 'Physics') from-[#EA580C] to-[#DC2626]
                @elseif($course->category && $course->category->name == 'Biology') from-[#16A34A] to-[#0D9488]
                @else from-[#2563EB] to-[#4338CA]
                @endif
                flex items-center justify-center text-white shrink-0">
                <i class="fas fa-graduation-cap text-2xl"></i>
            </div>
            <div>
                <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-2.5 py-1 rounded">{{ $course->category->name ?? 'Course' }}</span>
                    <span class="text-xs text-gray-400">•</span>
                    <span class="text-xs text-gray-500">{{ $chapters->count() ?? 0 }} Chapters</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $course->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $course->short_description ?? 'Comprehensive course for exam preparation.' }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="text-xs text-gray-500">Progress</p>
                <p class="text-lg font-bold text-blue-600">{{ $progress ?? 0 }}%</p>
            </div>
            <div class="w-20 h-20 relative">
                <svg class="w-20 h-20 transform -rotate-90">
                    <circle cx="40" cy="40" r="32" fill="none" stroke="#E5E7EB" stroke-width="6"/>
                    <circle cx="40" cy="40" r="32" fill="none" stroke="#2563EB" stroke-width="6"
                            stroke-dasharray="{{ ($progress ?? 0) * 2.01 }} 201"
                            stroke-linecap="round"/>
                </svg>
                <span class="absolute inset-0 flex items-center justify-center text-sm font-bold text-blue-600">{{ $progress ?? 0 }}%</span>
            </div>
        </div>
    </div>

    <!-- Course Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 pt-6 border-t border-gray-200">
        <div>
            <p class="text-xs text-gray-500">Total Chapters</p>
            <p class="font-semibold text-gray-800">{{ $chapters->count() ?? 0 }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-500">Total Notes</p>
            <p class="font-semibold text-gray-800">
                @php
                    $totalNotes = 0;
                    foreach($chapters as $chapter) {
                        $totalNotes += $chapter->notes->count();
                    }
                @endphp
                {{ $totalNotes }}
            </p>
        </div>
        <div>
            <p class="text-xs text-gray-500">Duration</p>
            <p class="font-semibold text-gray-800">{{ $course->duration_minutes ? ceil($course->duration_minutes / 60) . ' Hours' : 'Flexible' }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-500">Level</p>
            <p class="font-semibold text-gray-800">{{ ucfirst($course->level ?? 'All Levels') }}</p>
        </div>
    </div>
</div>

<!-- Course Content -->
<div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Course Content</h2>

    @if($chapters && $chapters->count() > 0)
        <div class="space-y-3">
            @foreach($chapters as $index => $chapter)
                <div class="chapter-item border border-gray-200 rounded-lg overflow-hidden">
                    <!-- Chapter Header -->
                    <button class="chapter-toggle w-full flex items-center justify-between p-4 text-left bg-white hover:bg-gray-50 transition-colors" onclick="toggleChapter({{ $index }})">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 font-semibold text-sm flex items-center justify-center">{{ $index + 1 }}</span>
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $chapter->title }}</h3>
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <span>{{ $chapter->notes->count() }} notes</span>
                                    @if($chapter->duration_minutes)
                                        <span>• {{ $chapter->duration_minutes }} min</span>
                                    @endif
                                    @if($chapter->video_url)
                                        <span class="text-red-500">
                                            <i class="fas fa-video"></i> Video
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($chapter->is_free_preview)
                                <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded">Free</span>
                            @endif
                            @if($chapter->video_url)
                                <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded">
                                    <i class="fas fa-video mr-1"></i> Video
                                </span>
                            @endif
                            <i class="fas fa-chevron-down chapter-chevron-{{ $index }} text-gray-400 transition-transform"></i>
                        </div>
                    </button>

                    <!-- Chapter Content -->
                    <div class="chapter-content-{{ $index }}" style="display: none;">
                        <div class="border-t border-gray-200 p-4 bg-gray-50">

                            <!-- Chapter Video -->
                            @if($chapter->video_url)
                                <div class="mb-4">
                                    <div class="relative aspect-video bg-[#0F172A] rounded-lg overflow-hidden">
                                        @php
                                            $videoUrl = $chapter->video_url;
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
                                        <iframe
                                            src="{{ $videoUrl }}"
                                            class="w-full h-full"
                                            frameborder="0"
                                            allowfullscreen
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin"
                                            title="{{ $chapter->title }}"
                                        ></iframe>
                                    </div>
                                    <div class="flex items-center justify-between mt-2">
                                        @if($chapter->duration_minutes)
                                            <p class="text-xs text-gray-500">
                                                <i class="fas fa-clock mr-1"></i>
                                                Duration: {{ $chapter->duration_minutes }} minutes
                                            </p>
                                        @endif
                                        <a href="{{ $chapter->video_url }}" target="_blank" class="text-xs text-blue-600 hover:underline">
                                            <i class="fas fa-external-link-alt mr-1"></i> Watch on YouTube
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Chapter Notes -->
                            @if($chapter->notes && $chapter->notes->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($chapter->notes as $note)
                                        <a href="{{ route('student.note.detail', $note->id) }}" class="note-item bg-white rounded-lg p-4 border border-gray-200 hover:border-blue-400 hover:shadow-md transition-all group">
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
                                                    "></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-800 group-hover:text-blue-600 transition-colors truncate">{{ $note->title }}</p>
                                                    <div class="flex items-center gap-2 mt-1 flex-wrap">
                                                        <span class="text-xs text-gray-500">{{ ucfirst($note->type) }}</span>
                                                        @if($note->is_free_preview)
                                                            <span class="text-xs bg-green-100 text-green-600 px-2 py-0.5 rounded">Free</span>
                                                        @endif
                                                        @if($note->views_count)
                                                            <span class="text-xs text-gray-400"><i class="far fa-eye mr-1"></i>{{ $note->views_count }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <i class="fas fa-arrow-right text-gray-300 group-hover:text-blue-500 transition-colors"></i>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-6">
                                    <i class="fas fa-file-alt text-gray-300 text-3xl mb-2"></i>
                                    <p class="text-gray-500 text-sm">No notes available for this chapter yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-book-open text-gray-300 text-5xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-800 mb-2">No Content Available</h3>
            <p class="text-gray-500">This course doesn't have any chapters yet.</p>
        </div>
    @endif
</div>

<!-- Course Actions -->
<div class="mt-6 flex flex-wrap gap-3">
    <a href="{{ route('student.courses') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-4 py-2 rounded-lg transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Back to Courses
    </a>
    <a href="{{ route('student.dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-4 py-2 rounded-lg transition-colors">
        <i class="fas fa-home mr-2"></i> Dashboard
    </a>
</div>

@endsection

@push('scripts')
<script>
    function toggleChapter(index) {
        const content = document.querySelector('.chapter-content-' + index);
        const chevron = document.querySelector('.chapter-chevron-' + index);

        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            chevron.style.transform = 'rotate(180deg)';
        } else {
            content.style.display = 'none';
            chevron.style.transform = 'rotate(0deg)';
        }
    }

    // Auto-open first chapter if there is a video
    document.addEventListener('DOMContentLoaded', function() {
        @if($chapters && $chapters->count() > 0 && $chapters->first()->video_url)
            toggleChapter(0);
        @endif
    });
</script>
@endpush
