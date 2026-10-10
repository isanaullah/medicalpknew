@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

<!-- ============================= NAVBAR ============================= -->
@include('frontend.partials.nav-bar')

<!-- ============================= HERO ============================= -->
<section class="relative pt-36 md:pt-44 pb-24 overflow-hidden bg-gradient-to-b from-[#F8FBFF] to-white">
    <!-- Particles (Static SVG elements) -->
    <svg class="particle hidden md:block" style="top:14%; left:6%; animation-delay:0s;" width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.4">
        <circle cx="12" cy="12" r="1.6" fill="#2563EB"/>
        <ellipse cx="12" cy="12" rx="10" ry="4"/>
        <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(60 12 12)"/>
        <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(120 12 12)"/>
    </svg>
    <svg class="particle hidden md:block" style="top:60%; left:3%; animation-delay:1.5s;" width="38" height="38" viewBox="0 0 24 24" fill="#60A5FA">
        <path d="M12 2l3 6-3 6-3-6 3-6zM12 10l3 6-3 6-3-6 3-6z"/>
    </svg>
    <svg class="particle hidden md:block" style="top:8%; right:8%; animation-delay:0.8s;" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="1.3">
        <polygon points="12,2 21,7 21,17 12,22 3,17 3,7"/>
    </svg>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div class="fade-up">
            <span class="badge-pill mb-6">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                Pakistan's #1 Medical Learning Platform
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#0F172A] leading-[1.08] tracking-tight mb-6">
                Learn Medicine.<br>
                <span class="gradient-text">Ace Your Exams.</span><br>
                Build Your Future.
            </h1>
            <p class="text-lg text-[#475569] max-w-xl mb-8 leading-relaxed">
                The complete prep ecosystem for MDCAT, NUMS &amp; ECAT — expert-led video lectures, curated Chemistry, Biology and Physics notes, and 50,000+ practice MCQs, built for Pakistani pre-med students.
            </p>
            <div class="flex flex-wrap gap-4 mb-12">
                <a href="{{ route('courses') }}" class="btn-primary">
                    Start Learning Free
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="{{ route('courses') }}" class="btn-outline">Explore Courses</a>
                <a href="#" class="btn-ghost">
                    <span class="w-8 h-8 rounded-full bg-[#DBEAFE] flex items-center justify-center">
                        <i data-lucide="play" class="w-3.5 h-3.5 text-[#2563EB]"></i>
                    </span>
                    Watch Demo
                </a>
            </div>
            <div class="flex flex-wrap gap-8 pt-8 border-t border-[#E2E8F0]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#DBEAFE] flex items-center justify-center"><i data-lucide="users" class="w-5 h-5 text-[#2563EB]"></i></div>
                    <div><p class="font-extrabold text-[#0F172A] leading-none text-lg">100K+</p><p class="text-xs text-[#64748B] mt-1">Students</p></div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#DBEAFE] flex items-center justify-center"><i data-lucide="trending-up" class="w-5 h-5 text-[#2563EB]"></i></div>
                    <div><p class="font-extrabold text-[#0F172A] leading-none text-lg">95%</p><p class="text-xs text-[#64748B] mt-1">Success Rate</p></div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#DBEAFE] flex items-center justify-center"><i data-lucide="video" class="w-5 h-5 text-[#2563EB]"></i></div>
                    <div><p class="font-extrabold text-[#0F172A] leading-none text-lg">500+</p><p class="text-xs text-[#64748B] mt-1">Videos</p></div>
                </div>
            </div>
        </div>

        <!-- 3D BOOK -->
        <div class="flex justify-center items-center relative fade-up" style="animation-delay:.15s">
            <div class="book-scene">
                <div id="book-wrapper" class="book-wrapper">
                    <div class="book">
                        <div class="book-spine"><span>CHEMISTRY · MEDICAL.PK</span></div>
                        <div class="book-pages"></div>
                        <div class="book-page p2"></div>
                        <div class="book-page p1"></div>
                        <div class="book-page p0"></div>
                        <div class="book-cover-front">
                            <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="#FBBF24" stroke-width="1.4" class="mb-1">
                                <circle cx="12" cy="12" r="9"/>
                                <circle cx="12" cy="12" r="2" fill="#FBBF24"/>
                                <ellipse cx="12" cy="12" rx="9" ry="3.4" transform="rotate(45 12 12)"/>
                                <ellipse cx="12" cy="12" rx="9" ry="3.4" transform="rotate(-45 12 12)"/>
                            </svg>
                            <p class="text-white/60 text-[10px] tracking-[0.35em] font-semibold">MEDICAL.PK</p>
                            <h3 class="text-white text-3xl font-extrabold tracking-wide">CHEMISTRY</h3>
                            <p class="text-[#FBBF24] text-xs tracking-[0.3em] font-bold">MDCAT PREP</p>
                            <div class="w-14 h-[2px] bg-[#FBBF24]/70 my-1"></div>
                            <p class="text-white/50 text-[10px] tracking-widest">VOLUME I · ORGANIC &amp; INORGANIC</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="book-glow"></div>
        </div>
    </div>
