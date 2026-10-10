@include('frontend.partials.header')

<body class="bg-white">
<div class="noise-overlay"></div>

@include('frontend.partials.nav-bar')

<!-- PAGE HERO -->
<section class="page-hero pt-36 pb-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center relative z-10 fade-up">
        <span class="badge-pill mb-5">About Medical.pk</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] mb-4">Empowering Pakistan's Future Doctors</h1>
        <p class="text-[#475569]">We're on a mission to make high-quality medical entrance exam preparation accessible, affordable, and effective for every student in Pakistan.</p>
    </div>
</section>

<!-- OUR STORY -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="fade-up">
                <span class="badge-pill mb-4">Our Story</span>
                <h2 class="text-3xl font-bold text-[#0F172A] mb-6">Built by Educators, for Students</h2>
                <p class="text-[#475569] leading-relaxed mb-4">Medical.pk was founded in 2020 by a group of passionate educators and medical professionals who saw a gap in how Pakistani students prepared for entrance exams. We realized that access to quality, structured content shouldn't be limited by geography or financial constraints.</p>
                <p class="text-[#475569] leading-relaxed mb-4">Starting with a small team of teachers and developers, we built a platform that combines the best of traditional teaching with modern technology — interactive video lessons, adaptive practice tests, and personalized learning paths.</p>
                <p class="text-[#475569] leading-relaxed">Today, we've helped thousands of students secure admissions to top medical colleges across Pakistan, including King Edward, Dow, NUST, AKU, and more.</p>
            </div>
            <div class="fade-up">
                <div class="bg-gradient-to-br from-[#2563EB] to-[#4338CA] rounded-2xl h-80 flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                    <div class="text-center text-white relative z-10">
                        <i data-lucide="graduation-cap" class="w-24 h-24 mx-auto mb-4 text-white/30"></i>
                        <p class="text-4xl font-bold">4+ Years</p>
                        <p class="text-white/80">Of Excellence in Education</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR MISSION & VALUES -->
