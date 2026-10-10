@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

<!-- NAVBAR -->
@include('frontend.partials.nav-bar')

<!-- PAGE HERO -->
<section class="page-hero pt-36 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <span class="badge-pill mb-5">{{ $blogs->total() }} Articles Available</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] mb-4">Medical.pk Blog</h1>
        <p class="text-[#475569] max-w-xl mx-auto mb-10">Strategy guides, subject breakdowns and study tips from the faculty behind Pakistan's top MDCAT results.</p>

        <!-- Search Form -->
        <form method="GET" action="{{ route('blog') }}" class="max-w-xl mx-auto relative">
            <i data-lucide="search" class="w-5 h-5 text-[#94A3B8] absolute left-4 top-1/2 -translate-y-1/2"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search articles..."
                class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-[#E2E8F0] bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A]"
            >
        </form>
    </div>
</section>

<!-- FEATURED POST -->
@if(isset($featuredPost) && $featuredPost)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <a href="{{ route('blog.detail', $featuredPost->id) }}" class="fade-up card overflow-hidden grid md:grid-cols-2 group transition-all duration-300 hover:shadow-xl">
            <div class="h-64 md:h-auto bg-gradient-to-br
                @if($featuredPost->category && $featuredPost->category->name == 'MDCAT Prep') from-[#2563EB] to-[#4338CA]
                @elseif($featuredPost->category && $featuredPost->category->name == 'Biology') from-[#16A34A] to-[#0D9488]
                @elseif($featuredPost->category && $featuredPost->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                @elseif($featuredPost->category && $featuredPost->category->name == 'Physics') from-[#EA580C] to-[#DC2626]
                @elseif($featuredPost->category && $featuredPost->category->name == 'Study Tips') from-[#0891B2] to-[#2563EB]
                @elseif($featuredPost->category && $featuredPost->category->name == 'Admissions') from-[#7C3AED] to-[#6D28D9]
                @else from-[#2563EB] to-[#4338CA]
                @endif
                relative flex items-center justify-center p-10">
                @if($featuredPost->image && $featuredPost->image != 'blog/article/no_img.jpg')
                    <img src="{{ asset('storage/' . $featuredPost->image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover absolute inset-0">
                @else
                    <i data-lucide="newspaper" class="w-24 h-24 text-white/20"></i>
                @endif
                <span class="badge-pill !bg-white/20 !text-white absolute top-6 left-6 text-xs backdrop-blur-sm">Featured</span>
            </div>
            <div class="p-8 md:p-10 flex flex-col justify-center">
                <span class="badge-pill w-fit mb-4 text-xs">{{ $featuredPost->category->name ?? 'General' }}</span>
                <h2 class="text-2xl font-extrabold text-[#0F172A] mb-3 leading-snug group-hover:text-[#2563EB] transition-colors">
                    {{ $featuredPost->title }}
                </h2>
                <p class="text-[#475569] text-sm mb-6 line-clamp-3">
                    {{ Str::limit($featuredPost->description ?? $featuredPost->meta_desc ?? 'Read more about this topic.', 150) }}
                </p>
                <div class="flex items-center gap-3 mb-6 text-sm text-[#64748B]">
                    <div class="w-8 h-8 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-xs flex items-center justify-center">
                        {{ $featuredPost->category->name[0] ?? 'C' }}
                    </div>
                    <span>{{ $featuredPost->category->name ?? 'Admin' }}</span>
                    <span>·</span>
                    <span>{{ $featuredPost->created_at->format('M d, Y') }}</span>
                    <span>·</span>
                    <span>{{ rand(4, 12) }} min read</span>
                </div>
                <span class="text-[#2563EB] font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">
                    Read Article <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </span>
            </div>
        </a>
    </div>
</section>
@endif

<!-- CATEGORY FILTER -->
<section class="pb-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="filter-bar flex flex-wrap gap-3">
            <a href="{{ route('blog') }}" class="filter-pill {{ !request('category') ? 'active' : '' }}">All</a>
            @foreach($categories as $category)
                <a href="{{ route('blog', ['category' => $category->title]) }}"
                   class="filter-pill {{ request('category') == $category->title ? 'active' : '' }}">
                    {{ $category->title }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- BLOG GRID -->
<section class="py-8 pb-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        @if($blogs->count() > 0)
            <div id="blog-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $post)
                <a href="{{ route('blog.detail', $post->id) }}" class="blog-card card overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl">
                    <div class="h-40 bg-gradient-to-br
                        @if($post->category && $post->category->name == 'MDCAT Prep') from-[#2563EB] to-[#4338CA]
                        @elseif($post->category && $post->category->name == 'Biology') from-[#16A34A] to-[#0D9488]
                        @elseif($post->category && $post->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                        @elseif($post->category && $post->category->name == 'Physics') from-[#EA580C] to-[#DC2626]
                        @elseif($post->category && $post->category->name == 'Study Tips') from-[#0891B2] to-[#2563EB]
                        @elseif($post->category && $post->category->name == 'Admissions') from-[#7C3AED] to-[#6D28D9]
                        @else from-[#2563EB] to-[#4338CA]
                        @endif
                        relative flex items-end p-4">
                        @if($post->image && $post->image != 'blog/article/no_img.jpg')
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover absolute inset-0">
                        @endif
                        <span class="badge-pill !bg-white/85 text-xs relative z-10">{{ $post->category->name ?? 'General' }}</span>
                    </div>
                    <div class="p-5 flex flex-col gap-2 flex-1">
                        <h3 class="font-bold text-[#0F172A] leading-snug line-clamp-2 group-hover:text-[#2563EB] transition-colors">
                            {{ $post->title }}
                        </h3>
                        <p class="text-sm text-[#64748B] line-clamp-3">
                            {{ Str::limit($post->description ?? $post->meta_desc ?? 'Read more about this topic.', 100) }}
                        </p>
                        <div class="flex items-center gap-2 text-xs text-[#64748B] mt-2">
                            <div class="w-6 h-6 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-[10px] flex items-center justify-center">
                                {{ $post->category->name[0] ?? 'C' }}
                            </div>
                            <span>{{ $post->category->name ?? 'Admin' }}</span>
                            <span>·</span>
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                            <span>·</span>
                            <span>{{ rand(4, 12) }} min</span>
                        </div>
                        <span class="mt-auto text-[#2563EB] font-semibold text-sm flex items-center gap-1 group-hover:gap-2 transition-all pt-2">
                            Read Article <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                @if ($blogs->hasPages())
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="text-sm text-[#64748B]">
                            Showing
                            <span class="font-medium">{{ $blogs->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $blogs->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $blogs->total() }}</span>
                            results
                        </div>
                        <nav class="flex items-center gap-1" aria-label="Pagination">
                            {{-- Previous Page Link --}}
                            @if ($blogs->onFirstPage())
                                <span class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#94A3B8] cursor-not-allowed">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </span>
                            @else
                                <a href="{{ $blogs->previousPageUrl() }}" class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($blogs->links()->elements as $element)
                                @if (is_string($element))
                                    <span class="px-3 py-2 text-[#94A3B8]">{{ $element }}</span>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $blogs->currentPage())
                                            <span class="px-4 py-2 rounded-lg bg-[#2563EB] text-white font-medium">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">{{ $page }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($blogs->hasMorePages())
                                <a href="{{ $blogs->nextPageUrl() }}" class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">
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
                <h3 class="text-xl font-semibold text-[#0F172A] mb-2">No Articles Found</h3>
                <p class="text-[#64748B]">Try adjusting your search or filter criteria.</p>
                <a href="{{ route('blog') }}" class="btn-primary mt-4 inline-block">View All Articles</a>
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
