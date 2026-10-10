<footer class="bg-[#0F172A] text-slate-300 pt-16 pb-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="grid md:grid-cols-5 gap-10 pb-12 border-b border-white/10">
      <div class="md:col-span-2">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl text-white mb-4">
          <div class="w-8 h-8 bg-[#2563EB] rounded-lg flex items-center justify-center">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><rect x="6" y="1" width="6" height="16" rx="2" fill="white"/><rect x="1" y="6" width="16" height="6" rx="2" fill="white"/></svg>
          </div>
          Medical.pk
        </a>
        <p class="text-sm text-slate-400 max-w-xs mb-6">Pakistan's leading platform for MDCAT, NUMS &amp; ECAT preparation — trusted by 100,000+ pre-med students nationwide.</p>
        <div class="flex gap-3">
          <a href="#" class="social-icon"><i data-lucide="youtube" class="w-4 h-4"></i></a>
          <a href="#" class="social-icon"><i data-lucide="instagram" class="w-4 h-4"></i></a>
          <a href="#" class="social-icon"><i data-lucide="facebook" class="w-4 h-4"></i></a>
          <a href="#" class="social-icon"><i data-lucide="twitter" class="w-4 h-4"></i></a>
        </div>
      </div>
      <div>
        <h4 class="text-white font-semibold mb-4 text-sm">Quick Links</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="{{route('about')}}">About Us</a></li>
          <li><a href="#">Success Stories</a></li>
          <li><a href="{{ route('home') }}">Free Resources</a></li>
          <li><a href="{{ route('blog') }}">Blog</a></li>
          <li><a href="#">Careers</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-white font-semibold mb-4 text-sm">Courses</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="slug=mdcat-premium">MDCAT Premium</a></li>
          <li><a href="slug=nums-complete">NUMS Complete</a></li>
          <li><a href="slug=fsc-physics">FSc Physics</a></li>
          <li><a href="slug=fsc-chemistry">FSc Chemistry</a></li>
          <li><a href="slug=fsc-biology">FSc Biology</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-white font-semibold mb-4 text-sm">Notes &amp; Books</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="{{ route('home') }}">Chemistry Notes</a></li>
          <li><a href="{{ route('home') }}">Biology Notes</a></li>
          <li><a href="{{ route('home') }}">Physics Notes</a></li>
          <li><a href="{{ route('home') }}">MDCAT MCQs</a></li>
          <li><a href="{{ route('home') }}">Past Papers</a></li>
        </ul>
      </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4 items-center pt-8">
      <p class="text-sm text-slate-500">© 2025 Medical.pk. All rights reserved.</p>
      <div class="flex flex-wrap gap-6 md:justify-end text-sm text-slate-400">
        <a href="{{ route('contact') }}">Contact Us</a>
        <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
        <a href="{{ route('terms') }}">Terms of Service</a>
        <a href="#">Refund Policy</a>
      </div>
    </div>
  </div>
</footer>