</section>

<!-- ============================= SUBJECTS MARQUEE ============================= -->
<!-- ============================= SUBJECTS MARQUEE ============================= -->
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center mb-12 fade-up">
        <span class="badge-pill mb-4">Browse by Subject</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A]">Explore by Subject</h2>
        <p class="text-[#64748B] mt-3 max-w-xl mx-auto">Everything you need for FSc, MDCAT, NUMS and ECAT — all in one place.</p>
    </div>

    @php
        $gradientMap = [
            'Chemistry' => 'from-[#2563EB] to-[#4338CA]',
            'Physics' => 'from-[#EA580C] to-[#DC2626]',
            'Biology' => 'from-[#16A34A] to-[#0D9488]',
            'MDCAT' => 'from-[#0891B2] to-[#2563EB]',
            'NUMS' => 'from-[#059669] to-[#0891B2]',
            'ECAT' => 'from-[#D97706] to-[#EA580C]',
            'English' => 'from-[#DB2777] to-[#BE185D]',
            'Logical Reasoning' => 'from-[#7C3AED] to-[#6D28D9]',
        ];

        // Default gradient colors for categories not in the map
        $defaultColors = [
            ['from' => '#DC2626', 'to' => '#991B1B'],    // Red
            ['from' => '#65A30D', 'to' => '#16A34A'],    // Green
            ['from' => '#7C3AED', 'to' => '#4F46E5'],    // Purple
            ['from' => '#D97706', 'to' => '#EA580C'],    // Orange
            ['from' => '#0891B2', 'to' => '#0D9488'],    // Teal
            ['from' => '#DB2777', 'to' => '#BE185D'],    // Pink
            ['from' => '#059669', 'to' => '#0891B2'],    // Emerald
            ['from' => '#8B5CF6', 'to' => '#6D28D9'],    // Violet
            ['from' => '#EC4899', 'to' => '#BE185D'],    // Rose
            ['from' => '#F59E0B', 'to' => '#D97706'],    // Amber
            ['from' => '#10B981', 'to' => '#065F46'],    // Mint
            ['from' => '#3B82F6', 'to' => '#1E40AF'],    // Blue
        ];

        $defaultIndex = 0;
    @endphp

    <div class="marquee-row overflow-hidden mb-5">
        <div class="marquee-track" id="subjects-row-1">
            @for($i = 0; $i < 3; $i++)
                @foreach($courseCategories as $category)
                    @php
                        if (isset($gradientMap[$category->name])) {
                            $gradientClass = $gradientMap[$category->name];
                        } else {
                            $color = $defaultColors[$defaultIndex % count($defaultColors)];
                            $gradientClass = 'from-[' . $color['from'] . '] to-[' . $color['to'] . ']';
                            $defaultIndex++;
                        }
                    @endphp
                    <a href="{{ route('courses', ['category' => $category->name]) }}"
                       class="group shrink-0 w-[170px] h-[112px] mx-3 rounded-2xl bg-gradient-to-br {{ $gradientClass }} p-4 flex flex-col justify-between text-white shadow-lg hover:-translate-y-1.5 hover:shadow-2xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            @if($category->icon)
                                <i class="{{ $category->icon }} text-xl text-white/90"></i>
                            @else
                                <i data-lucide="book-open" class="w-6 h-6"></i>
                            @endif
                            <i data-lucide="arrow-up-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm leading-tight">{{ $category->name }}</p>
                            <p class="text-[11px] text-white/75 mt-0.5">{{ $category->courses_count ?? 0 }} students</p>
                        </div>
                    </a>
                @endforeach
            @endfor
        </div>
    </div>

    <div class="marquee-row overflow-hidden">
        <div class="marquee-track reverse" id="subjects-row-2">
            @php $defaultIndex = 0; @endphp
            @for($i = 0; $i < 3; $i++)
                @foreach($courseCategories->reverse() as $category)
                    @php
                        if (isset($gradientMap[$category->name])) {
                            $gradientClass = $gradientMap[$category->name];
                        } else {
                            $color = $defaultColors[$defaultIndex % count($defaultColors)];
                            $gradientClass = 'from-[' . $color['from'] . '] to-[' . $color['to'] . ']';
                            $defaultIndex++;
                        }
                    @endphp
                    <a href="{{ route('courses', ['category' => $category->name]) }}"
                       class="group shrink-0 w-[170px] h-[112px] mx-3 rounded-2xl bg-gradient-to-br {{ $gradientClass }} p-4 flex flex-col justify-between text-white shadow-lg hover:-translate-y-1.5 hover:shadow-2xl transition-all duration-300">
                        <div class="flex items-center justify-between">
                            @if($category->icon)
                                <i class="{{ $category->icon }} text-xl text-white/90"></i>
                            @else
                                <i data-lucide="book-open" class="w-6 h-6"></i>
                            @endif
                            <i data-lucide="arrow-up-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </div>
                        <div>
                            <p class="font-bold text-sm leading-tight">{{ $category->name }}</p>
                            <p class="text-[11px] text-white/75 mt-0.5">{{ $category->courses_count ?? 0 }} students</p>
                        </div>
                    </a>
                @endforeach
            @endfor
        </div>
    </div>
