<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 py-4 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl text-[#0F172A]">
            <div class="w-8 h-8 bg-[#2563EB] rounded-lg flex items-center justify-center">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <rect x="6" y="1" width="6" height="16" rx="2" fill="white"/>
                    <rect x="1" y="6" width="16" height="6" rx="2" fill="white"/>
                </svg>
            </div>
            Medical.pk
        </a>

        <div class="hidden md:flex items-center gap-8">
            <a href="{{ route('courses') }}" class="nav-link text-sm font-medium text-[#475569] hover:text-[#2563EB] transition-colors">Courses</a>
            <a href="{{ route('notes') }}" class="nav-link text-sm font-medium text-[#475569] hover:text-[#2563EB] transition-colors">Notes</a>
            <a href="{{ route('blog') }}" class="nav-link text-sm font-medium text-[#475569] hover:text-[#2563EB] transition-colors">Blog</a>
            <a href="{{ route('contact') }}" class="nav-link text-sm font-medium text-[#475569] hover:text-[#2563EB] transition-colors">Contact</a>
        </div>

        <div class="hidden md:flex items-center gap-3">
            <!-- Cart Icon with Count -->
            <a href="{{ route('cart.index') }}" class="relative text-[#475569] hover:text-[#2563EB] transition-colors">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                @php
                    $cart = session('cart', []);
                    $cartCount = 0;
                    foreach($cart as $item) {
                        $cartCount += $item['quantity'] ?? 1;
                    }
                @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @auth
                <a href="{{ route('student.dashboard') }}" class="text-sm font-semibold text-[#0F172A] px-4 py-2 hover:text-[#2563EB] transition-colors">
                    Dashboard
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-[#DC2626] px-4 py-2 hover:text-[#991B1B] transition-colors">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-[#0F172A] px-4 py-2 hover:text-[#2563EB] transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="btn-primary text-sm">Sign Up Free</a>
            @endauth
        </div>

        <button id="menu-toggle" class="md:hidden p-2 text-[#0F172A]">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-[#E2E8F0] shadow-xl">
        <div class="px-4 py-4 flex flex-col gap-4">
            <a href="{{ route('courses') }}" class="text-base font-medium text-[#0F172A] py-2 border-b border-[#E2E8F0]">Courses</a>
            <a href="{{ route('notes') }}" class="text-base font-medium text-[#0F172A] py-2 border-b border-[#E2E8F0]">Notes</a>
            <a href="{{ route('blog') }}" class="text-base font-medium text-[#0F172A] py-2 border-b border-[#E2E8F0]">Blog</a>
            <a href="{{ route('contact') }}" class="text-base font-medium text-[#0F172A] py-2 border-b border-[#E2E8F0]">Contact</a>

            <!-- Mobile Cart -->
            <a href="{{ route('cart.index') }}" class="flex items-center gap-2 text-base font-medium text-[#0F172A] py-2 border-b border-[#E2E8F0]">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                Cart
                @if($cartCount > 0)
                    <span class="bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @auth
                <a href="{{ route('student.dashboard') }}" class="text-base font-medium text-[#0F172A] py-2 border-b border-[#E2E8F0]">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-base font-medium text-[#DC2626] py-2 w-full text-left">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-base font-medium text-[#0F172A] py-2 border-b border-[#E2E8F0]">Log in</a>
                <a href="{{ route('register') }}" class="btn-primary text-center">Sign Up Free</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.getElementById('menu-toggle')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('bg-white', 'shadow-lg');
            navbar.classList.remove('bg-transparent');
        } else {
            navbar.classList.remove('bg-white', 'shadow-lg');
            navbar.classList.add('bg-transparent');
        }
    });
</script>
