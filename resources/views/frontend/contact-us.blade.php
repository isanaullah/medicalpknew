@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- PAGE HERO -->
<section class="page-hero pt-36 pb-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <span class="badge-pill mb-5">We'd Love to Hear From You</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] mb-4">Get in Touch</h1>
        <p class="text-[#475569]">Have a question about courses, payments, or need technical help? Our support team is here for you every day of the week.</p>
    </div>
</section>

<!-- CONTENT -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 grid lg:grid-cols-2 gap-14 mb-16">
        <!-- Left Column - Contact Info -->
        <div class="fade-up">
            <p class="text-[#475569] mb-8 leading-relaxed">Our student support team responds fast and knows the platform inside out. Reach out through whichever channel is most convenient — we're happy to help with course access, payments, technical issues or general guidance.</p>

            <div class="space-y-5 mb-10">
                <!-- Address -->
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-[#DBEAFE] flex items-center justify-center shrink-0">
                        <i data-lucide="map-pin" class="w-5 h-5 text-[#2563EB]"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-[#64748B] uppercase tracking-wide mb-1">Office</p>
                        <p class="text-[#0F172A] font-medium">{{ $settings->site_address ?? 'Plot 42, Tech Valley, Gulberg III, Lahore, Pakistan' }}</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-[#DBEAFE] flex items-center justify-center shrink-0">
                        <i data-lucide="phone" class="w-5 h-5 text-[#2563EB]"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-[#64748B] uppercase tracking-wide mb-1">Phone</p>
                        <p class="text-[#0F172A] font-medium">{{ $settings->site_phone ?? '+92 300 1234567' }}</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-[#DBEAFE] flex items-center justify-center shrink-0">
                        <i data-lucide="mail" class="w-5 h-5 text-[#2563EB]"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-[#64748B] uppercase tracking-wide mb-1">Email</p>
                        <p class="text-[#0F172A] font-medium">{{ $settings->site_email ?? 'support@medical.pk' }}</p>
                    </div>
                </div>

                <!-- Response Time -->
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-[#DBEAFE] flex items-center justify-center shrink-0">
                        <i data-lucide="clock" class="w-5 h-5 text-[#2563EB]"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-[#64748B] uppercase tracking-wide mb-1">Response Time</p>
                        <p class="text-[#0F172A] font-medium">Within 24 hours, Monday–Saturday</p>
                    </div>
                </div>
            </div>

            <!-- Social Icons -->
            <div class="flex gap-3">
                @if($settings->site_fb)
                <a href="{{ $settings->site_fb }}" target="_blank" class="social-icon w-10 h-10 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] hover:border-[#2563EB] transition-all">
                    <i data-lucide="facebook" class="w-4 h-4 text-[#64748B] hover:text-[#2563EB]"></i>
                </a>
                @endif

                @if($settings->site_instagram)
                <a href="{{ $settings->site_instagram }}" target="_blank" class="social-icon w-10 h-10 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] hover:border-[#2563EB] transition-all">
                    <i data-lucide="instagram" class="w-4 h-4 text-[#64748B] hover:text-[#2563EB]"></i>
                </a>
                @endif

                @if($settings->site_twitter)
                <a href="{{ $settings->site_twitter }}" target="_blank" class="social-icon w-10 h-10 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] hover:border-[#2563EB] transition-all">
                    <i data-lucide="twitter" class="w-4 h-4 text-[#64748B] hover:text-[#2563EB]"></i>
                </a>
                @endif

                @if($settings->site_linkedn)
                <a href="{{ $settings->site_linkedn }}" target="_blank" class="social-icon w-10 h-10 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] hover:border-[#2563EB] transition-all">
                    <i data-lucide="linkedin" class="w-4 h-4 text-[#64748B] hover:text-[#2563EB]"></i>
                </a>
                @endif

                @if(!$settings->site_fb && !$settings->site_instagram && !$settings->site_twitter && !$settings->site_linkedn)
                <a href="#" class="social-icon w-10 h-10 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] hover:border-[#2563EB] transition-all">
                    <i data-lucide="youtube" class="w-4 h-4 text-[#64748B] hover:text-[#2563EB]"></i>
                </a>
                <a href="#" class="social-icon w-10 h-10 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] hover:border-[#2563EB] transition-all">
                    <i data-lucide="instagram" class="w-4 h-4 text-[#64748B] hover:text-[#2563EB]"></i>
                </a>
                <a href="#" class="social-icon w-10 h-10 rounded-full border border-[#E2E8F0] flex items-center justify-center hover:bg-[#F8FBFF] hover:border-[#2563EB] transition-all">
                    <i data-lucide="facebook" class="w-4 h-4 text-[#64748B] hover:text-[#2563EB]"></i>
                </a>
                @endif
            </div>
        </div>

        <!-- Right Column - Contact Form -->
        <div class="card p-8 fade-up">
            @if(session('success'))
                <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
                    <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
                    <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-[#0F172A] mb-2">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your full name" class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A] @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#0F172A] mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com" class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A] @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#0F172A] mb-2">Subject</label>
                    <select name="subject" class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A] bg-white">
                        <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                        <option value="Course Support" {{ old('subject') == 'Course Support' ? 'selected' : '' }}>Course Support</option>
                        <option value="Technical Issue" {{ old('subject') == 'Technical Issue' ? 'selected' : '' }}>Technical Issue</option>
                        <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                        <option value="Feedback" {{ old('subject') == 'Feedback' ? 'selected' : '' }}>Feedback</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#0F172A] mb-2">Message <span class="text-red-500">*</span></label>
                    <textarea name="message" required placeholder="How can we help?" class="w-full px-4 py-3 rounded-xl border border-[#E2E8F0] focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-[#2563EB] text-[#0F172A] h-32 resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full flex justify-center items-center gap-2">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Send Message
                </button>
            </form>
        </div>
    </div>

    <!-- Map / Location -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 fade-up">
        <div class="bg-[#EEF7FF] rounded-2xl h-64 flex flex-col items-center justify-center text-center">
            <i data-lucide="map-pin" class="w-14 h-14 text-[#2563EB] mb-3"></i>
            <p class="font-bold text-[#0F172A]">{{ $settings->site_title ?? 'Medical.pk' }} — Office</p>
            <p class="text-sm text-[#64748B] mt-1">{{ $settings->site_address ?? 'Plot 42, Tech Valley, Gulberg III, Lahore, Pakistan' }}</p>
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
</script>
</body>
</html>
