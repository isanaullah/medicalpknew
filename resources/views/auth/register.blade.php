@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- REGISTER SECTION -->
<section class="pt-36 pb-20 bg-white">
    <div class="max-w-md mx-auto px-4 sm:px-6">
        <div class="fade-up">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="user-plus" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-[#0F172A]">Create Account</h1>
                <p class="text-[#64748B] mt-2">Join thousands of students preparing for success</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="card p-8">
                @csrf

                <!-- Name -->
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-[#0F172A] mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="user" class="w-5 h-5 text-[#94A3B8] absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            placeholder="Your full name"
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A] @error('name') border-red-500 @enderror"
                        >
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

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
                            placeholder="Create a strong password"
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

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-[#0F172A] mb-2">
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <i data-lucide="lock" class="w-5 h-5 text-[#94A3B8] absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="Confirm your password"
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A]"
                        >
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="mb-6">
                    <label class="flex items-start gap-3 text-sm text-[#475569] cursor-pointer">
                        <input
                            type="checkbox"
                            name="terms"
                            id="terms"
                            required
                            class="w-4 h-4 rounded border-[#E2E8F0] text-[#2563EB] focus:ring-[#2563EB] focus:ring-offset-0 mt-0.5"
                        >
                        <span>
                            I agree to the
                            <a href="{{ route('terms') }}" class="text-[#2563EB] hover:text-[#1D4ED8] transition-colors font-medium">Terms & Conditions</a>
                            and
                            <a href="{{ route('privacy.policy') }}" class="text-[#2563EB] hover:text-[#1D4ED8] transition-colors font-medium">Privacy Policy</a>
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2 !py-3.5 text-base">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                    Create Account
                </button>

                <!-- Login Link -->
                <p class="text-center text-sm text-[#64748B] mt-6">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#2563EB] font-medium hover:text-[#1D4ED8] transition-colors">
                        Sign In
                    </a>
                </p>
            </form>

            <!-- Social Register -->
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