</section>

<!-- ============================= STATS ============================= -->
<section class="py-20 bg-[#EEF7FF]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-0 md:divide-x md:divide-[#CBDFF7] text-center stagger-parent">
            <div class="stagger-item px-4">
                <p class="text-4xl sm:text-5xl font-extrabold text-[#2563EB]">100K+</p>
                <p class="text-[#475569] font-medium mt-2 text-sm sm:text-base">Students</p>
            </div>
            <div class="stagger-item px-4">
                <p class="text-4xl sm:text-5xl font-extrabold text-[#2563EB]">500+</p>
                <p class="text-[#475569] font-medium mt-2 text-sm sm:text-base">Video Lectures</p>
            </div>
            <div class="stagger-item px-4">
                <p class="text-4xl sm:text-5xl font-extrabold text-[#2563EB]">20+</p>
                <p class="text-[#475569] font-medium mt-2 text-sm sm:text-base">Expert Teachers</p>
            </div>
            <div class="stagger-item px-4">
                <p class="text-4xl sm:text-5xl font-extrabold text-[#2563EB]">95%</p>
                <p class="text-[#475569] font-medium mt-2 text-sm sm:text-base">Success Rate</p>
            </div>
        </div>
    </div>
</section>

<!-- ============================= FEATURED BOOK ============================= -->
<section class="relative py-24 overflow-hidden bg-white">
    <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-[#DBEAFE] to-transparent opacity-70 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-16 items-center relative z-10">
        <div class="flex justify-center fade-up">
            <div class="book-scene">
                <div class="book-wrapper" style="transform: rotateX(4deg) rotateY(18deg); animation-delay:0.4s;">
                    <div class="book" style="width:320px; height:430px;">
                        <div class="book-spine" style="height:430px;"><span>CHEMISTRY · MEDICAL.PK</span></div>
                        <div class="book-pages"></div>
                        <div class="book-page p2"></div>
                        <div class="book-page p1"></div>
                        <div class="book-page p0"></div>
                        <div class="book-cover-front">
                            <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="#FBBF24" stroke-width="1.4" class="mb-1">
                                <circle cx="12" cy="12" r="9"/>
                                <circle cx="12" cy="12" r="2" fill="#FBBF24"/>
                                <ellipse cx="12" cy="12" rx="9" ry="3.4" transform="rotate(45 12 12)"/>
                                <ellipse cx="12" cy="12" rx="9" ry="3.4" transform="rotate(-45 12 12)"/>
                            </svg>
                            <p class="text-white/60 text-[10px] tracking-[0.35em] font-semibold">MEDICAL.PK</p>
                            <h3 class="text-white text-4xl font-extrabold tracking-wide">CHEMISTRY</h3>
                            <p class="text-[#FBBF24] text-xs tracking-[0.3em] font-bold">MDCAT PREP</p>
                            <div class="w-14 h-[2px] bg-[#FBBF24]/70 my-1"></div>
                            <p class="text-white/50 text-[10px] tracking-widest">VOLUME I · ORGANIC &amp; INORGANIC</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fade-up" style="animation-delay:.15s">
            <span class="badge-pill mb-4">Bestselling Book</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] mb-3">Doctor Chemistry</h2>
            <p class="text-[#475569] mb-4">The definitive Chemistry companion for MDCAT &amp; FSc students — 640 pages of concept clarity, solved past papers and 3,200+ practice MCQs.</p>
            <div class="flex items-center gap-2 mb-6">
                <div class="flex text-[#FBBF24]">
                    @for($i = 0; $i < 5; $i++)
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    @endfor
                </div>
                <span class="font-bold text-[#0F172A]">4.8/5</span>
                <span class="text-[#64748B] text-sm">(3,240 reviews)</span>
            </div>
            <div class="flex flex-wrap gap-3 mb-8">
                <a href="#" class="btn-primary">Buy Now — PKR 1,899</a>
                <a href="#" class="btn-outline">Preview</a>
                <a href="#" class="btn-ghost">Read Sample</a>
            </div>
            <div class="space-y-3">
                <div class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i><p class="text-[#475569] text-sm">Complete FSc Part I &amp; II Chemistry syllabus</p></div>
                <div class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i><p class="text-[#475569] text-sm">3,200+ MDCAT-style practice MCQs with solutions</p></div>
                <div class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i><p class="text-[#475569] text-sm">Past paper breakdown from 2015–2024</p></div>
                <div class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i><p class="text-[#475569] text-sm">Quick-revision formula sheets for exam week</p></div>
                <div class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2563EB] mt-0.5 shrink-0"></i><p class="text-[#475569] text-sm">Free lifetime updates for new exam patterns</p></div>
            </div>
        </div>
    </div>
</section>

<!-- ============================= WHY MEDICAL.PK ============================= -->
<section class="py-24 bg-[#F8FBFF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-16 fade-up">
            <span class="badge-pill mb-4">Why Choose Us</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A]">Why 100,000+ Students Choose Us</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger-parent">
            @php
                $features = [
                    ['icon' => 'radio', 'title' => 'Live Classes', 'desc' => 'Interactive daily sessions with real-time Q&A from top faculty.'],
                    ['icon' => 'film', 'title' => 'Recorded Lectures', 'desc' => 'Rewatch anytime — 500+ HD video lectures across every subject.'],
                    ['icon' => 'list-checks', 'title' => 'Practice MCQs', 'desc' => '50,000+ topic-wise MCQs modeled on real exam difficulty.'],
                    ['icon' => 'file-text', 'title' => 'Notes & PDFs', 'desc' => 'Concise, exam-focused notes for every FSc & MDCAT chapter.'],
                    ['icon' => 'clipboard-check', 'title' => 'Mock Exams', 'desc' => 'Full-length timed mocks that replicate the real test-day pressure.'],
                    ['icon' => 'line-chart', 'title' => 'Progress Tracking', 'desc' => 'Detailed analytics showing your strengths and weak topics.'],
                    ['icon' => 'graduation-cap', 'title' => 'Expert Teachers', 'desc' => 'Learn from Pakistan\'s most trusted MDCAT & NUMS mentors.'],
                    ['icon' => 'smartphone', 'title' => 'Mobile App', 'desc' => 'Study on the go — download lectures and revise offline anywhere.'],
                ];
            @endphp
            @foreach($features as $feature)
                <div class="stagger-item card p-6">
                    <div class="w-12 h-12 rounded-xl bg-[#DBEAFE] flex items-center justify-center mb-4">
                        <i data-lucide="{{ $feature['icon'] }}" class="w-6 h-6 text-[#2563EB]"></i>
                    </div>
                    <h3 class="font-bold text-[#0F172A] mb-1">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-[#64748B]">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============================= POPULAR COURSES ============================= -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-12 fade-up">
            <div>
                <span class="badge-pill mb-4">Top Rated</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A]">Popular Courses</h2>
            </div>
            <a href="{{ route('courses') }}" class="hidden sm:flex items-center gap-1 text-[#2563EB] font-semibold hover:gap-2 transition-all">
                View All <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 stagger-parent">
            @foreach($featuredCourses as $course)
            <a href="{{ route('courses.detail', $course->id) }}" class="stagger-item card overflow-hidden flex flex-col group">
                <div class="h-44 bg-gradient-to-br from-[#2563EB] to-[#4338CA] relative flex items-center justify-center overflow-hidden">
                    @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                    @else
                        <i data-lucide="graduation-cap" class="w-16 h-16 text-white/25 absolute -right-3 -bottom-3"></i>
                        <span class="text-white font-bold text-lg px-6 text-center relative z-10">{{ $course->title }}</span>
                    @endif
                </div>
                <div class="p-5 flex flex-col gap-3 flex-1">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-xs flex items-center justify-center">
                                {{ $course->category->name[0] ?? 'C' }}
                            </div>
                            <span class="text-sm font-medium text-[#475569]">{{ $course->category->name ?? 'General' }}</span>
                        </div>
                        <span class="badge-pill !bg-amber-50 !text-amber-600 text-xs">★ {{ number_format(4.5 + (($course->id % 5) / 10), 1) }}</span>
                    </div>
                    <h3 class="font-bold text-[#0F172A] text-base leading-tight line-clamp-2">{{ $course->title }}</h3>
                    <div class="flex items-center gap-4 text-xs text-[#64748B]">
                        <span class="flex items-center gap-1"><i data-lucide="users" class="w-3.5 h-3.5"></i>{{ rand(100, 5000) }}</span>
                        <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5"></i>{{ $course->duration_minutes ? ceil($course->duration_minutes / 60) . ' Hours' : 'Flexible' }}</span>
                        <span class="badge-pill text-[10px] py-1">{{ ucfirst($course->level ?? 'All Levels') }}</span>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <div>
                            @if($course->discount_price)
                                <span class="text-xs text-[#64748B] line-through">Rs. {{ number_format($course->price) }}</span>
                                <br>
                                <span class="text-[#2563EB] font-bold">Rs. {{ number_format($course->discount_price) }}</span>
                            @else
                                <span class="text-[#2563EB] font-bold">Rs. {{ number_format($course->price) }}</span>
                            @endif
                        </div>
                        <span class="btn-primary text-sm px-4 py-2">View Course</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <a href="{{ route('courses') }}" class="sm:hidden flex items-center justify-center gap-1 text-[#2563EB] font-semibold mt-8">
            View All Courses <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>
