<aside class="sidebar" id="sidebar">
  <div class="sidebar-head">
    <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:12px;text-decoration:none">
      <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
      <span class="logo-text" style="color:#fff">Verdant<small style="color:var(--mustard-400)">Student</small></span>
    </a>
  </div>
  <div class="sidebar-body">
    <div class="side-group">
      <div class="side-group-title">Learning</div>
      <a href="{{ route('student.dashboard') }}" class="side-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
        <i data-lucide="layout-dashboard"></i>Overview
      </a>
      <a href="{{ route('student.courses') }}" class="side-link {{ request()->routeIs('student.courses') ? 'active' : '' }}">
        <i data-lucide="book-open"></i>My Courses
      </a>
      <a href="{{ route('student.wishlist') }}" class="side-link {{ request()->routeIs('student.wishlist') ? 'active' : '' }}">
        <i data-lucide="heart"></i>Wishlist
        <span class="count">2</span>
      </a>
      <a href="{{ route('student.certificates') }}" class="side-link {{ request()->routeIs('student.certificates') ? 'active' : '' }}">
        <i data-lucide="award"></i>Certificates
      </a>
    </div>
    <div class="side-group">
      <div class="side-group-title">Account</div>
      <a href="{{ route('student.notifications') }}" class="side-link {{ request()->routeIs('student.notifications') ? 'active' : '' }}">
        <i data-lucide="bell"></i>Notifications
      </a>
      <a href="{{ route('student.settings') }}" class="side-link {{ request()->routeIs('student.settings') ? 'active' : '' }}">
        <i data-lucide="settings"></i>Profile Settings
      </a>
      <a href="{{ route('student.password') }}" class="side-link {{ request()->routeIs('student.password') ? 'active' : '' }}">
        <i data-lucide="key-round"></i>Change Password
      </a>
    </div>
  </div>
  <div class="sidebar-foot">
    <div class="side-user" style="cursor:default">
      <img src="https://i.pravatar.cc/160?img=20" alt="{{ auth()->user()->name ?? 'Student' }}" onerror="this.style.display='none'">
      <div style="flex:1;min-width:0">
        <div class="nm">{{ auth()->user()->name ?? 'Student' }}</div>
        <div class="rl">Student account</div>
      </div>
      <form method="POST" action="{{ route('logout') }}" style="display:inline;margin:0">
        @csrf
        <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer;padding:0;display:flex;align-items:center" title="Log out">
          <i data-lucide="log-out" style="width:16px;height:16px;opacity:.7"></i>
        </button>
      </form>
    </div>
  </div>
</aside>
