<!-- ===== TOP HEADER ===== -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-40">
    <div class="flex items-center justify-between px-4 md:px-6 py-3 md:py-4">
        <!-- Left Section -->
        <div class="flex items-center gap-3">
            <!-- Mobile Sidebar Toggle -->
            <button id="sidebarToggle" onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i class="fas fa-bars text-gray-600 text-lg"></i>
            </button>

            <!-- Logo (Mobile) -->
            <a href="{{ route('student.dashboard') }}" class="md:hidden flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-sm"></i>
                </div>
                <span class="font-bold text-gray-800 text-sm">Medical.pk</span>
            </a>

            <!-- Breadcrumb (Desktop) -->
            <div class="hidden md:flex items-center gap-2 text-sm">
                <span class="text-gray-400">/</span>
                <span class="text-gray-600 font-medium">@yield('page_title', 'Dashboard')</span>
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex items-center gap-2 md:gap-4">
            <!-- Search (Desktop) -->
            <div class="hidden md:flex items-center bg-gray-50 rounded-lg px-3 py-2 border border-gray-200">
                <i class="fas fa-search text-gray-400 text-sm"></i>
                <input type="text" placeholder="Search..." class="bg-transparent border-none focus:outline-none text-sm text-gray-600 w-40 ml-2 placeholder-gray-400">
            </div>

            <!-- Notifications -->
            <div class="relative">
                <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors relative">
                    <i class="fas fa-bell text-gray-600 text-lg"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
            </div>

            <!-- User Menu (Desktop) -->
            <div class="hidden md:flex items-center gap-3 border-l border-gray-200 pl-4">
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'Student' }}</p>
                    <p class="text-xs text-gray-500">Student</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 2)) }}
                </div>
            </div>

            <!-- Mobile User Avatar -->
            <div class="md:hidden w-8 h-8 rounded-full bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center text-white font-bold text-xs">
                {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 2)) }}
            </div>
        </div>
    </div>
</header>
