@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- HERO -->
<section id="detail-hero" class="page-hero pt-36 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <span class="badge-pill mb-5">{{ $course->category->name ?? 'Course' }}</span>

        <h1 id="detail-title" class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] mb-4">
            {{ $course->title }}
        </h1>

        <p class="text-[#475569] max-w-xl mx-auto mb-10">
            {{ $course->short_description ?? 'Structured, exam-focused course for MDCAT, NUMS, ECAT and FSc — taught by Pakistan\'s most trusted faculty.' }}
        </p>

        <div class="max-w-xl mx-auto relative mb-8">
            <div class="flex flex-wrap items-center justify-center gap-3 bg-[#F8FAFC] rounded-xl p-4 border border-[#E2E8F0]">
                <span class="flex items-center gap-2 text-sm text-[#475569]">
                    <i data-lucide="users" class="w-4 h-4 text-[#94A3B8]"></i>
                    <span class="font-medium">{{ rand(100, 5000) }}</span> Students
                </span>
                <span class="w-px h-5 bg-[#E2E8F0]"></span>
                <span class="flex items-center gap-2 text-sm text-[#475569]">
                    <i data-lucide="clock" class="w-4 h-4 text-[#94A3B8]"></i>
                    {{ $course->duration_minutes ? ceil($course->duration_minutes / 60) . ' Hours' : 'Flexible' }}
                </span>
                <span class="w-px h-5 bg-[#E2E8F0]"></span>
                <span class="flex items-center gap-2 text-sm text-[#475569]">
                    <i data-lucide="star" class="w-4 h-4 text-[#FBBF24]"></i>
                    {{ number_format($averageRating ?? 4.5, 1) }} Rating
                </span>
                <span class="w-px h-5 bg-[#E2E8F0]"></span>
                <span class="badge-pill text-[10px] py-1">{{ ucfirst($course->level ?? 'All Levels') }}</span>
                @if($isFree)
                    <span class="w-px h-5 bg-[#E2E8F0]"></span>
                    <span class="badge-pill !bg-emerald-500 !text-white text-xs">
                        <i data-lucide="unlock" class="w-3 h-3 inline mr-1"></i>
                        Free
                    </span>
                @endif
                @if($isEnrolled)
                    <span class="w-px h-5 bg-[#E2E8F0]"></span>
                    <span class="badge-pill !bg-green-500 !text-white text-xs">
                        <i data-lucide="check-circle" class="w-3 h-3 inline mr-1"></i>
                        Enrolled
                    </span>
                @endif
            </div>
        </div>

        <div class="filter-bar flex flex-wrap justify-center gap-3">
            @if($isEnrolled)
                <a href="{{ route('student.course.detail', $course->id) }}" class="btn-primary px-6 py-3 bg-green-600 hover:bg-green-700">
                    <i data-lucide="play" class="w-4 h-4 inline mr-2"></i>
                    Continue Learning
                </a>
                <br>
            @elseif($isFree)
                <form action="{{ route('courses.enroll.free', $course->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-primary px-6 py-3 bg-emerald-600 hover:bg-emerald-700">
                        <i data-lucide="unlock" class="w-4 h-4 inline mr-2"></i>
                        Enroll Now — Free
                    </button>
                </form>
            <br>
            @else
                <form action="{{ route('cart.add') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit" class="btn-primary px-6 py-3">
                        Enroll Now — Rs. {{ number_format($course->discount_price ?? $course->price) }}
                    </button>
                </form>
            @endif
        </div>
    </div>