</section>

<!-- ============================= YOUTUBE ============================= -->
<section class="py-24 bg-[#F8FBFF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-12 fade-up">
            <div>
                <span class="badge-pill mb-4">Free Content</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A]">Learn From Our YouTube Channel</h2>
            </div>
            <a href="https://youtube.com/yourchannel" target="_blank" class="hidden sm:flex items-center gap-1 text-[#2563EB] font-semibold hover:gap-2 transition-all">
                View All <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger-parent">
            @if($youtubeVideos && $youtubeVideos->count() > 0)
                @foreach($youtubeVideos as $video)
                    <div class="stagger-item card overflow-hidden group">
                        <div class="h-40 bg-gradient-to-br {{ $video->gradient }} relative overflow-hidden flex items-center justify-center cursor-pointer"
                             onclick="playVideo('{{ $video->embed_url }}', '{{ $video->title }}')">
                            @if($video->thumbnail_url)
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                            @endif
                            <div class="w-14 h-14 rounded-full bg-white/90 flex items-center justify-center shadow-lg absolute hover:scale-110 transition-transform duration-300">
                                <i data-lucide="play" class="w-6 h-6 text-[#2563EB] ml-0.5"></i>
                            </div>
                            @if($video->subject)
                                <span class="absolute bottom-3 left-3 text-white text-xs font-semibold bg-black/30 px-2 py-1 rounded-md">{{ $video->subject }}</span>
                            @endif
                            <span class="absolute top-3 right-3 text-white text-xs font-semibold bg-black/50 px-2 py-1 rounded-md">
                                <i data-lucide="clock" class="w-3 h-3 inline mr-1"></i>
                                {{ $video->video_duration ?? 'Watch' }}
                            </span>
                        </div>
                        <div class="p-4">
                            <p class="font-bold text-[#0F172A] text-sm leading-snug mb-1 line-clamp-2">{{ $video->title }}</p>
                            <p class="text-xs text-[#64748B] mb-3">{{ $video->views ?? 'Watch Now' }}</p>
                            <span class="text-xs font-semibold text-[#2563EB] flex items-center gap-1">
                                <i data-lucide="play" class="w-3 h-3"></i>
                                Click to Play
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-12">
                    <i data-lucide="youtube" class="w-16 h-16 text-[#94A3B8] mx-auto mb-4"></i>
                    <p class="text-[#64748B]">No videos available yet. Check back soon!</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Video Modal -->
