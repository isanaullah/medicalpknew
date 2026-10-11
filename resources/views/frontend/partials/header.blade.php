<header class="site-header">
  <div class="container">
    <div class="header-inner">
      <a href="{{ route('home') }}" class="logo" aria-label="Verdant Academy home">
        <span class="logo-mark">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg>
        </span>
        <span class="logo-text">Verdant<small>Academy</small></span>
      </a>
      <nav class="main-nav" id="mainNav" aria-label="Main navigation">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('courses') }}" class="{{ request()->routeIs('courses*') || request()->routeIs('course.detail') ? 'active' : '' }}">Courses</a>
        <a href="{{ route('paths') }}" class="{{ request()->routeIs('paths*') ? 'active' : '' }}">Learning Paths</a>
        <a href="{{ route('books') }}" class="{{ request()->routeIs('books*') ? 'active' : '' }}">Books</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about*') ? 'active' : '' }}">About</a>
        <a href="{{ route('team') }}" class="{{ request()->routeIs('team*') ? 'active' : '' }}">Team</a>
        <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact*') ? 'active' : '' }}">Contact</a>
      </nav>
      <div class="header-actions">
        <form class="header-search" data-action="header-search" role="search">
          <i data-lucide="search"></i>
          <label class="sr-only" for="hsearch">Search courses</label>
          <input id="hsearch" type="search" placeholder="Search courses, books…" autocomplete="off">
        </form>
        @auth
          @if(auth()->user()->hasRole('Super Admin'))
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-sm">Admin Panel</a>
          @else
            <a href="{{ route('student.dashboard') }}" class="btn btn-ghost btn-sm">Dashboard</a>
          @endif
          <form method="POST" action="{{ route('logout') }}" style="display:inline;margin:0">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">Log out</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-ghost btn-sm btn-login">Log in</a>
          <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign up free</a>
        @endauth
        <button class="nav-toggle" data-action="toggle-nav" aria-label="Toggle navigation" aria-expanded="false">
          <i data-lucide="menu"></i>
        </button>
      </div>
    </div>
  </div>
</header>