</section>
<br>
<!-- Breadcrumb -->
<section class="pb-8 bg-white border-b border-[#E2E8F0]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 text-sm text-[#64748B]">
            <a href="{{ route('home') }}" class="hover:text-[#2563EB]">Home</a>
            <span>/</span>
            <a href="{{ route('courses') }}" class="hover:text-[#2563EB]">Courses</a>
            <span>/</span>
            <span class="text-[#0F172A] font-medium">{{ $course->title }}</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-16">
            <!-- What You'll Learn -->
            <div class="fade-up">
                <h2 class="text-2xl font-bold text-[#0F172A] mb-6">What You'll Learn</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#475569]">Master the complete {{ $course->category->name ?? 'course' }} syllabus for 2025 exams</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#475569]">Solve past papers with detailed step-by-step solutions</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#475569]">Build speed and accuracy with timed practice drills</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#475569]">Understand core concepts through visual explanations</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#475569]">Access downloadable notes and formula sheets</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#475569]">Track your progress with topic-wise analytics</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#475569]">Get doubts resolved via WhatsApp support group</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#475569]">Prepare with mock tests that mirror the real exam</p>
                    </div>
                </div>
            </div>

            <!-- Course Overview -->
            <div class="fade-up">
                <h2 class="text-2xl font-bold text-[#0F172A] mb-6">Course Overview</h2>
                <div class="space-y-4 text-[#475569] leading-relaxed">
                    @if($course->description)
                        {!! nl2br($course->description) !!}
                    @else
                        <p>{{ $course->title }} is designed for students who want a structured, no-guesswork path to mastering {{ $course->category->name ?? 'the subject' }}. Taught by expert faculty, this course breaks down complex topics into digestible lessons backed by real exam data from the last decade of Pakistani entrance tests.</p>
                        <p>Over {{ $course->duration_minutes ? ceil($course->duration_minutes / 60) . ' hours' : 'the duration' }}, you'll move through a carefully sequenced curriculum — from foundational concepts to advanced problem-solving — supported by quizzes after every module to reinforce retention.</p>
                        <p>Whether you're aiming for a top merit position or catching up after a slow start, the pacing and practice volume in this course are built to get you exam-ready with confidence.</p>
                    @endif
                </div>
            </div>

            <!-- Curriculum -->
            <div class="fade-up">
                <h2 class="text-2xl font-bold text-[#0F172A] mb-6">Curriculum</h2>
                <div id="curriculum-list" class="border border-[#E2E8F0] rounded-2xl overflow-hidden">
                    @if($course->chapters && $course->chapters->count() > 0)
                        @foreach($course->chapters as $index => $chapter)
                            <div class="curriculum-module border-b border-[#E2E8F0] last:border-b-0">
                                <button class="module-toggle w-full flex items-center justify-between gap-4 p-5 text-left bg-white hover:bg-[#F8FBFF] transition-colors">
                                    <span class="font-semibold text-[#0F172A]">
                                        Module {{ $index + 1 }}: {{ $chapter->title }}
                                        @if($chapter->is_free_preview)
                                            <span class="badge-pill text-[10px] !bg-green-50 !text-green-600 ml-2">Free Preview</span>
                                        @endif
                                        @if($chapter->video_url)
                                            <span class="badge-pill text-[10px] !bg-red-50 !text-red-600 ml-1">
                                                <i data-lucide="video" class="w-3 h-3 inline mr-1"></i>
                                                Video
                                            </span>
                                        @endif
                                    </span>
                                    <i data-lucide="chevron-down" class="module-chevron w-5 h-5 text-[#2563EB] shrink-0 transition-transform"></i>
                                </button>
                                <div class="module-lessons" style="max-height:0; overflow:hidden; transition:max-height .4s ease;">
                                    <div class="px-5 pb-5 space-y-3">
                                        <!-- Chapter Video -->
                                        @if($chapter->video_url)
                                            <div class="mb-4">
                                                <div class="relative aspect-video bg-[#0F172A] rounded-xl overflow-hidden">
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
                                                @if($chapter->duration_minutes)
                                                    <p class="text-sm text-[#64748B] mt-2">
                                                        <i data-lucide="clock" class="w-4 h-4 inline mr-1"></i>
                                                        Duration: {{ $chapter->duration_minutes }} minutes
                                                    </p>
                                                @endif
                                                <p class="text-xs text-[#64748B] mt-1">
                                                    <i data-lucide="link" class="w-3 h-3 inline mr-1"></i>
                                                    <a href="{{ $chapter->video_url }}" target="_blank" class="text-[#2563EB] hover:underline">
                                                        Watch on YouTube
                                                    </a>
                                                </p>
                                            </div>
                                        @endif

                                        <!-- Chapter Notes -->
                                        @if($chapter->notes && $chapter->notes->count() > 0)
                                            <div class="grid grid-cols-1 gap-2">
                                                @foreach($chapter->notes as $note)
                                                    @php
                                                        // Check if note is free preview OR user is enrolled
                                                        $canAccess = $note->is_free_preview || $isEnrolled;
                                                    @endphp

                                                    @if($canAccess)
                                                        <!-- Accessible Note -->
                                                        <a href="{{ route('notes.detail', $note->id) }}" class="flex items-center justify-between text-sm text-[#475569] py-2 px-3 border border-[#E2E8F0] rounded-lg hover:bg-[#F8FBFF] hover:border-[#2563EB] transition-colors group">
                                                            <div class="flex items-center gap-3">
                                                                <i data-lucide="
                                                                    @if($note->type == 'video') video
                                                                    @elseif($note->type == 'pdf') file
                                                                    @elseif($note->type == 'quiz') help-circle
                                                                    @elseif($note->type == 'audio') music
                                                                    @else file-text
                                                                    @endif
                                                                " class="w-4 h-4 text-[#94A3B8] group-hover:text-[#2563EB] transition-colors"></i>
                                                                <span class="group-hover:text-[#2563EB] transition-colors">{{ $note->title }}</span>
                                                            </div>
                                                            <div class="flex items-center gap-2">
                                                                @if($note->is_free_preview)
                                                                    <span class="badge-pill text-[10px] !bg-green-50 !text-green-600">Free</span>
                                                                @endif
                                                                <span class="text-xs text-[#94A3B8] group-hover:text-[#2563EB] transition-colors">{{ ucfirst($note->type) }}</span>
                                                                <i data-lucide="arrow-right" class="w-4 h-4 text-[#94A3B8] group-hover:text-[#2563EB] transition-colors"></i>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <!-- Locked Note -->
                                                        <div class="flex items-center justify-between text-sm text-[#94A3B8] py-2 px-3 border border-[#E2E8F0] rounded-lg bg-[#F8FAFC] cursor-not-allowed">
                                                            <div class="flex items-center gap-3">
                                                                <i data-lucide="lock" class="w-4 h-4 text-[#94A3B8]"></i>
                                                                <span>{{ $note->title }}</span>
                                                            </div>
                                                            <div class="flex items-center gap-2">
                                                                <span class="badge-pill text-[10px] !bg-gray-100 !text-gray-500">Locked</span>
                                                                <span class="text-xs text-[#94A3B8]">{{ ucfirst($note->type) }}</span>
                                                                <i data-lucide="lock" class="w-4 h-4 text-[#94A3B8]"></i>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="flex items-center gap-3 text-sm text-[#475569] py-2 border-t border-[#F1F5F9] first:border-t-0">
                                                <i data-lucide="clock" class="w-4 h-4 text-[#94A3B8]"></i>
                                                Lesson {{ $loop->index + 1 }}: Chapter content coming soon
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-5 text-center text-[#64748B]">
                            <i data-lucide="book-open" class="w-8 h-8 mx-auto mb-2 text-[#94A3B8]"></i>
                            <p>Curriculum is being prepared for this course.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Student Reviews -->
            <div class="fade-up">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-[#0F172A]">Student Reviews</h2>
                    <button onclick="openReviewModal()" class="text-[#2563EB] font-semibold hover:text-[#1D4ED8] transition-colors text-sm">
                        <i data-lucide="plus-circle" class="w-4 h-4 inline mr-1"></i>
                        Write a Review
                    </button>
                </div>

                <!-- Rating Summary -->
                <div class="bg-[#F8FBFF] rounded-xl p-6 mb-8 border border-[#E2E8F0]">
                    <div class="flex items-center gap-8 flex-wrap">
                        <div class="text-center">
                            <p class="text-4xl font-extrabold text-[#0F172A]">{{ number_format($averageRating ?? 0, 1) }}</p>
                            <div class="flex text-[#FBBF24] mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= round($averageRating ?? 0) ? 'text-[#FBBF24]' : 'text-[#E2E8F0]' }}" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                                @endfor
                            </div>
                            <p class="text-xs text-[#64748B] mt-1">{{ $totalReviews ?? 0 }} reviews</p>
                        </div>
                        <div class="flex-1 space-y-1">
                            @php
                                $ratingDistribution = $ratingDistribution ?? [];
                            @endphp
                            @foreach($ratingDistribution as $stars => $count)
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="text-[#64748B] w-6">{{ $stars }}★</span>
                                    <div class="flex-1 h-1.5 bg-[#E2E8F0] rounded-full overflow-hidden">
                                        <div class="h-full bg-[#FBBF24] rounded-full" style="width: {{ ($totalReviews ?? 0) > 0 ? ($count / ($totalReviews ?? 1) * 100) : 0 }}%"></div>
                                    </div>
                                    <span class="text-[#64748B] w-8 text-right">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Reviews List -->
                <div class="space-y-5" id="reviews-list">
                    @if($reviews && $reviews->count() > 0)
                        @foreach($reviews as $review)
                            <div class="card p-5">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-sm flex items-center justify-center">
                                        {{ strtoupper(substr($review->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-[#0F172A] text-sm">{{ $review->name }}</p>
                                        <p class="text-xs text-[#64748B]">{{ $review->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="ml-auto flex text-[#FBBF24]">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-[#FBBF24]' : 'text-[#E2E8F0]' }}" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->title)
                                    <p class="font-semibold text-[#0F172A] text-sm mb-1">{{ $review->title }}</p>
                                @endif
                                <p class="text-sm text-[#475569] leading-relaxed">{{ $review->review }}</p>
                            </div>
                        @endforeach

                        @if(($totalReviews ?? 0) > 5)
                            <div class="text-center">
                                <button onclick="loadMoreReviews({{ $course->id }})" class="text-[#2563EB] font-semibold hover:text-[#1D4ED8] transition-colors text-sm">
                                    Load More Reviews
                                </button>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <i data-lucide="star" class="w-12 h-12 text-[#94A3B8] mx-auto mb-3"></i>
                            <p class="text-[#64748B]">No reviews yet. Be the first to review this course!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="lg:col-span-1">
            <div class="card p-6 sticky top-24">
                <p id="sidebar-price" class="text-3xl font-extrabold text-[#0F172A] mb-4">
                    @if($isFree)
                        <span class="text-emerald-600 font-bold">Free</span>
                    @elseif($course->discount_price)
                        <span class="text-sm text-[#64748B] line-through">Rs. {{ number_format($course->price) }}</span>
                        <br>
                        Rs. {{ number_format($course->discount_price) }}
                    @else
                        Rs. {{ number_format($course->price) }}
                    @endif
                </p>

                @if($isEnrolled)
                    <a href="{{ route('student.course.detail', $course->id) }}" class="bg-green-600 hover:bg-green-700 text-white w-full text-center py-3 rounded-xl flex items-center justify-center gap-2 transition-colors">
                        <i data-lucide="play" class="w-4 h-4"></i>
                        Continue Learning
                    </a>
                    <bwr>
                @elseif($isFree)
                    <form action="{{ route('courses.enroll.free', $course->id) }}" method="POST" class="mb-3">
                        @csrf
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white w-full text-center py-3 rounded-xl flex items-center justify-center gap-2 transition-colors">
                            <i data-lucide="unlock" class="w-4 h-4"></i>
                            Enroll Now — Free
                        </button>
                    </form>
                    <br>
                @else
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <button type="submit" class="btn-primary w-full text-center flex items-center justify-center gap-2">
                            <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                            Add to Cart — Rs. {{ number_format($course->discount_price ?? $course->price) }}
                        </button>
                    </form>
                @endif
                <br>
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3 mb-4 text-sm">
                        <i data-lucide="check-circle" class="w-4 h-4 inline mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 mb-4 text-sm">
                        <i data-lucide="alert-circle" class="w-4 h-4 inline mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <p class="font-semibold text-[#0F172A] mb-4 text-sm">This course includes:</p>
                <ul class="space-y-3 text-sm text-[#475569]">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-[#2563EB]"></i>
                        {{ $course->chapters ? $course->chapters->count() * 2 : 60 }}+ Video Lectures
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-[#2563EB]"></i>
                        Downloadable PDF Notes
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-[#2563EB]"></i>
                        5000+ Practice MCQs
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-[#2563EB]"></i>
                        Certificate of Completion
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-[#2563EB]"></i>
                        Lifetime Access
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-[#2563EB]"></i>
                        WhatsApp Support
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- RELATED COURSES -->
@if($relatedCourses && $relatedCourses->count() > 0)
<section class="py-20 bg-[#F8FBFF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-2xl font-bold text-[#0F172A] mb-8 fade-up">Related Courses</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 stagger-parent">
            @foreach($relatedCourses as $related)
            <a href="{{ route('courses.detail', $related->id) }}" class="stagger-item card overflow-hidden flex flex-col group">
                <div class="h-40 bg-gradient-to-br
                    @if(isset($related->category) && $related->category->name == 'MDCAT') from-[#2563EB] to-[#4338CA]
                    @elseif(isset($related->category) && $related->category->name == 'NUMS') from-[#059669] to-[#0891B2]
                    @elseif(isset($related->category) && $related->category->name == 'ECAT') from-[#D97706] to-[#EA580C]
                    @elseif(isset($related->category) && $related->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                    @elseif(isset($related->category) && $related->category->name == 'Physics') from-[#EA580C] to-[#DC2626]
                    @elseif(isset($related->category) && $related->category->name == 'Biology') from-[#16A34A] to-[#0D9488]
                    @elseif(isset($related->category) && $related->category->name == 'English') from-[#DB2777] to-[#BE185D]
                    @else from-[#2563EB] to-[#4338CA]
                    @endif
                    relative flex items-center justify-center overflow-hidden">
                    @if($related->image)
                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-white font-bold text-base px-6 text-center relative z-10">{{ $related->title }}</span>
                    @endif
                </div>
                <div class="p-5 flex flex-col gap-3 flex-1">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-xs flex items-center justify-center">
                            {{ isset($related->category) ? $related->category->name[0] : 'C' }}
                        </div>
                        <span class="text-sm font-medium text-[#475569]">{{ $related->category->name ?? 'General' }}</span>
                    </div>
                    <h4 class="font-bold text-[#0F172A] text-sm line-clamp-2">{{ $related->title }}</h4>
                    <span class="mt-auto btn-primary w-full text-center text-sm">View Course</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-[#0F172A]">Write a Review</h3>
            <button onclick="closeReviewModal()" class="text-[#64748B] hover:text-[#0F172A] transition-colors">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        @if(session('review_success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-4 text-sm font-medium flex items-center gap-2">
                <i data-lucide="check-circle-2" class="w-5 h-5 inline"></i>
                {{ session('review_success') }}
            </div>
        @endif

        @if(session('review_error'))
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-4 text-sm font-medium flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-5 h-5 inline"></i>
                {{ session('review_error') }}
            </div>
        @endif

        <form action="{{ route('reviews.store') }}" method="POST" id="reviewForm">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="rating" id="ratingValue" value="5">

            <div class="space-y-4">
                <!-- Rating -->
                <div>
                    <label class="block text-sm font-medium text-[#0F172A] mb-2">Rating <span class="text-red-500">*</span></label>
                    <div class="flex gap-2" id="ratingSelector">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" class="rating-star w-10 h-10 rounded-lg border border-[#E2E8F0] text-2xl hover:border-[#2563EB] transition-colors flex items-center justify-center" data-value="{{ $i }}">
                                <span class="star-{{ $i }} text-[#E2E8F0]">★</span>
                            </button>
                        @endfor
                    </div>
                    @error('rating')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name & Email (Only show if not logged in) -->
                @if(!auth()->check())
                    <div>
                        <label class="block text-sm font-medium text-[#0F172A] mb-2">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your full name" class="w-full px-4 py-2.5 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#0F172A] mb-2">Email (optional)</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" class="w-full px-4 py-2.5 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB]">
                    </div>
                @else
                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                    <div class="bg-[#F8FBFF] rounded-xl p-4 border border-[#E2E8F0]">
                        <p class="text-sm text-[#475569]">
                            <i data-lucide="user" class="w-4 h-4 inline mr-2 text-[#2563EB]"></i>
                            Reviewing as <strong>{{ auth()->user()->name }}</strong>
                        </p>
                    </div>
                @endif

                <!-- Review Title -->
                <div>
                    <label class="block text-sm font-medium text-[#0F172A] mb-2">Review Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Brief title for your review" class="w-full px-4 py-2.5 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB]">
                </div>

                <!-- Review -->
                <div>
                    <label class="block text-sm font-medium text-[#0F172A] mb-2">Review <span class="text-red-500">*</span></label>
                    <textarea name="review" required rows="4" placeholder="Share your experience with this course..." class="w-full px-4 py-2.5 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] resize-none @error('review') border-red-500 @enderror">{{ old('review') }}</textarea>
                    @error('review')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Submit Review
                </button>
                <p class="text-xs text-[#64748B] text-center">Your review will be visible after admin approval.</p>
            </div>
        </form>
    </div>
</div>

@include('frontend.partials.footer')

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    // Initialize Lucide icons
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            lucide.createIcons();
        }
    });

    // ===== RATING SELECTOR =====
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('ratingValue');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = parseInt(this.dataset.value);
            ratingInput.value = value;

            stars.forEach(s => {
                const starValue = parseInt(s.dataset.value);
                const starSpan = s.querySelector('span');
                if (starValue <= value) {
                    starSpan.classList.remove('text-[#E2E8F0]');
                    starSpan.classList.add('text-[#FBBF24]');
                } else {
                    starSpan.classList.remove('text-[#FBBF24]');
                    starSpan.classList.add('text-[#E2E8F0]');
                }
            });
        });
    });

    // Set default rating (5 stars)
    const defaultStar = document.querySelector('.rating-star[data-value="5"]');
    if (defaultStar) defaultStar.click();

    // ===== MODAL FUNCTIONS =====
    function openReviewModal() {
        const modal = document.getElementById('reviewModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeReviewModal() {
        const modal = document.getElementById('reviewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeReviewModal();
    });

    // Close on click outside
    document.getElementById('reviewModal').addEventListener('click', function(e) {
        if (e.target === this) closeReviewModal();
    });

    // ===== MODULE TOGGLE =====
    document.querySelectorAll('.module-toggle').forEach((btn) => {
        btn.addEventListener('click', () => {
            const lessons = btn.nextElementSibling;
            const chevron = btn.querySelector('.module-chevron');
            const isOpen = lessons.style.maxHeight && lessons.style.maxHeight !== '0px';

            document.querySelectorAll('.module-lessons').forEach((l) => {
                l.style.maxHeight = '0px';
            });
            document.querySelectorAll('.module-chevron').forEach((c) => {
                c.style.transform = 'rotate(0deg)';
            });

            if (!isOpen) {
                lessons.style.maxHeight = lessons.scrollHeight + 'px';
                chevron.style.transform = 'rotate(180deg)';
            }
        });
    });
</script>
</body>
</html>