<div id="videoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="relative w-full max-w-4xl bg-black rounded-2xl overflow-hidden">
        <!-- Close Button -->
        <button onclick="closeVideo()" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-black/50 text-white hover:bg-black/70 transition-colors flex items-center justify-center">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        
        <!-- Video Title -->
        <h3 id="videoModalTitle" class="absolute top-4 left-4 z-10 text-white font-bold text-lg truncate max-w-[70%]"></h3>
        
        <!-- Iframe -->
        <div class="relative pb-[56.25%] h-0">
            <iframe id="videoIframe" class="absolute top-0 left-0 w-full h-full" frameborder="0" allowfullscreen
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
        
        <!-- Video Info -->
        <div class="p-4 bg-[#1a1a1a] text-white/80 text-sm flex items-center gap-4">
            <span class="flex items-center gap-1">
                <i data-lucide="eye" class="w-4 h-4"></i>
                <span id="videoViews">0 views</span>
            </span>
            <span class="flex items-center gap-1">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                <span id="videoDate">Today</span>
            </span>
        </div>
    </div>
</div>

<script>
    function playVideo(embedUrl, title) {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoIframe');
        const modalTitle = document.getElementById('videoModalTitle');
        
        // Set iframe src with autoplay
        iframe.src = embedUrl + '&autoplay=1';
        modalTitle.textContent = title;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeVideo() {
        const modal = document.getElementById('videoModal');
        const iframe = document.getElementById('videoIframe');
        
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        iframe.src = '';
        document.body.style.overflow = '';
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeVideo();
        }
    });

    // Close on click outside
    document.getElementById('videoModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideo();
        }
    });
