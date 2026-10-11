<header class="app-topbar">
  <button class="menu-btn" data-action="toggle-sidebar" aria-label="Toggle sidebar"><i data-lucide="menu"></i></button>
  <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
  <div class="topbar-right">
    <form class="topbar-search" data-action="admin-search">
      <i data-lucide="search"></i>
      <label class="sr-only" for="asearch">Search admin</label>
      <input id="asearch" type="search" placeholder="Search courses, students…">
    </form>
    <button class="icon-btn" data-action="toast-demo" data-msg="2 unread contact messages" aria-label="Messages"><i data-lucide="mail"></i><span class="dot"></span></button>
    <a href="{{ route('home') }}" class="btn btn-outline btn-sm"><i data-lucide="external-link"></i> View site</a>
  </div>
</header>
