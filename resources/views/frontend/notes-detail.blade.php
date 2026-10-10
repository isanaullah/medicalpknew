@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- NOTES DETAIL -->
<section class="pt-36 pb-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <!-- Back Button -->
        <a href="{{ route('notes') }}" class="inline-flex items-center gap-2 text-[#2563EB] hover:text-[#1D4ED8] transition-colors mb-6">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Notes
        </a>

        <article class="card overflow-hidden">
            <!-- Header -->
            <div class="h-56 bg-gradient-to-br
                @if($note->type == 'text') from-[#2563EB] to-[#4338CA]
                @elseif($note->type == 'pdf') from-[#DC2626] to-[#991B1B]
                @elseif($note->type == 'video') from-[#7C3AED] to-[#4F46E5]
                @elseif($note->type == 'audio') from-[#059669] to-[#0891B2]
                @elseif($note->type == 'quiz') from-[#D97706] to-[#EA580C]
                @elseif($note->type == 'assignment') from-[#DB2777] to-[#BE185D]
                @else from-[#2563EB] to-[#4338CA]
                @endif
                relative flex items-center justify-center">
                @if($note->featured_image)
                    <img src="{{ asset('storage/notes/images/' . $note->featured_image) }}" alt="{{ $note->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40"></div>
                @endif
                <div class="relative z-10 text-center text-white px-6">
                    @if($note->type)
                        <span class="badge-pill !bg-white/20 !text-white text-sm backdrop-blur-sm mb-4 inline-block">
                            {{ ucfirst($note->type) }}
                        </span>
                    @endif
                    <h1 class="text-3xl md:text-4xl font-extrabold">{{ $note->title }}</h1>
                    @if($note->chapter && $note->chapter->course)
                        <p class="text-white/80 mt-2">
                            {{ $note->chapter->course->title ?? '' }}
                            @if($note->chapter)
                                <span class="mx-2">•</span>
                                {{ $note->chapter->title ?? '' }}
                            @endif
                        </p>
                    @endif
                </div>
                @if($note->is_free_preview)
                    <span class="absolute top-4 right-4 badge-pill !bg-green-500 !text-white">Free Preview</span>
                @endif
                @if($note->video_url)
                    <span class="absolute bottom-4 right-4 badge-pill !bg-white/20 !text-white backdrop-blur-sm">
                        <i data-lucide="video" class="w-3 h-3 inline mr-1"></i>
                        Video Available
                    </span>
                @endif
            </div>

            <!-- Content -->
            <div class="p-6 md:p-8">
                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-[#64748B] mb-6 pb-6 border-b border-[#E2E8F0]">
                    <span class="flex items-center gap-1">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                        {{ number_format($note->views_count ?? 0) }} views
                    </span>
                    @if($note->file_path)
                        <span class="flex items-center gap-1">
                            <i data-lucide="download" class="w-4 h-4"></i>
                            {{ number_format($note->downloads_count ?? 0) }} downloads
                        </span>
                    @endif
                    @if($note->file_size)
                        <span class="flex items-center gap-1">
                            <i data-lucide="file" class="w-4 h-4"></i>
                            {{ $note->file_size }}
                        </span>
                    @endif
                    @if($note->video_url)
                        <span class="flex items-center gap-1">
                            <i data-lucide="video" class="w-4 h-4 text-red-500"></i>
                            Video Included
                        </span>
                    @endif
                    <span class="flex items-center gap-1">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        {{ $note->created_at->format('F d, Y') }}
                    </span>
                    @if($note->published_at)
                        <span class="flex items-center gap-1">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                            Published: {{ $note->published_at->format('F d, Y') }}
                        </span>
                    @endif
                </div>

                <!-- Excerpt -->
                @if($note->excerpt)
                    <div class="bg-[#F8FBFF] rounded-xl p-6 mb-6 border border-[#E2E8F0]">
                        <p class="text-[#475569] italic">{{ $note->excerpt }}</p>
                    </div>
                @endif

                <!-- ============================================ -->
                <!-- VIDEO (if video_url exists for ANY type)     -->
                <!-- ============================================ -->
                @if($note->video_url)
                    <div class="mb-6">
                        <div class="relative aspect-video bg-[#0F172A] rounded-xl overflow-hidden">
                            @php
                                // Convert YouTube URL to embed URL
                                $videoUrl = $note->video_url;
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
                                title="{{ $note->title }}"
                            ></iframe>
                        </div>
                        @if($note->video_duration)
                            <p class="text-sm text-[#64748B] mt-2">Duration: {{ $note->video_duration }}</p>
                        @endif
                        <p class="text-xs text-[#64748B] mt-1">
                            <i data-lucide="link" class="w-3 h-3 inline mr-1"></i>
                            <a href="{{ $note->video_url }}" target="_blank" class="text-[#2563EB] hover:underline">
                                Watch on Original Platform
                            </a>
                        </p>
                    </div>
                @endif

                <!-- ============================================ -->
                <!-- CONTENT BASED ON TYPE                        -->
                <!-- ============================================ -->

                <!-- PDF TYPE -->
                @if($note->type == 'pdf' && $note->file_path)
                    <div class="mb-6">
                        <div class="bg-[#F8FBFF] rounded-xl p-6 text-center border border-[#E2E8F0]">
                            <i data-lucide="file-pdf" class="w-12 h-12 text-[#DC2626] mx-auto mb-3"></i>
                            <p class="font-semibold text-[#0F172A] mb-2">PDF Document</p>
                            <p class="text-sm text-[#64748B] mb-4">File size: {{ $note->file_size ?? 'N/A' }}</p>
                            <div class="flex flex-wrap justify-center gap-3">
                                <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                                   target="_blank"
                                   class="btn-primary inline-flex items-center gap-2">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    View PDF
                                </a>
                                <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                                   download
                                   class="btn-primary inline-flex items-center gap-2 !bg-green-600 hover:!bg-green-700">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                    Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- AUDIO TYPE -->
                @if($note->type == 'audio' && $note->file_path)
                    <div class="mb-6">
                        <div class="bg-[#F8FBFF] rounded-xl p-6 border border-[#E2E8F0]">
                            <div class="text-center mb-4">
                                <i data-lucide="music" class="w-12 h-12 text-[#059669] mx-auto mb-2"></i>
                                <p class="font-semibold text-[#0F172A]">{{ $note->title }}</p>
                                @if($note->file_size)
                                    <p class="text-sm text-[#64748B]">File size: {{ $note->file_size }}</p>
                                @endif
                            </div>
                            <audio controls class="w-full">
                                <source src="{{ asset('storage/notes/files/' . $note->file_path) }}" type="{{ $note->mime_type ?? 'audio/mpeg' }}">
                                Your browser does not support the audio element.
                            </audio>
                            <div class="text-center mt-3">
                                <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                                   download
                                   class="btn-primary inline-flex items-center gap-2">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                    Download Audio
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- QUIZ TYPE -->
                @if($note->type == 'quiz')
                    <div class="mb-6">
                        <div class="bg-[#F8FBFF] rounded-xl p-6 text-center border border-[#E2E8F0]">
                            <i data-lucide="help-circle" class="w-12 h-12 text-[#D97706] mx-auto mb-3"></i>
                            <p class="font-semibold text-[#0F172A] mb-2">Interactive Quiz</p>
                            <p class="text-sm text-[#64748B] mb-4">Test your knowledge with this quiz</p>
                            @if($note->excerpt)
                                <p class="text-sm text-[#64748B] mb-4">{{ $note->excerpt }}</p>
                            @endif
                            <button class="btn-primary inline-flex items-center gap-2">
                                <i data-lucide="play" class="w-4 h-4"></i>
                                Start Quiz
                            </button>
                        </div>
                    </div>
                @endif

                <!-- ASSIGNMENT TYPE -->
                @if($note->type == 'assignment')
                    <div class="mb-6">
                        <div class="bg-[#F8FBFF] rounded-xl p-6 border border-[#E2E8F0]">
                            <div class="flex items-start gap-4">
                                <i data-lucide="clipboard" class="w-12 h-12 text-[#DB2777] shrink-0"></i>
                                <div class="flex-1">
                                    <p class="font-semibold text-[#0F172A] mb-2">Assignment</p>
                                    <p class="text-sm text-[#64748B]">Complete this assignment to practice your skills</p>
                                    @if($note->excerpt)
                                        <p class="text-sm text-[#64748B] mt-2">{{ $note->excerpt }}</p>
                                    @endif
                                </div>
                            </div>
                            @if($note->file_path)
                                <div class="mt-4 pt-4 border-t border-[#E2E8F0]">
                                    <p class="text-sm text-[#64748B] mb-2">Assignment file:</p>
                                    <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                                       download
                                       class="btn-primary inline-flex items-center gap-2">
                                        <i data-lucide="download" class="w-4 h-4"></i>
                                        Download Assignment
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- TEXT CONTENT (for text type or if content exists) -->
                @if($note->content && ($note->type == 'text' || $note->type == 'assignment' || $note->type == 'quiz'))
                    <div class="prose prose-lg max-w-none text-[#475569] leading-relaxed">
                        {!! nl2br($note->content) !!}
                    </div>
                @endif

                <!-- GENERAL FILE ATTACHMENT -->
                @if($note->file_path && !in_array($note->type, ['pdf', 'audio', 'video', 'assignment']))
                    <div class="mb-6">
                        <div class="bg-[#F8FBFF] rounded-xl p-6 border border-[#E2E8F0]">
                            <div class="flex items-center gap-4">
                                <i data-lucide="file" class="w-12 h-12 text-[#64748B]"></i>
                                <div class="flex-1">
                                    <p class="font-semibold text-[#0F172A] mb-1">Attached File</p>
                                    @if($note->file_size)
                                        <p class="text-sm text-[#64748B]">Size: {{ $note->file_size }}</p>
                                    @endif
                                </div>
                                <a href="{{ asset('storage/notes/files/' . $note->file_path) }}"
                                   download
                                   class="btn-primary inline-flex items-center gap-2">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tags -->
                <div class="flex flex-wrap gap-2 pt-6 border-t border-[#E2E8F0] mt-6">
                    <span class="text-xs font-semibold text-[#64748B]">Type:</span>
                    <span class="badge-pill text-xs">{{ ucfirst($note->type) }}</span>
                    @if($note->is_free_preview)
                        <span class="badge-pill text-xs !bg-green-50 !text-green-600">Free Preview</span>
                    @endif
                    @if($note->status)
                        <span class="badge-pill text-xs">{{ ucfirst($note->status) }}</span>
                    @endif
                    @if($note->video_url)
                        <span class="badge-pill text-xs !bg-red-50 !text-red-600">
                            <i data-lucide="video" class="w-3 h-3 inline mr-1"></i>
                            Video
                        </span>
                    @endif
                    @if($note->file_path)
                        <span class="badge-pill text-xs !bg-blue-50 !text-blue-600">
                            <i data-lucide="file" class="w-3 h-3 inline mr-1"></i>
                            Attachment
                        </span>
                    @endif
                </div>

                <!-- Navigation -->
                <div class="flex flex-wrap justify-between gap-4 pt-6 border-t border-[#E2E8F0] mt-6">
                    <a href="{{ route('notes') }}" class="text-[#2563EB] hover:text-[#1D4ED8] transition-colors inline-flex items-center gap-2">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        All Notes
                    </a>
                    @if($note->course_chapter_id && $note->chapter)
                        <a href="#" class="text-[#2563EB] hover:text-[#1D4ED8] transition-colors inline-flex items-center gap-2">
                            View All Notes in Chapter
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @endif
                </div>
            </div>
        </article>

        <!-- Related Notes -->
        @php
            $relatedNotes = App\Models\ChapterNote::where('course_chapter_id', $note->course_chapter_id)
                ->where('id', '!=', $note->id)
                ->where('status', 'published')
                ->orderBy('order')
                ->take(3)
                ->get();
        @endphp

        @if($relatedNotes && $relatedNotes->count() > 0)
            <div class="mt-8">
                <h3 class="text-xl font-bold text-[#0F172A] mb-4">More Notes from this Chapter</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach($relatedNotes as $related)
                        <a href="{{ route('notes.detail', $related->id) }}" class="card p-4 hover:shadow-md transition-shadow group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg
                                    @if($related->type == 'video') bg-red-50 text-red-600
                                    @elseif($related->type == 'pdf') bg-orange-50 text-orange-600
                                    @elseif($related->type == 'quiz') bg-purple-50 text-purple-600
                                    @elseif($related->type == 'audio') bg-green-50 text-green-600
                                    @else bg-blue-50 text-blue-600
                                    @endif
                                    flex items-center justify-center shrink-0">
                                    <i data-lucide="
                                        @if($related->type == 'video') video
                                        @elseif($related->type == 'pdf') file
                                        @elseif($related->type == 'quiz') help-circle
                                        @elseif($related->type == 'audio') music
                                        @else file-text
                                        @endif
                                    " class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-[#0F172A] group-hover:text-[#2563EB] transition-colors truncate">{{ $related->title }}</p>
                                    <p class="text-xs text-[#64748B]">{{ ucfirst($related->type) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@include('frontend.partials.footer')

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
</body>
</html>
