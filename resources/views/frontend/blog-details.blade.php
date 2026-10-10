@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- BLOG DETAIL -->
<section class="pt-28 pb-6 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="flex items-center gap-2 text-sm text-[#64748B]">
            <a href="{{ route('home') }}" class="hover:text-[#2563EB] transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('blog') }}" class="hover:text-[#2563EB] transition-colors">Blog</a>
            <span>/</span>
            <span class="text-[#0F172A] font-medium truncate max-w-xs">{{ Str::limit($blog->title, 30) }}</span>
        </div>
    </div>
</section>

<!-- ARTICLE HERO -->
<section class="h-[300px] flex items-center justify-center text-center px-4 relative overflow-hidden bg-gradient-to-br
    @if($blog->category && $blog->category->name == 'MDCAT Prep') from-[#2563EB] to-[#4338CA]
    @elseif($blog->category && $blog->category->name == 'Biology') from-[#16A34A] to-[#0D9488]
    @elseif($blog->category && $blog->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
    @elseif($blog->category && $blog->category->name == 'Physics') from-[#EA580C] to-[#DC2626]
    @elseif($blog->category && $blog->category->name == 'Study Tips') from-[#0891B2] to-[#2563EB]
    @elseif($blog->category && $blog->category->name == 'Admissions') from-[#7C3AED] to-[#6D28D9]
    @else from-[#2563EB] to-[#4338CA]
    @endif
">
    @if($blog->image && $blog->image != 'blog/article/no_img.jpg')
        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="absolute inset-0 w-full h-full object-cover opacity-30">
    @endif
    <div class="relative z-10 max-w-3xl">
        <span class="badge-pill !bg-white/20 !text-white mb-4 backdrop-blur-sm">{{ $blog->category->name ?? 'General' }}</span>
        <h1 class="text-2xl sm:text-4xl font-extrabold text-white leading-snug">{{ $blog->title }}</h1>
    </div>
</section>

<!-- ARTICLE META -->
<section class="py-6 border-b border-[#E2E8F0]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold flex items-center justify-center">
                {{ $blog->category->name[0] ?? 'C' }}
            </div>
            <div>
                <p class="font-semibold text-[#0F172A] text-sm">{{ $blog->category->name ?? 'Admin' }}</p>
                <p class="text-xs text-[#64748B]">
                    {{ $blog->created_at->format('M d, Y') }} · {{ rand(4, 12) }} min read · {{ number_format($blog->views_count ?? 0) }} views
                </p>
            </div>
        </div>
        <div class="flex gap-2">
            <button onclick="shareOnTwitter()" class="social-icon w-9 h-9 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] transition-colors">
                <i data-lucide="twitter" class="w-4 h-4 text-[#64748B]"></i>
            </button>
            <button onclick="shareOnFacebook()" class="social-icon w-9 h-9 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] transition-colors">
                <i data-lucide="facebook" class="w-4 h-4 text-[#64748B]"></i>
            </button>
            <button onclick="copyLink()" class="social-icon w-9 h-9 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] transition-colors">
                <i data-lucide="link" class="w-4 h-4 text-[#64748B]"></i>
            </button>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 grid lg:grid-cols-[1fr_18rem] gap-16">
        <!-- Article Body -->
        <article class="max-w-3xl prose-content text-[#475569] leading-relaxed space-y-6">
            @if($blog->description)
                {!! nl2br($blog->description) !!}
            @else
                <p>{{ $blog->title }} is one of the most common questions we get from students preparing for admission tests across Pakistan. In this guide, we break down exactly what the top scorers do differently — and how you can apply the same approach starting today.</p>
                <p>Whether you're just starting your preparation or entering the final stretch before exam day, the strategies below are drawn from years of data across thousands of students who've secured seats at top institutions.</p>

                <h2 id="section-1" class="text-2xl font-bold text-[#0F172A] pt-4">Understanding the Fundamentals</h2>
                <p>Before diving into advanced techniques, it's essential to have complete clarity on the fundamentals. Students often rush into solving past papers without first securing a strong conceptual base — this is the single biggest mistake we see year after year.</p>
                <p>Build your foundation chapter by chapter, testing your understanding with short quizzes before moving forward. This prevents gaps from compounding later in your preparation.</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Review core definitions and terminology before attempting problems</li>
                    <li>Use active recall instead of passive re-reading</li>
                    <li>Time-box each study session to maintain focus and retention</li>
                    <li>Revisit weak topics within 48 hours using spaced repetition</li>
                </ul>

                <blockquote class="border-l-4 border-[#2563EB] bg-[#EEF7FF] px-6 py-4 rounded-r-xl text-[#0F172A] font-medium">
                    "Students who scored in the top 5% consistently spent 30% more time on error analysis than on new content in their final month."
                </blockquote>

                <h2 id="section-2" class="text-2xl font-bold text-[#0F172A] pt-4">Building a Sustainable Routine</h2>
                <p>Consistency beats intensity. A realistic, repeatable daily routine will always outperform sporadic all-night cram sessions, both for retention and for your mental health during a demanding preparation period.</p>
                <p>Aim for daily targets that are specific and measurable — for example, "complete 50 MCQs and review all incorrect answers" rather than a vague goal like "study biology today."</p>
                <p>Finally, don't underestimate recovery. Sleep, short breaks, and one rest day per week are not luxuries — they are part of an effective preparation strategy that helps information consolidate in long-term memory.</p>
            @endif

            <!-- Tags (Optional) -->
            <div class="flex flex-wrap gap-2 pt-4 border-t border-[#E2E8F0]">
                <span class="text-xs font-semibold text-[#64748B]">Tags:</span>
                <span class="badge-pill text-xs">{{ $blog->category->name ?? 'General' }}</span>
                <span class="badge-pill text-xs">Exam Prep</span>
                <span class="badge-pill text-xs">Study Tips</span>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="space-y-6 h-fit lg:sticky lg:top-24">
            <!-- Table of Contents -->
            <div class="card p-5">
                <h4 class="font-bold text-[#0F172A] mb-3 text-sm">Table of Contents</h4>
                <ul id="toc-list" class="space-y-2 text-sm">
                    <li><a href="#section-1" class="text-[#475569] hover:text-[#2563EB] transition-colors">Understanding the Fundamentals</a></li>
                    <li><a href="#section-2" class="text-[#475569] hover:text-[#2563EB] transition-colors">Building a Sustainable Routine</a></li>
                </ul>
            </div>

            <!-- About the Author -->
            <div class="card p-5">
                <h4 class="font-bold text-[#0F172A] mb-3 text-sm">About the Author</h4>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-sm flex items-center justify-center">
                        {{ $blog->category->name[0] ?? 'C' }}
                    </div>
                    <p class="font-semibold text-[#0F172A] text-sm">{{ $blog->category->name ?? 'Admin' }}</p>
                </div>
                <p class="text-xs text-[#64748B] leading-relaxed">Senior faculty at Medical.pk with years of experience preparing students for MDCAT, NUMS and FSc board exams.</p>
            </div>

            <!-- Popular Posts -->
            <div class="card p-5">
                <h4 class="font-bold text-[#0F172A] mb-3 text-sm">Popular Posts</h4>
                <div class="space-y-3">
                    @foreach($popularPosts as $post)
                    <a href="{{ route('blog.detail', $post->id) }}" class="flex gap-3 group">
                        <div class="w-14 h-14 rounded-lg bg-gradient-to-br
                            @if($post->category && $post->category->name == 'MDCAT Prep') from-[#2563EB] to-[#4338CA]
                            @elseif($post->category && $post->category->name == 'Biology') from-[#16A34A] to-[#0D9488]
                            @elseif($post->category && $post->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                            @elseif($post->category && $post->category->name == 'Physics') from-[#EA580C] to-[#DC2626]
                            @elseif($post->category && $post->category->name == 'Study Tips') from-[#0891B2] to-[#2563EB]
                            @elseif($post->category && $post->category->name == 'Admissions') from-[#7C3AED] to-[#6D28D9]
                            @else from-[#2563EB] to-[#4338CA]
                            @endif
                            shrink-0 flex items-center justify-center">
                            @if($post->image && $post->image != 'blog/article/no_img.jpg')
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover rounded-lg">
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-[#0F172A] leading-snug line-clamp-2 group-hover:text-[#2563EB] transition-colors">
                                {{ $post->title }}
                            </p>
                            <p class="text-[10px] text-[#64748B] mt-1">{{ $post->created_at->format('M d, Y') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</section>

<!-- RELATED ARTICLES -->
@if($relatedPosts && $relatedPosts->count() > 0)
<section class="py-20 bg-[#F8FBFF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-2xl font-bold text-[#0F172A] mb-8 fade-up">Related Articles</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 stagger-parent">
            @foreach($relatedPosts as $post)
            <a href="{{ route('blog.detail', $post->id) }}" class="stagger-item card overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl">
                <div class="h-36 bg-gradient-to-br
                    @if($post->category && $post->category->name == 'MDCAT Prep') from-[#2563EB] to-[#4338CA]
                    @elseif($post->category && $post->category->name == 'Biology') from-[#16A34A] to-[#0D9488]
                    @elseif($post->category && $post->category->name == 'Chemistry') from-[#4F46E5] to-[#7C3AED]
                    @elseif($post->category && $post->category->name == 'Physics') from-[#EA580C] to-[#DC2626]
                    @elseif($post->category && $post->category->name == 'Study Tips') from-[#0891B2] to-[#2563EB]
                    @elseif($post->category && $post->category->name == 'Admissions') from-[#7C3AED] to-[#6D28D9]
                    @else from-[#2563EB] to-[#4338CA]
                    @endif
                    relative">
                    @if($post->image && $post->image != 'blog/article/no_img.jpg')
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-[#0F172A] text-sm leading-snug line-clamp-2 mb-2 group-hover:text-[#2563EB] transition-colors">
                        {{ $post->title }}
                    </h3>
                    <p class="text-xs text-[#64748B]">{{ $post->created_at->format('M d, Y') }} · {{ rand(4, 12) }} min read</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

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

    // Share functions
    function shareOnTwitter() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('{{ $blog->title }}');
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
    }

    function shareOnFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
    }

    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const btn = document.querySelector('.social-icon:last-child');
            const icon = btn.querySelector('i');
            icon.setAttribute('data-lucide', 'check');
            lucide.createIcons();
            setTimeout(() => {
                icon.setAttribute('data-lucide', 'link');
                lucide.createIcons();
            }, 2000);
        }).catch(() => {});
    }

    // Smooth scroll for TOC links
    document.querySelectorAll('#toc-list a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
</script>
</body>
</html>
