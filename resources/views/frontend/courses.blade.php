@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'All Courses — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Explore our complete library of professional software development courses.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:44px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>Courses</span>
        </nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3.2vw,2.5rem)">{{ $hero->title ?? 'All Courses' }}</h1>
        <p class="lead" style="margin-top:12px;max-width:620px">
          {{ $hero->description ?? 'Explore our complete curriculum across development, data, design, business and cloud.' }}
        </p>
      </div>
    </section>
    @endif

    <section class="section-sm">
      <div class="container">
        <div class="card card-pad" style="margin-bottom:28px">
          <div style="display:grid;grid-template-columns:1.4fr 1fr 1fr 1fr 1fr;gap:12px;align-items:end">
            <div>
              <label class="label" for="f-q">Search</label>
              <div class="input-icon">
                <i data-lucide="search"></i>
                <input id="f-q" class="input" type="search" placeholder="Course title or topic" value="" data-filter="q">
              </div>
            </div>
            <div>
              <label class="label" for="f-cat">Category</label>
              <select id="f-cat" class="select" data-filter="cat">
                <option value="all">All categories</option>
                <option value="web" >Web Development</option><option value="data" >Data &amp; Analytics</option><option value="design" >Product Design</option><option value="business" >Business &amp; Management</option><option value="marketing" >Digital Marketing</option><option value="cloud" >Cloud &amp; DevOps</option><option value="mobile" >Mobile Development</option><option value="career" >Career &amp; Soft Skills</option>
              </select>
            </div>
            <div>
              <label class="label" for="f-level">Level</label>
              <select id="f-level" class="select" data-filter="level">
                <option value="all">All levels</option>
                <option value="Beginner" >Beginner</option>
                <option value="Intermediate" >Intermediate</option>
                <option value="Advanced" >Advanced</option>
              </select>
            </div>
            <div>
              <label class="label" for="f-price">Price</label>
              <select id="f-price" class="select" data-filter="price">
                <option value="all">Any price</option>
                <option value="under60" >Under $60</option>
                <option value="60to90" >$60 – $90</option>
                <option value="over90" >Over $90</option>
              </select>
            </div>
            <div>
              <label class="label" for="f-sort">Sort by</label>
              <select id="f-sort" class="select" data-filter="sort">
                <option value="popular" selected>Most popular</option>
                <option value="newest" >Newest</option>
                <option value="rating" >Highest rated</option>
                <option value="price-asc" >Price: low to high</option>
                <option value="price-desc" >Price: high to low</option>
              </select>
            </div>
          </div>
          <div style="display:flex;gap:9px;flex-wrap:wrap;margin-top:18px;align-items:center">
            <span class="small muted" style="font-weight:600">Quick filters:</span>
            <button class="pill " data-action="quick-cat" data-cat="web">Web Development</button><button class="pill " data-action="quick-cat" data-cat="data">Data &amp; Analytics</button><button class="pill " data-action="quick-cat" data-cat="design">Product Design</button><button class="pill " data-action="quick-cat" data-cat="business">Business &amp; Management</button><button class="pill " data-action="quick-cat" data-cat="marketing">Digital Marketing</button>
            <button class="btn btn-ghost btn-sm" data-action="clear-filters" style="margin-left:auto"><i data-lucide="rotate-ccw"></i> Reset</button>
          </div>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:22px">
          <p class="small muted">Showing <b style="color:var(--ink-900)">6</b> of <b style="color:var(--ink-900)">9</b> courses</p>
          <div style="display:flex;gap:8px">
            <a href="{{ route('paths') }}" class="btn btn-outline btn-sm"><i data-lucide="route"></i> Learning paths</a>
          </div>
        </div>

        
          <div class="grid g3"><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70" alt="The Complete Web Development Bootcamp" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-gold">Bestseller</span>
      </div>
      <button class="thumb-fav " data-action="wishlist" data-id="1" aria-label="Save course" aria-pressed="false">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Web Development</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 1) }}">The Complete Web Development Bootcamp</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=12" alt="" onerror="this.style.display='none'">
        <span>Marcus Feld</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.8</b> <span class="muted">(3,412)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>52h</span>
        <span><i data-lucide="play-circle"></i>214 lessons</span>
        <span><i data-lucide="signal"></i>Beginner</span>
      </div>
      <div class="course-foot">
        <span class="price">$89<s>$189</s></span>
        <a href="{{ route('course.detail', 1) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=70" alt="Data Analytics with Python &amp; SQL" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-ivory">Intermediate</span>
      </div>
      <button class="thumb-fav " data-action="wishlist" data-id="2" aria-label="Save course" aria-pressed="false">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Data &amp; Analytics</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 2) }}">Data Analytics with Python &amp; SQL</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=45" alt="" onerror="this.style.display='none'">
        <span>Dr. Amara Osei</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.9</b> <span class="muted">(2,187)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>44h</span>
        <span><i data-lucide="play-circle"></i>168 lessons</span>
        <span><i data-lucide="signal"></i>Intermediate</span>
      </div>
      <div class="course-foot">
        <span class="price">$99<s>$169</s></span>
        <a href="{{ route('course.detail', 2) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?auto=format&fit=crop&w=800&q=70" alt="Python for Automation &amp; Scripting" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-ivory">Beginner</span>
      </div>
      <button class="thumb-fav " data-action="wishlist" data-id="6" aria-label="Save course" aria-pressed="false">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Data &amp; Analytics</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 6) }}">Python for Automation &amp; Scripting</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=45" alt="" onerror="this.style.display='none'">
        <span>Dr. Amara Osei</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.8</b> <span class="muted">(1,122)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>24h</span>
        <span><i data-lucide="play-circle"></i>98 lessons</span>
        <span><i data-lucide="signal"></i>Beginner</span>
      </div>
      <div class="course-foot">
        <span class="price">$59<s>$99</s></span>
        <a href="{{ route('course.detail', 6) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=70" alt="Product Design Foundations" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-gold">Bestseller</span>
      </div>
      <button class="thumb-fav on" data-action="wishlist" data-id="3" aria-label="Save course" aria-pressed="true">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Product Design</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 3) }}">Product Design Foundations</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=47" alt="" onerror="this.style.display='none'">
        <span>Priya Raghunathan</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.9</b> <span class="muted">(1,893)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>36h</span>
        <span><i data-lucide="play-circle"></i>142 lessons</span>
        <span><i data-lucide="signal"></i>Beginner</span>
      </div>
      <div class="course-foot">
        <span class="price">$79<s>$139</s></span>
        <a href="{{ route('course.detail', 3) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=70" alt="Digital Marketing Strategy" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-gold">Bestseller</span>
      </div>
      <button class="thumb-fav on" data-action="wishlist" data-id="5" aria-label="Save course" aria-pressed="true">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Digital Marketing</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 5) }}">Digital Marketing Strategy</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=26" alt="" onerror="this.style.display='none'">
        <span>Helena Marchetti</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.8</b> <span class="muted">(1,654)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>32h</span>
        <span><i data-lucide="play-circle"></i>126 lessons</span>
        <span><i data-lucide="signal"></i>Intermediate</span>
      </div>
      <div class="course-foot">
        <span class="price">$85<s>$149</s></span>
        <a href="{{ route('course.detail', 5) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=70" alt="AWS Certified Cloud Practitioner" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-ivory">Beginner</span>
      </div>
      <button class="thumb-fav " data-action="wishlist" data-id="4" aria-label="Save course" aria-pressed="false">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Cloud &amp; DevOps</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 4) }}">AWS Certified Cloud Practitioner</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=33" alt="" onerror="this.style.display='none'">
        <span>Jonas Lindqvist</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.7</b> <span class="muted">(1,420)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>28h</span>
        <span><i data-lucide="play-circle"></i>118 lessons</span>
        <span><i data-lucide="signal"></i>Beginner</span>
      </div>
      <div class="course-foot">
        <span class="price">$69<s>$119</s></span>
        <a href="{{ route('course.detail', 4) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article></div>
          
            <div style="text-align:center;margin-top:42px">
              <button class="btn btn-outline btn-lg" data-action="load-more">
                <i data-lucide="plus-circle"></i> Load more courses
              </button>
            </div>
        
      </div>
    </section>
  </main>
@endsection
