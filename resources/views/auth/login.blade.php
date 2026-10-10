@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- LOGIN SECTION -->
<section class="pt-36 pb-20 bg-white">
    <div class="max-w-md mx-auto px-4 sm:px-6">
        <div class="fade-up">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="log-in" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-[#0F172A]">Welcome Back</h1>
                <p class="text-[#64748B] mt-2">Sign in to continue your learning journey</p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
                <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
                    <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="card p-8">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-[#0F172A] mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-5 h-5 text-[#94A3B8] absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="you@example.com"
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A] @error('email') border-red-500 @enderror"
                        >
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-[#0F172A] mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-5 h-5 text-[#94A3B8] absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            placeholder="Enter your password"
                            class="w-full pl-12 pr-12 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A] @error('password') border-red-500 @enderror"
                        >
                        <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#94A3B8] hover:text-[#2563EB] transition-colors">
                            <i data-lucide="eye" id="password-eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-[#475569] cursor-pointer">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            {{ old('remember') ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-[#E2E8F0] text-[#2563EB] focus:ring-[#2563EB] focus:ring-offset-0"
                        >
                        <span>Remember me</span>
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#2563EB] hover:text-[#1D4ED8] transition-colors font-medium">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2 !py-3.5 text-base">
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    Sign In
                </button>

                <!-- Register Link -->
                <p class="text-center text-sm text-[#64748B] mt-6">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-[#2563EB] font-medium hover:text-[#1D4ED8] transition-colors">
                        Create Account
                    </a>
                </p>
            </form>

            <!-- Social Login -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[#E2E8F0]"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-[#64748B]">Or continue with</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <button type="button" class="flex items-center justify-center gap-2 px-4 py-2.5 border border-[#E2E8F0] rounded-xl hover:bg-[#F8FAFC] transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5 text-[#1877F2]"></i>
                        <span class="text-sm font-medium text-[#475569]">Facebook</span>
                    </button>
                    <button type="button" class="flex items-center justify-center gap-2 px-4 py-2.5 border border-[#E2E8F0] rounded-xl hover:bg-[#F8FAFC] transition-colors">
                        <i data-lucide="mail" class="w-5 h-5 text-[#DB4437]"></i>
                        <span class="text-sm font-medium text-[#475569]">Google</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    // Initialize Lucide icons
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            lucide.createIcons();
        }
    });

    // Toggle password visibility
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const eye = document.getElementById(fieldId + '-eye');
        if (input.type === 'password') {
            input.type = 'text';
            eye.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            eye.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>
</body>
</html>
