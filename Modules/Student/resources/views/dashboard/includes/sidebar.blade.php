<!-- ===== SIDEBAR ===== -->
<!-- Desktop Sidebar -->
<aside class="hidden md:flex fixed top-0 left-0 h-full w-64 bg-white border-r border-gray-200 z-50 flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-gray-100">
        <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center">
                <i class="fas fa-graduation-cap text-white text-lg"></i>
            </div>
            <div>
                <span class="font-extrabold text-gray-800 text-lg">Medical.pk</span>
                <p class="text-xs text-gray-500">Student Panel</p>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 overflow-y-auto">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Main Menu</p>

        <ul class="space-y-1">
            <li>
                <a href="{{ route('student.dashboard') }}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200">
                    <i class="fas fa-th-large text-sm"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('student.courses') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-600 transition-all duration-200">
                    <i class="fas fa-book-open text-sm"></i>
                    My Courses
                </a>
            </li>
            <li>
                <a href="{{ route('student.notes') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-600 transition-all duration-200">
                    <i class="fas fa-sticky-note text-sm"></i>
                    My Notes
                </a>
            </li>
            <li>
                <a href="{{ route('student.tests') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-600 transition-all duration-200">
                    <i class="fas fa-tasks text-sm"></i>
                    Tests
                </a>
            </li>
 <li>
            <a class="flex items-center gap-md px-4 py-3 font-label-md text-sm {{ request()->routeIs('student.orders*') ? 'bg-[#2563EB] text-white' : 'text-[#475569] hover:text-[#0F172A] hover:bg-[#F8FAFC]' }} font-bold rounded-full transition-all duration-200 ease-in-out" href="{{ route('student.orders') }}">
                <span class="material-symbols-outlined {{ request()->routeIs('student.orders*') ? 'filled text-white' : 'text-[#64748B]' }}">shopping_bag</span>
                My Orders
            </a>
        </li>
        </ul>

        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-4">Account</p>

        <ul class="space-y-1">
            <li>
                <a href="{{ route('student.settings') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-600 transition-all duration-200">
                    <i class="fas fa-cog text-sm"></i>
                    Settings
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-all duration-200 w-full">
                        <i class="fas fa-sign-out-alt text-sm"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Footer -->
    <div class="p-4 border-t border-gray-100">
        <p class="text-xs text-gray-400 text-center">v1.0.0</p>
    </div>
</aside>

<!-- ===== MOBILE SIDEBAR (Slide-in) ===== -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-50 hidden md:hidden" onclick="toggleSidebar()"></div>

<aside id="mobileSidebar" class="fixed top-0 left-0 h-full w-72 bg-white z-50 -translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-lg"></i>
                </div>
                <div>
                    <span class="font-extrabold text-gray-800 text-lg">Medical.pk</span>
                    <p class="text-xs text-gray-500">Student Panel</p>
                </div>
            </a>
            <button onclick="toggleSidebar()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-times text-gray-600"></i>
            </button>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 overflow-y-auto">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('student.dashboard') }}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200">
                    <i class="fas fa-th-large text-sm"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('student.courses') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-600 transition-all duration-200">
                    <i class="fas fa-book-open text-sm"></i>
                    My Courses
                </a>
            </li>
            <li>
                <a href="{{ route('student.notes') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-600 transition-all duration-200">
                    <i class="fas fa-sticky-note text-sm"></i>
                    My Notes
                </a>
            </li>
            <li>
                <a href="{{ route('student.tests') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-600 transition-all duration-200">
                    <i class="fas fa-tasks text-sm"></i>
                    Tests
                </a>
            </li>
            <li>
    <a class="flex items-center gap-md px-4 py-3 font-label-md text-sm {{ request()->routeIs('student.orders*') ? 'bg-[#2563EB] text-white' : 'text-[#475569] hover:text-[#0F172A] hover:bg-[#F8FAFC]' }} font-bold rounded-full transition-all duration-200 ease-in-out" href="{{ route('student.orders') }}">
        <span class="material-symbols-outlined {{ request()->routeIs('student.orders*') ? 'filled text-white' : 'text-[#64748B]' }}">shopping_bag</span>
        My Orders
    </a>
</li>
            <li>
                <a href="{{ route('student.settings') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-600 transition-all duration-200">
                    <i class="fas fa-cog text-sm"></i>
                    Settings
                </a>
            </li>
            <li class="pt-4 mt-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition-all duration-200 w-full">
                        <i class="fas fa-sign-out-alt text-sm"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Footer -->
    <div class="p-4 border-t border-gray-100">
        <p class="text-xs text-gray-400 text-center">v1.0.0</p>
    </div>
</aside>
