@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

<!-- NAVBAR -->
@include('frontend.partials.nav-bar')

<!-- PAGE HERO -->
<section class="page-hero pt-36 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <span class="badge-pill mb-5">{{ $courses->total() }} Courses Available</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] mb-4">Explore All Courses</h1>
        <p class="text-[#475569] max-w-xl mx-auto mb-10">Structured, exam-focused courses for MDCAT, NUMS, ECAT and FSc — taught by Pakistan's most trusted faculty.</p>

        <!-- Search Form -->
        <form method="GET" action="{{ route('courses') }}" class="max-w-xl mx-auto relative mb-8">
            <i data-lucide="search" class="w-5 h-5 text-[#94A3B8] absolute left-4 top-1/2 -translate-y-1/2"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search courses, teachers, subjects..."
                class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-[#E2E8F0] bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A]"
            >
        </form>

        <!-- Filter Buttons -->
        <div class="filter-bar flex flex-wrap justify-center gap-3">
            <a href="{{ route('courses') }}" class="filter-pill {{ !request('category') ? 'active' : '' }}">All</a>
            @foreach($categories as $category)
                <a href="{{ route('courses', ['category' => $category->name]) }}"
                   class="filter-pill {{ request('category') == $category->name ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- COURSE GRID -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        @if($courses->count() > 0)
            <div id="course-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courses as $course)
                @php
                    $isEnrolled = in_array($course->id, $enrolledCourseIds ?? []);
                    $isFree = ($course->price == 0 || $course->price == null);
                @endphp
                <div class="course-card card overflow-hidden flex flex-col group transition-all duration-300">
                    <a href="{{ route('courses.detail', $course->id) }}" class="block">
                        <div class="h-48 bg-gradient-to-br
                            @if($course->category->name == 'MDCAT') from-[#2563EB] to-[#4338CA]
                            @elseif($course->category->name == 'NUMS') from-[#059669] to-[#0891B2]
                            @elseif($course->category->name == 'ECAT') from-[#D97706] to-[#EA580C]
                            @elseif($course->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                            @elseif($course->category->name == 'Physics') from-[#EA580C] to-[#DC2626]
                            @elseif($course->category->name == 'Biology') from-[#16A34A] to-[#0D9488]
                            @elseif($course->category->name == 'English') from-[#DB2777] to-[#BE185D]
                            @else from-[#2563EB] to-[#4338CA]
                            @endif
                            relative flex items-center justify-center overflow-hidden">
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                            @else
                                <i data-lucide="graduation-cap" class="w-20 h-20 text-white/20 absolute -right-4 -bottom-4"></i>
                                <span class="text-white font-bold text-lg px-6 text-center relative z-10 leading-snug">{{ $course->title }}</span>
                            @endif
                            <!-- Status Badge -->
                            @if($isEnrolled)
                                <span class="absolute top-3 right-3 badge-pill !bg-green-500 !text-white text-xs">
                                    <i data-lucide="check-circle" class="w-3 h-3 inline mr-1"></i>
                                    Enrolled
                                </span>
                            @elseif($isFree)
                                <span class="absolute top-3 right-3 badge-pill !bg-emerald-500 !text-white text-xs">
                                    <i data-lucide="unlock" class="w-3 h-3 inline mr-1"></i>
                                    Free
                                </span>
                            @endif
                        </div>
                    </a>
                    <div class="p-5 flex flex-col gap-3 flex-1">
                        <a href="{{ route('courses.detail', $course->id) }}" class="flex-1">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-xs flex items-center justify-center">
                                        {{ $course->category->name[0] ?? 'C' }}
                                    </div>
                                    <span class="text-sm font-medium text-[#475569]">{{ $course->category->name ?? 'General' }}</span>
                                </div>
                                <span class="badge-pill !bg-amber-50 !text-amber-600 text-xs">★ {{ number_format(4.5 + (($course->id % 5) / 10), 1) }}</span>
                            </div>
                            <h3 class="font-bold text-[#0F172A] text-base leading-tight line-clamp-2 mt-2">{{ $course->title }}</h3>
                            <div class="flex items-center gap-4 text-xs text-[#64748B] mt-2">
                                <span class="flex items-center gap-1">
                                    <i data-lucide="users" class="w-3.5 h-3.5"></i>
                                    {{ rand(100, 5000) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                    {{ $course->duration_minutes ? ceil($course->duration_minutes / 60) . ' Hours' : 'Flexible' }}
                                </span>
                                <span class="badge-pill text-[10px] py-1">{{ ucfirst($course->level ?? 'All Levels') }}</span>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div>
                                    @if($isFree)
                                        <span class="text-emerald-600 font-bold">Free</span>
                                    @elseif($course->discount_price)
                                        <span class="text-xs text-[#64748B] line-through">Rs. {{ number_format($course->price) }}</span>
                                        <br>
                                        <span class="text-[#2563EB] font-bold">Rs. {{ number_format($course->discount_price) }}</span>
                                    @else
                                        <span class="text-[#2563EB] font-bold">Rs. {{ number_format($course->price) }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>

                        <!-- Action Button -->
                        @if($isEnrolled)
                            <!-- Already Enrolled -->
                            <a href="{{ route('courses.detail', $course->id) }}" class="mt-2 bg-green-600 hover:bg-green-700 text-white w-full text-center text-sm !py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                                <i data-lucide="play" class="w-4 h-4"></i>
                                Continue Learning
                            </a>
                        @elseif($isFree)
                            <!-- Free Course - Enroll Now -->
                            <form action="{{ route('courses.enroll.free', $course->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-sm px-4 py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <i data-lucide="unlock" class="w-4 h-4"></i>
                                    Enroll Now - Free
                                </button>
                            </form>
                        @else
                            <!-- Paid Course - Add to Cart -->
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button type="submit" class="w-full btn-primary text-sm px-4 py-2 flex items-center justify-center gap-2">
                                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                    Add to Cart
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                @if ($courses->hasPages())
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="text-sm text-[#64748B]">
                            Showing
                            <span class="font-medium">{{ $courses->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $courses->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $courses->total() }}</span>
                            results
                        </div>
                        <nav class="flex items-center gap-1" aria-label="Pagination">
                            {{-- Previous Page Link --}}
                            @if ($courses->onFirstPage())
                                <span class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#94A3B8] cursor-not-allowed">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </span>
                            @else
                                <a href="{{ $courses->previousPageUrl() }}" class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($courses->links()->elements as $element)
                                @if (is_string($element))
                                    <span class="px-3 py-2 text-[#94A3B8]">{{ $element }}</span>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $courses->currentPage())
                                            <span class="px-4 py-2 rounded-lg bg-[#2563EB] text-white font-medium">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">{{ $page }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($courses->hasMorePages())
                                <a href="{{ $courses->nextPageUrl() }}" class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </a>
                            @else
                                <span class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#94A3B8] cursor-not-allowed">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </span>
                            @endif
                        </nav>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-16">
                <i data-lucide="book-open" class="w-16 h-16 text-[#94A3B8] mx-auto mb-4"></i>
                <h3 class="text-xl font-semibold text-[#0F172A] mb-2">No Courses Found</h3>
                <p class="text-[#64748B]">Try adjusting your search or filter criteria.</p>
                <a href="{{ route('courses') }}" class="btn-primary mt-4 inline-block">View All Courses</a>
            </div>
        @endif
    </div>
</section>

<!-- FOOTER -->
@include('frontend.partials.footer')

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    // Initialize Lucide icons
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>
</body>
</html>
