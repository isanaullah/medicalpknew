@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- PAGE HERO -->
<section class="page-hero pt-36 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <span class="badge-pill mb-5">{{ $notes->total() }} Notes Available</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] mb-4">Study Notes & Resources</h1>
        <p class="text-[#475569] max-w-xl mx-auto mb-10">Access comprehensive study materials, video lectures, and practice resources for your exam preparation.</p>

        <!-- Search Form -->
        <form method="GET" action="{{ route('notes') }}" class="max-w-xl mx-auto relative">
            <i data-lucide="search" class="w-5 h-5 text-[#94A3B8] absolute left-4 top-1/2 -translate-y-1/2"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search notes, topics, subjects..."
                class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-[#E2E8F0] bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A]"
            >
        </form>
    </div>
</section>

<!-- FILTERS -->
<br>
<section class="pb-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('notes') }}" class="filter-pill {{ !request('type') ? 'active' : '' }}">All Types</a>
            @foreach($noteTypes as $type)
                <a href="{{ route('notes', ['type' => $type]) }}"
                   class="filter-pill {{ request('type') == $type ? 'active' : '' }}">
                    <i data-lucide="{{ $type == 'text' ? 'file-text' : ($type == 'pdf' ? 'file' : ($type == 'video' ? 'video' : ($type == 'audio' ? 'music' : ($type == 'quiz' ? 'help-circle' : 'clipboard')))) }}"
                       class="w-4 h-4 inline mr-1"></i>
                    {{ ucfirst($type) }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- NOTES GRID -->
<section class="py-8 pb-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        @if($notes->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($notes as $note)
                    @php
                        $isFree = $note->is_free_preview == 1;
                        $iconMap = [
                            'text' => 'file-text',
                            'pdf' => 'file',
                            'video' => 'video',
                            'audio' => 'music',
                            'quiz' => 'help-circle',
                            'assignment' => 'clipboard'
                        ];
                        $icon = $iconMap[$note->type] ?? 'file-text';
                    @endphp

                    @if($isFree)
                        <!-- Free Note - Clickable -->
                        <a href="{{ route('notes.detail', $note->id) }}" class="card overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl">
                            <!-- Image / Icon -->
                            <div class="h-44 bg-gradient-to-br
                                @if($note->type == 'text') from-[#2563EB] to-[#4338CA]
                                @elseif($note->type == 'pdf') from-[#DC2626] to-[#991B1B]
                                @elseif($note->type == 'video') from-[#7C3AED] to-[#4F46E5]
                                @elseif($note->type == 'audio') from-[#059669] to-[#0891B2]
                                @elseif($note->type == 'quiz') from-[#D97706] to-[#EA580C]
                                @elseif($note->type == 'assignment') from-[#DB2777] to-[#BE185D]
                                @else from-[#2563EB] to-[#4338CA]
                                @endif
                                relative flex items-center justify-center overflow-hidden">
                                @if($note->featured_image)
                                    <img src="{{ asset('storage/notes/images/' . $note->featured_image) }}" alt="{{ $note->title }}" class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="{{ $icon }}" class="w-16 h-16 text-white/30"></i>
                                    <span class="absolute bottom-3 left-3 text-white/80 text-xs font-medium bg-black/20 px-3 py-1 rounded-full backdrop-blur-sm">
                                        {{ ucfirst($note->type) }}
                                    </span>
                                @endif
                                <!-- Free Badge -->
                                <span class="absolute top-3 right-3 badge-pill !bg-green-500 !text-white text-xs">
                                    <i data-lucide="unlock" class="w-3 h-3 inline mr-1"></i>
                                    Free
                                </span>
                                @if($note->file_path)
                                    <span class="absolute bottom-3 right-3 text-white/80 text-xs bg-black/20 px-3 py-1 rounded-full backdrop-blur-sm">
                                        <i data-lucide="download" class="w-3 h-3 inline mr-1"></i>
                                        {{ $note->file_size ?? 'File' }}
                                    </span>
                                @endif
                                @if($note->video_url)
                                    <span class="absolute bottom-3 right-3 text-white/80 text-xs bg-black/20 px-3 py-1 rounded-full backdrop-blur-sm">
                                        <i data-lucide="play" class="w-3 h-3 inline mr-1"></i>
                                        {{ $note->video_duration ?? 'Video' }}
                                    </span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex flex-col gap-2 flex-1">
                                <div class="flex items-center gap-2">
                                    <span class="badge-pill text-xs">
                                        <i data-lucide="{{ $icon }}" class="w-3 h-3 inline mr-1"></i>
                                        {{ ucfirst($note->type) }}
                                    </span>
                                    @if($note->chapter && $note->chapter->course)
                                        <span class="text-xs text-[#64748B]">{{ Str::limit($note->chapter->course->title ?? 'Course', 20) }}</span>
                                    @endif
                                </div>

                                <h3 class="font-bold text-[#0F172A] text-base leading-tight line-clamp-2 group-hover:text-[#2563EB] transition-colors">
                                    {{ $note->title }}
                                </h3>

                                @if($note->excerpt)
                                    <p class="text-sm text-[#64748B] line-clamp-2">{{ Str::limit($note->excerpt, 80) }}</p>
                                @endif

                                <div class="flex items-center gap-4 text-xs text-[#64748B] mt-2">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        {{ number_format($note->views_count ?? 0) }}
                                    </span>
                                    @if($note->file_path)
                                        <span class="flex items-center gap-1">
                                            <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                            {{ number_format($note->downloads_count ?? 0) }}
                                        </span>
                                    @endif
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                        {{ $note->created_at->format('M d, Y') }}
                                    </span>
                                </div>

                                <span class="mt-2 btn-primary w-full text-center text-sm !py-2">
                                    @if($note->type == 'video')
                                        <i data-lucide="play" class="w-4 h-4 inline mr-1"></i>
                                        Watch Now
                                    @elseif($note->type == 'pdf' || $note->file_path)
                                        <i data-lucide="eye" class="w-4 h-4 inline mr-1"></i>
                                        View Document
                                    @elseif($note->type == 'quiz')
                                        <i data-lucide="help-circle" class="w-4 h-4 inline mr-1"></i>
                                        Take Quiz
                                    @else
                                        <i data-lucide="book-open" class="w-4 h-4 inline mr-1"></i>
                                        Read More
                                    @endif
                                </span>
                            </div>
                        </a>
                    @else
                        <!-- Paid Note - Locked with Buy Button -->
                        <div class="card overflow-hidden flex flex-col group transition-all duration-300 hover:shadow-xl relative opacity-90">
                            <!-- Lock Overlay -->
                            <div class="absolute inset-0 bg-black/5 pointer-events-none z-10"></div>

                            <!-- Image / Icon -->
                            <div class="h-44 bg-gradient-to-br
                                @if($note->type == 'text') from-[#2563EB] to-[#4338CA]
                                @elseif($note->type == 'pdf') from-[#DC2626] to-[#991B1B]
                                @elseif($note->type == 'video') from-[#7C3AED] to-[#4F46E5]
                                @elseif($note->type == 'audio') from-[#059669] to-[#0891B2]
                                @elseif($note->type == 'quiz') from-[#D97706] to-[#EA580C]
                                @elseif($note->type == 'assignment') from-[#DB2777] to-[#BE185D]
                                @else from-[#2563EB] to-[#4338CA]
                                @endif
                                relative flex items-center justify-center overflow-hidden">
                                @if($note->featured_image)
                                    <img src="{{ asset('storage/notes/images/' . $note->featured_image) }}" alt="{{ $note->title }}" class="w-full h-full object-cover opacity-70">
                                    <div class="absolute inset-0 bg-black/40"></div>
                                @else
                                    <i data-lucide="{{ $icon }}" class="w-16 h-16 text-white/30"></i>
                                    <span class="absolute bottom-3 left-3 text-white/80 text-xs font-medium bg-black/20 px-3 py-1 rounded-full backdrop-blur-sm">
                                        {{ ucfirst($note->type) }}
                                    </span>
                                @endif

                                <!-- Lock Icon -->
                                <div class="absolute inset-0 flex items-center justify-center z-20">
                                    <div class="bg-black/60 backdrop-blur-sm rounded-full p-4">
                                        <i data-lucide="lock" class="w-10 h-10 text-white"></i>
                                    </div>
                                </div>

                                <!-- Paid Badge -->
                                <span class="absolute top-3 right-3 badge-pill !bg-orange-500 !text-white text-xs z-20">
                                    <i data-lucide="lock" class="w-3 h-3 inline mr-1"></i>
                                    Paid
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex flex-col gap-2 flex-1 opacity-75">
                                <div class="flex items-center gap-2">
                                    <span class="badge-pill text-xs">
                                        <i data-lucide="{{ $icon }}" class="w-3 h-3 inline mr-1"></i>
                                        {{ ucfirst($note->type) }}
                                    </span>
                                    @if($note->chapter && $note->chapter->course)
                                        <span class="text-xs text-[#64748B]">{{ Str::limit($note->chapter->course->title ?? 'Course', 20) }}</span>
                                    @endif
                                </div>

                                <h3 class="font-bold text-[#0F172A] text-base leading-tight line-clamp-2">
                                    {{ $note->title }}
                                </h3>

                                @if($note->excerpt)
                                    <p class="text-sm text-[#64748B] line-clamp-2">{{ Str::limit($note->excerpt, 80) }}</p>
                                @endif

                                <div class="flex items-center gap-4 text-xs text-[#64748B] mt-2">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        {{ number_format($note->views_count ?? 0) }}
                                    </span>
                                    @if($note->file_path)
                                        <span class="flex items-center gap-1">
                                            <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                            {{ number_format($note->downloads_count ?? 0) }}
                                        </span>
                                    @endif
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                        {{ $note->created_at->format('M d, Y') }}
                                    </span>
                                </div>

                                <!-- Buy/Enroll Button -->
                                <button onclick="showBuyModal('{{ $note->title }}')" class="mt-2 bg-orange-500 hover:bg-orange-600 text-white w-full text-center text-sm !py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                    Buy to Access
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                @if ($notes->hasPages())
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="text-sm text-[#64748B]">
                            Showing
                            <span class="font-medium">{{ $notes->firstItem() }}</span>
                            to
                            <span class="font-medium">{{ $notes->lastItem() }}</span>
                            of
                            <span class="font-medium">{{ $notes->total() }}</span>
                            results
                        </div>
                        <nav class="flex items-center gap-1" aria-label="Pagination">
                            {{-- Previous Page Link --}}
                            @if ($notes->onFirstPage())
                                <span class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#94A3B8] cursor-not-allowed">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </span>
                            @else
                                <a href="{{ $notes->previousPageUrl() }}" class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($notes->links()->elements as $element)
                                @if (is_string($element))
                                    <span class="px-3 py-2 text-[#94A3B8]">{{ $element }}</span>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $notes->currentPage())
                                            <span class="px-4 py-2 rounded-lg bg-[#2563EB] text-white font-medium">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}" class="px-4 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">{{ $page }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($notes->hasMorePages())
                                <a href="{{ $notes->nextPageUrl() }}" class="px-3 py-2 rounded-lg border border-[#E2E8F0] text-[#475569] hover:bg-[#F8FAFC] transition-colors">
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
                <i data-lucide="file-text" class="w-16 h-16 text-[#94A3B8] mx-auto mb-4"></i>
                <h3 class="text-xl font-semibold text-[#0F172A] mb-2">No Notes Found</h3>
                <p class="text-[#64748B]">Try adjusting your search or filter criteria.</p>
                <a href="{{ route('notes') }}" class="btn-primary mt-4 inline-block">View All Notes</a>
            </div>
        @endif
    </div>
</section>

<!-- Buy Note Modal -->
<div id="buyModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl animate-fadeIn">
        <div class="text-center">
            <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center mx-auto mb-4">
                <i data-lucide="lock" class="w-8 h-8 text-orange-500"></i>
            </div>
            <h3 class="text-xl font-bold text-[#0F172A] mb-2">🔒 This Note is Locked</h3>
            <p class="text-[#64748B] text-sm mb-2">
                <strong class="text-[#0F172A]" id="lockedNoteTitle">"Note Title"</strong>
            </p>
            <p class="text-[#64748B] text-sm mb-6">
                This note requires enrollment in the course to access. Enroll now to unlock all study materials!
            </p>
            <div class="flex flex-col gap-3">
                <a href="{{ route('courses') }}" class="btn-primary w-full flex items-center justify-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    Browse Courses
                </a>
                <button onclick="closeBuyModal()" class="text-[#64748B] hover:text-[#0F172A] transition-colors text-sm font-medium">
                    Close
                </button>
            </div>
        </div>
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

    // Buy Modal Functions
    function showBuyModal(noteTitle) {
        document.getElementById('lockedNoteTitle').textContent = '"' + noteTitle + '"';
        document.getElementById('buyModal').classList.remove('hidden');
        document.getElementById('buyModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeBuyModal() {
        document.getElementById('buyModal').classList.add('hidden');
        document.getElementById('buyModal').classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeBuyModal();
    });

    // Close on click outside
    document.getElementById('buyModal').addEventListener('click', function(e) {
        if (e.target === this) closeBuyModal();
    });
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(10px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>
</body>
</html>