<section class="py-20 bg-[#F8FBFF]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-16 fade-up">
            <span class="badge-pill mb-4">Our Mission</span>
            <h2 class="text-3xl font-bold text-[#0F172A] mb-4">Why We Do What We Do</h2>
            <p class="text-[#475569] max-w-2xl mx-auto">Our core values guide everything we do — from course design to student support.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Value 1 -->
            <div class="card p-6 text-center fade-up">
                <div class="w-14 h-14 rounded-xl bg-[#DBEAFE] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="target" class="w-7 h-7 text-[#2563EB]"></i>
                </div>
                <h3 class="font-bold text-[#0F172A] mb-2">Excellence</h3>
                <p class="text-sm text-[#64748B]">We never compromise on the quality of our content, teaching, or student support.</p>
            </div>

            <!-- Value 2 -->
            <div class="card p-6 text-center fade-up">
                <div class="w-14 h-14 rounded-xl bg-[#DBEAFE] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="heart" class="w-7 h-7 text-[#2563EB]"></i>
                </div>
                <h3 class="font-bold text-[#0F172A] mb-2">Accessibility</h3>
                <p class="text-sm text-[#64748B]">Quality education should be within reach of every student, regardless of their background.</p>
            </div>

            <!-- Value 3 -->
            <div class="card p-6 text-center fade-up">
                <div class="w-14 h-14 rounded-xl bg-[#DBEAFE] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="lightbulb" class="w-7 h-7 text-[#2563EB]"></i>
                </div>
                <h3 class="font-bold text-[#0F172A] mb-2">Innovation</h3>
                <p class="text-sm text-[#64748B]">We continuously improve our platform and teaching methods to stay ahead of the curve.</p>
            </div>

            <!-- Value 4 -->
            <div class="card p-6 text-center fade-up">
                <div class="w-14 h-14 rounded-xl bg-[#DBEAFE] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="users" class="w-7 h-7 text-[#2563EB]"></i>
                </div>
                <h3 class="font-bold text-[#0F172A] mb-2">Community</h3>
                <p class="text-sm text-[#64748B]">We foster a supportive community where students learn, grow, and succeed together.</p>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center fade-up">
                <p class="text-4xl font-extrabold text-[#2563EB]">4+</p>
                <p class="text-sm text-[#64748B]">Years of Experience</p>
            </div>
            <div class="text-center fade-up">
                <p class="text-4xl font-extrabold text-[#2563EB]">15,000+</p>
                <p class="text-sm text-[#64748B]">Students Enrolled</p>
            </div>
            <div class="text-center fade-up">
                <p class="text-4xl font-extrabold text-[#2563EB]">50+</p>
                <p class="text-sm text-[#64748B]">Expert Faculty</p>
            </div>
            <div class="text-center fade-up">
                <p class="text-4xl font-extrabold text-[#2563EB]">95%</p>
                <p class="text-sm text-[#64748B]">Student Satisfaction</p>
            </div>
        </div>
    </div>
</section>

<!-- TEAM -->
<section class="py-20 bg-[#F8FBFF]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-16 fade-up">
            <span class="badge-pill mb-4">Our Team</span>
            <h2 class="text-3xl font-bold text-[#0F172A] mb-4">Meet the People Behind Medical.pk</h2>
            <p class="text-[#475569] max-w-2xl mx-auto">Passionate educators, medical professionals, and technologists working together to transform exam preparation.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Team Member 1 -->
            <div class="card p-6 text-center fade-up">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#2563EB] to-[#4338CA] flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                    DR
                </div>
                <h4 class="font-bold text-[#0F172A]">Dr. Ali Raza</h4>
                <p class="text-sm text-[#2563EB] font-medium">Founder &amp; CEO</p>
                <p class="text-xs text-[#64748B] mt-2">MBBS, MPH (Harvard). 10+ years of teaching experience.</p>
            </div>

            <!-- Team Member 2 -->
            <div class="card p-6 text-center fade-up">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#16A34A] to-[#0D9488] flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                    SK
                </div>
                <h4 class="font-bold text-[#0F172A]">Prof. Sarah Khan</h4>
                <p class="text-sm text-[#2563EB] font-medium">Head of Academics</p>
                <p class="text-xs text-[#64748B] mt-2">Former Professor at LUMS, specializes in curriculum design.</p>
            </div>

            <!-- Team Member 3 -->
            <div class="card p-6 text-center fade-up">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#EA580C] to-[#DC2626] flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                    UT
                </div>
                <h4 class="font-bold text-[#0F172A]">Sir Usman Tariq</h4>
                <p class="text-sm text-[#2563EB] font-medium">Head of Faculty</p>
                <p class="text-xs text-[#64748B] mt-2">M.Sc. Chemistry, 12+ years of teaching experience.</p>
            </div>

            <!-- Team Member 4 -->
            <div class="card p-6 text-center fade-up">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#DB2777] to-[#BE185D] flex items-center justify-center mx-auto mb-4 text-white text-2xl font-bold">
                    AN
                </div>
                <h4 class="font-bold text-[#0F172A]">Ms. Ayesha Noor</h4>
                <p class="text-sm text-[#2563EB] font-medium">Head of Student Support</p>
                <p class="text-xs text-[#64748B] mt-2">Educational Psychology specialist, passionate about student success.</p>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-16 fade-up">
            <span class="badge-pill mb-4">Testimonials</span>
            <h2 class="text-3xl font-bold text-[#0F172A] mb-4">What Our Students Say</h2>
            <p class="text-[#475569] max-w-2xl mx-auto">Real stories from students who achieved their dreams with Medical.pk.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Testimonial 1 -->
            <div class="card p-6 fade-up">
                <div class="flex text-[#FBBF24] mb-3">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                </div>
                <p class="text-sm text-[#475569] leading-relaxed mb-4">"Medical.pk changed my life. The structured courses and practice tests gave me the confidence I needed to crack MDCAT with a top score."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-sm flex items-center justify-center">UA</div>
                    <div>
                        <p class="font-semibold text-[#0F172A] text-sm">Usman Ali</p>
                        <p class="text-xs text-[#64748B]">AKU Medical College, Batch 2024</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="card p-6 fade-up">
                <div class="flex text-[#FBBF24] mb-3">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                </div>
                <p class="text-sm text-[#475569] leading-relaxed mb-4">"The faculty at Medical.pk is incredible. They explain complex concepts in a way that makes them easy to remember."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-sm flex items-center justify-center">MF</div>
                    <div>
                        <p class="font-semibold text-[#0F172A] text-sm">Mahnoor Fatima</p>
                        <p class="text-xs text-[#64748B]">King Edward Medical College, Batch 2024</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="card p-6 fade-up">
                <div class="flex text-[#FBBF24] mb-3">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                </div>
                <p class="text-sm text-[#475569] leading-relaxed mb-4">"The best investment I made for my future. Medical.pk's mock tests are the closest thing to the real MDCAT exam."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#DBEAFE] text-[#1D4ED8] font-bold text-sm flex items-center justify-center">DI</div>
                    <div>
                        <p class="font-semibold text-[#0F172A] text-sm">Danish Iqbal</p>
                        <p class="text-xs text-[#64748B]">NUST Medical College, Batch 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="py-20 bg-gradient-to-br from-[#2563EB] to-[#4338CA]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <div class="fade-up">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Ready to Start Your Journey?</h2>
            <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">Join thousands of students who are already preparing for their medical entrance exams with Pakistan's most trusted platform.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('courses') }}" class="btn-primary !bg-white !text-[#1D4ED8] hover:!bg-blue-50 !px-8 !py-3 text-lg">
                    <i data-lucide="book-open" class="w-5 h-5 inline mr-2"></i>
                    Explore Courses
                </a>
                <a href="{{ route('contact') }}" class="btn-outline !border-white/40 !text-white hover:!bg-white/10 !px-8 !py-3 text-lg">
                    <i data-lucide="message-circle" class="w-5 h-5 inline mr-2"></i>
                    Contact Us
                </a>
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
</script>
</body>
</html>
