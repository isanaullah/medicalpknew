<header class="app-topbar">
  <button class="menu-btn" data-action="toggle-sidebar" aria-label="Toggle sidebar"><i data-lucide="menu"></i></button>
  <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
  <div class="topbar-right">
    <form class="topbar-search" data-action="dashboard-search">
      <i data-lucide="search"></i>
      <label class="sr-only" for="dsearch">Search</label>
      <input id="dsearch" type="search" placeholder="Search my courses…">
    </form>
    <button class="icon-btn" data-action="toast-demo" data-msg="No new notifications" aria-label="Notifications">
      <i data-lucide="bell"></i><span class="dot"></span>
    </button>
    <a href="{{ route('courses') }}" class="btn btn-primary btn-sm"><i data-lucide="compass"></i> Browse courses</a>
  </div>
</header>
