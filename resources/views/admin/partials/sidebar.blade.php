<aside class="sidebar" id="sidebar">
  <div class="sidebar-head">
    <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:12px;text-decoration:none">
      <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
      <span class="logo-text" style="color:#fff">Verdant<small style="color:var(--mustard-400)">Admin</small></span>
    </a>
  </div>
  <div class="sidebar-body">
    <div class="side-group">
      <div class="side-group-title">Overview</div>
      <a href="{{ route('admin.dashboard') }}" class="side-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i data-lucide="layout-dashboard"></i>Dashboard
      </a>
    </div>
    <div class="side-group">
      <div class="side-group-title">Content</div>
      <a href="{{ route('admin.categories') }}" class="side-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
        <i data-lucide="folder-tree"></i>Categories
      </a>
      <a href="{{ route('admin.courses') }}" class="side-link {{ request()->routeIs('admin.courses') ? 'active' : '' }}">
        <i data-lucide="book-open"></i>Courses
      </a>
      <a href="{{ route('admin.curriculum') }}" class="side-link {{ request()->routeIs('admin.curriculum') ? 'active' : '' }}">
        <i data-lucide="layers"></i>Lessons & Curriculum
      </a>
      <a href="{{ route('admin.instructors') }}" class="side-link {{ request()->routeIs('admin.instructors') ? 'active' : '' }}">
        <i data-lucide="graduation-cap"></i>Instructors
      </a>
      <a href="{{ route('admin.blog') }}" class="side-link {{ request()->routeIs('admin.blog') ? 'active' : '' }}">
        <i data-lucide="newspaper"></i>Blog / Articles
      </a>
      <a href="{{ route('admin.faqs') }}" class="side-link {{ request()->routeIs('admin.faqs') ? 'active' : '' }}">
        <i data-lucide="help-circle"></i>FAQs
      </a>
      <a href="{{ route('admin.pages') }}" class="side-link {{ request()->routeIs('admin.pages') ? 'active' : '' }}">
        <i data-lucide="file-text"></i>Website Pages
      </a>
      <a href="{{ route('admin.media') }}" class="side-link {{ request()->routeIs('admin.media') ? 'active' : '' }}">
        <i data-lucide="image"></i>Media Library
      </a>
    </div>
    <div class="side-group">
      <div class="side-group-title">People</div>
      <a href="{{ route('admin.students') }}" class="side-link {{ request()->routeIs('admin.students') ? 'active' : '' }}">
        <i data-lucide="users"></i>Students
      </a>
      <a href="{{ route('admin.enrollments') }}" class="side-link {{ request()->routeIs('admin.enrollments') ? 'active' : '' }}">
        <i data-lucide="clipboard-list"></i>Enrollments
      </a>
      <a href="{{ route('admin.reviews') }}" class="side-link {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
        <i data-lucide="star"></i>Reviews & Ratings
        <span class="count">1</span>
      </a>
      <a href="{{ route('admin.certificates') }}" class="side-link {{ request()->routeIs('admin.certificates') ? 'active' : '' }}">
        <i data-lucide="award"></i>Certificates
      </a>
    </div>
    <div class="side-group">
      <div class="side-group-title">Communication</div>
      <a href="{{ route('admin.notifications') }}" class="side-link {{ request()->routeIs('admin.notifications') ? 'active' : '' }}">
        <i data-lucide="bell"></i>Notifications
      </a>
      <a href="{{ route('admin.messages') }}" class="side-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
        <i data-lucide="mail"></i>Contact Messages
        <span class="count">2</span>
      </a>
      <a href="{{ route('admin.subscribers') }}" class="side-link {{ request()->routeIs('admin.subscribers') ? 'active' : '' }}">
        <i data-lucide="send"></i>Newsletter
      </a>
    </div>
    <div class="side-group">
      <div class="side-group-title">System</div>
      <a href="{{ route('admin.settings') }}" class="side-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
        <i data-lucide="settings"></i>Website Settings
      </a>
    </div>
  </div>
  <div class="sidebar-foot">
    <div class="side-user" style="cursor:default">
      <img src="https://i.pravatar.cc/160?img=68" alt="{{ auth()->user()->name ?? 'Admin' }}" onerror="this.style.display='none'">
      <div style="flex:1;min-width:0">
        <div class="nm">{{ auth()->user()->name ?? 'Admin User' }}</div>
        <div class="rl">Super administrator</div>
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
