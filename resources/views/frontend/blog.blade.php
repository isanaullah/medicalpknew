@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Blog & Articles — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Technical articles, architectural breakdowns, and engineering insights from Verdant Academy.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>Blog</span></nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3.2vw,2.5rem)">{{ $hero->title ?? 'Learning Resources' }}</h1>
        <p class="lead" style="margin-top:12px;max-width:620px">
          {{ $hero->description ?? 'Practical articles on learning, career development and the skills employers are actually hiring for.' }}
        </p>
      </div>
    </section>
    @endif
    <section class="section-sm">
      <div class="container">
        <div class="pill-row" style="margin-bottom:30px">
          <button class="pill active">All topics</button>
          <button class="pill">Career</button><button class="pill">Learning</button><button class="pill">Data</button><button class="pill">Design</button><button class="pill">Engineering</button>
        </div>
        <div class="grid g3">
          <article class="article-card">
              <div class="thumb"><img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=70" alt="How to Choose Your First Programming Language in 2025" loading="lazy" onerror="this.style.display='none'"></div>
              <div class="article-body">
                <span class="badge badge-ivory" style="align-self:flex-start">Career</span>
                <h3><a href="#/blog/p1">How to Choose Your First Programming Language in 2025</a></h3>
                <p>The honest answer depends less on the language and more on what you want to build in the next six months.</p>
                <div class="article-meta">
                  <img src="https://i.pravatar.cc/160?img=12" alt="" style="width:26px;height:26px;border-radius:50%;object-fit:cover" onerror="this.style.display='none'">
                  <span>Marcus Feld</span>
                  <span style="opacity:.4">•</span>02 Oct 2025
                  <span style="opacity:.4">•</span>7 min
                </div>
              </div>
            </article><article class="article-card">
              <div class="thumb"><img src="https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?auto=format&fit=crop&w=800&q=70" alt="A Practical Guide to Studying While Working Full Time" loading="lazy" onerror="this.style.display='none'"></div>
              <div class="article-body">
                <span class="badge badge-ivory" style="align-self:flex-start">Learning</span>
                <h3><a href="#/blog/p2">A Practical Guide to Studying While Working Full Time</a></h3>
                <p>Four scheduling patterns our students use to consistently complete 8 hours of study per week.</p>
                <div class="article-meta">
                  <img src="https://i.pravatar.cc/160?img=47" alt="" style="width:26px;height:26px;border-radius:50%;object-fit:cover" onerror="this.style.display='none'">
                  <span>Priya Raghunathan</span>
                  <span style="opacity:.4">•</span>24 Sep 2025
                  <span style="opacity:.4">•</span>9 min
                </div>
              </div>
            </article><article class="article-card">
              <div class="thumb"><img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=800&q=70" alt="What Hiring Managers Actually Look For in a Data Portfolio" loading="lazy" onerror="this.style.display='none'"></div>
              <div class="article-body">
                <span class="badge badge-ivory" style="align-self:flex-start">Data</span>
                <h3><a href="#/blog/p3">What Hiring Managers Actually Look For in a Data Portfolio</a></h3>
                <p>We asked 40 hiring managers to review anonymous portfolios. The results were remarkably consistent.</p>
                <div class="article-meta">
                  <img src="https://i.pravatar.cc/160?img=45" alt="" style="width:26px;height:26px;border-radius:50%;object-fit:cover" onerror="this.style.display='none'">
                  <span>Dr. Amara Osei</span>
                  <span style="opacity:.4">•</span>15 Sep 2025
                  <span style="opacity:.4">•</span>6 min
                </div>
              </div>
            </article>
        </div>
      </div>
    </section>
  </main>
@endsection
