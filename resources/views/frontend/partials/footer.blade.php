<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <a href="{{ route('home') }}" class="logo" style="margin-bottom:16px">
          <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
          <span class="logo-text" style="color:#fff">Verdant<small style="color:var(--mustard-400)">Academy</small></span>
        </a>
        <p style="font-size:14px;line-height:1.7;max-width:330px;color:#B895A6">
          An accredited online academy delivering structured, mentor-led programmes, books and learning paths
          in technology, business and design since 2016.
        </p>
        <div class="social-row" style="margin-top:22px">
          <a href="#" aria-label="LinkedIn"><i data-lucide="linkedin"></i></a>
          <a href="#" aria-label="X"><i data-lucide="twitter"></i></a>
          <a href="#" aria-label="YouTube"><i data-lucide="youtube"></i></a>
          <a href="#" aria-label="Instagram"><i data-lucide="instagram"></i></a>
        </div>
      </div>
      <div>
        <h4 class="footer-title">Explore</h4>
        <ul class="footer-links">
          <li><a href="{{ route('courses') }}">All Courses</a></li>
          <li><a href="{{ route('paths') }}">Learning Paths</a></li>
          <li><a href="{{ route('books') }}">Books & Workbooks</a></li>
          <li><a href="{{ route('blog') }}">Blog & Resources</a></li>
          <li><a href="{{ route('faq') }}">FAQ</a></li>
          <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-title">Company</h4>
        <ul class="footer-links">
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('team') }}">Our Team</a></li>
          <li><a href="{{ route('about') }}">Instructors</a></li>
          <li><a href="{{ route('student.dashboard') }}">Student Dashboard</a></li>
          <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
          <li><a href="{{ route('contact') }}">Careers</a></li>
        </ul>
      </div>
      <div>
        <h4 class="footer-title">Contact</h4>
        <ul class="footer-links">
          <li style="display:flex;gap:9px;align-items:flex-start"><i data-lucide="map-pin" style="width:16px;height:16px;margin-top:3px;flex:none;color:var(--mustard-400)"></i><span>42 Alder House, Kingsway<br>London WC2B 6AN, United Kingdom</span></li>
          <li style="display:flex;gap:9px;align-items:center"><i data-lucide="mail" style="width:16px;height:16px;flex:none;color:var(--mustard-400)"></i><a href="mailto:hello@verdantacademy.com">hello@verdantacademy.com</a></li>
          <li style="display:flex;gap:9px;align-items:center"><i data-lucide="phone" style="width:16px;height:16px;flex:none;color:var(--mustard-400)"></i><a href="tel:+442071234567">+44 20 7123 4567</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2025 Verdant Academy Ltd. All rights reserved.</span>
      <div style="display:flex;gap:20px;flex-wrap:wrap">
        <a href="{{ route('privacy') }}" style="color:#B895A6">Privacy Policy</a>
        <a href="{{ route('terms') }}" style="color:#B895A6">Terms & Conditions</a>
        <a href="{{ route('cookies') }}" style="color:#B895A6">Cookie Policy</a>
        <a href="{{ route('disclaimer') }}" style="color:#B895A6">Disclaimer</a>
      </div>
    </div>
  </div>
</footer>
