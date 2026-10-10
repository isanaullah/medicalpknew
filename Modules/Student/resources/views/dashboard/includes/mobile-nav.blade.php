<!-- ===== MOBILE BOTTOM NAVIGATION ===== -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40">
    <div class="flex items-center justify-around px-2 py-2">
        <a href="{{ route('student.dashboard') }}" class="mobile-nav flex flex-col items-center gap-0.5 px-3 py-1 rounded-lg transition-colors active">
            <div class="w-10 h-10 rounded-full bg-[#2563EB] text-white flex items-center justify-center">
                <i class="fas fa-home text-sm"></i>
            </div>
            <span class="text-[10px] font-medium text-gray-600">Home</span>
        </a>

        <a href="{{ route('student.courses') }}" class="mobile-nav flex flex-col items-center gap-0.5 px-3 py-1 rounded-lg transition-colors">
            <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center">
                <i class="fas fa-book-open text-sm"></i>
            </div>
            <span class="text-[10px] font-medium text-gray-600">Courses</span>
        </a>

        <a href="{{ route('student.notes') }}" class="mobile-nav flex flex-col items-center gap-0.5 px-3 py-1 rounded-lg transition-colors">
            <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center">
                <i class="fas fa-sticky-note text-sm"></i>
            </div>
            <span class="text-[10px] font-medium text-gray-600">Notes</span>
        </a>

        <a href="{{ route('student.tests') }}" class="mobile-nav flex flex-col items-center gap-0.5 px-3 py-1 rounded-lg transition-colors">
            <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center">
                <i class="fas fa-tasks text-sm"></i>
            </div>
            <span class="text-[10px] font-medium text-gray-600">Tests</span>
        </a>

        <a href="{{ route('student.settings') }}" class="mobile-nav flex flex-col items-center gap-0.5 px-3 py-1 rounded-lg transition-colors">
            <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center">
                <i class="fas fa-user text-sm"></i>
            </div>
            <span class="text-[10px] font-medium text-gray-600">Profile</span>
        </a>
    </div>
</nav>