</script>

<!-- ============================= TESTIMONIALS ============================= -->
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-14 fade-up">
            <span class="badge-pill mb-4">Success Stories</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A]">What Our Students Say</h2>
            <p class="text-[#64748B] mt-3 max-w-xl mx-auto">Real stories from students who achieved their medical dreams with us</p>
        </div>
    </div>

    <!-- Testimonials Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 stagger-parent">
            @php
                $testimonials = [
                    ['name' => 'Ahmed K.', 'uni' => 'NUST Medical College', 'text' => "Medical.pk's MDCAT course was phenomenal. The structured approach and daily MCQ practice helped me secure 185/200. I couldn't have done it without them.", 'initials' => 'AK', 'color' => '#2563EB'],
                    ['name' => 'Fatima S.', 'uni' => 'Aga Khan University', 'text' => 'The chemistry notes and video lectures are the clearest I\'ve found anywhere. My AKU result speaks for itself — thank you Medical.pk!', 'initials' => 'FS', 'color' => '#0D9488'],
                    ['name' => 'Bilal R.', 'uni' => 'King Edward Medical', 'text' => 'From struggling with organic chemistry to acing my MDCAT in just 3 months. The mock tests were incredibly accurate to the real exam.', 'initials' => 'BR', 'color' => '#DC2626'],
                    ['name' => 'Zara M.', 'uni' => 'Allama Iqbal Medical', 'text' => 'I used 4 different platforms before Medical.pk. Nothing comes close to the quality of teaching and the sheer volume of practice material here.', 'initials' => 'ZM', 'color' => '#7C3AED'],
                    ['name' => 'Hassan A.', 'uni' => 'Dow University', 'text' => 'The live classes are on a different level. Teachers actually respond to questions and the recorded sessions mean I never miss anything important.', 'initials' => 'HA', 'color' => '#D97706'],
                    ['name' => 'Sana T.', 'uni' => 'CMH Lahore Medical', 'text' => '100% recommend Medical.pk to any pre-med student. The progress tracking showed me exactly where I needed to improve. Best investment I ever made.', 'initials' => 'ST', 'color' => '#DB2777'],
                ];
            @endphp
            @foreach($testimonials as $testimonial)
                <div class="stagger-item card p-6 h-full flex flex-col">
                    <div class="flex gap-0.5 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="#FBBF24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                        @endfor
                    </div>
                    <p class="text-sm text-[#475569] leading-relaxed mb-6 flex-1">"{{ $testimonial['text'] }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full flex items-center justify-center text-white font-bold text-sm" style="background:{{ $testimonial['color'] }}">{{ $testimonial['initials'] }}</div>
                        <div>
                            <p class="font-bold text-[#0F172A] text-sm">{{ $testimonial['name'] }}</p>
                            <p class="text-xs text-[#64748B]">{{ $testimonial['uni'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============================= FAQ ============================= -->
<section class="py-24 bg-[#F8FBFF]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 fade-up">
            <span class="badge-pill mb-4">Got Questions?</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#0F172A]">Frequently Asked Questions</h2>
        </div>
        <div class="fade-up">
            @if($faqs && $faqs->count() > 0)
                @foreach($faqs as $index => $faq)
                    <div class="faq-item py-2 border-b border-[#E2E8F0] last:border-0">
                        <button class="faq-question w-full flex items-center justify-between gap-4 py-4 text-left" onclick="toggleFaq({{ $index }})">
                            <span class="font-semibold text-[#0F172A]">{{ $faq->question }}</span>
                            <i data-lucide="chevron-down" class="faq-chevron-{{ $index }} w-5 h-5 text-[#2563EB] shrink-0 transition-transform"></i>
                        </button>
                        <div class="faq-answer-{{ $index }}" style="display: none;">
                            <p class="text-[#475569] text-sm pb-5 pr-8">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-8">
                    <p class="text-[#64748B]">No FAQs available yet. Check back soon!</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- ============================= NEWSLETTER ============================= -->
<section class="relative py-24 overflow-hidden" style="background: linear-gradient(120deg, #1e40af, #2563eb);">
    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Start Your Medical Journey Today</h2>
        <p class="text-blue-100 mb-8">Join 100,000+ students already learning smarter with Medical.pk. Get free notes, MCQs and exam alerts straight to your inbox.</p>
        <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
            @csrf
            <input type="email" name="email" required placeholder="Enter your email address" class="flex-1 px-5 py-3.5 rounded-xl border-0 focus:outline-none focus:ring-4 focus:ring-white/30 text-[#0F172A]">
            <button type="submit" class="bg-white text-[#1D4ED8] font-bold px-7 py-3.5 rounded-xl hover:bg-blue-50 transition-all hover:-translate-y-0.5">Subscribe</button>
        </form>
        @if(session('newsletter_success'))
            <p class="text-blue-100 mt-4 text-sm font-medium">{{ session('newsletter_success') }}</p>
        @endif
    </div>
</section>

<!-- ============================= FOOTER ============================= -->
@include('frontend.partials.footer')

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    // ===== FAQ Toggle =====
    function toggleFaq(index) {
        const answer = document.querySelector('.faq-answer-' + index);
        const chevron = document.querySelector('.faq-chevron-' + index);
        if (answer.style.display === 'none') {
            answer.style.display = 'block';
            chevron.style.transform = 'rotate(180deg)';
        } else {
            answer.style.display = 'none';
            chevron.style.transform = 'rotate(0deg)';
        }
    }

    // ===== Mouse tilt for hero book =====
    document.addEventListener('mousemove', (e) => {
        const book = document.getElementById('book-wrapper');
        if (!book) return;
        const cx = window.innerWidth / 2;
        const cy = window.innerHeight / 2;
        const rx = ((e.clientY - cy) / cy) * -8;
        const ry = ((e.clientX - cx) / cx) * 10;
        book.style.transform = `rotateX(${6 + rx}deg) rotateY(${-24 + ry}deg)`;
    });

    // ===== Newsletter form =====
    document.querySelector('#newsletter-form')?.addEventListener('submit', (e) => {
        e.preventDefault();
        // Show success message (you can also submit via AJAX)
        const successMsg = document.createElement('p');
        successMsg.className = 'text-blue-100 mt-4 text-sm font-medium';
        successMsg.textContent = 'Thanks for subscribing! Check your inbox for a confirmation email.';
        e.target.parentNode.appendChild(successMsg);
        e.target.reset();
    });

    if (window.lucide) lucide.createIcons();
</script>
</body>
</html>
