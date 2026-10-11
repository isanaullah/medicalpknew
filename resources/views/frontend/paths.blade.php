@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Learning Paths — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Structured step-by-step career tracks taking you from foundations to staff engineer.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>{{ $hero->title ?? 'Learning Paths' }}</span></nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3.2vw,2.5rem)">{{ $hero->title ?? 'Learning Paths' }}</h1>
        <p class="lead" style="margin-top:12px;max-width:640px">
          {{ $hero->description ?? 'Multi-course programmes with a defined sequence, weekly milestones and a capstone project. Enrol once and follow the path at your own pace.' }}
        </p>
      </div>
    </section>
    @endif

    <section class="section-sm">
      <div class="container">
        <div style="display:flex;flex-direction:column;gap:18px">
          <div class="card" style="padding:28px">
            <div style="display:grid;grid-template-columns:auto 1fr auto;gap:26px;align-items:center" class="path-card">
              <div class="path-icon"><i data-lucide="code-2"></i></div>
              <div>
                <h2 class="display" style="font-size:1.25rem">Full-Stack Developer Path</h2>
                <p style="margin-top:9px;font-size:14.4px;line-height:1.68;color:var(--ink-500);max-width:700px">Six courses taking you from HTML fundamentals to deploying production applications with authentication, databases and CI/CD.</p>
                <div class="path-meta">
                  <span><i data-lucide="book-open"></i>6 courses</span>
                  <span><i data-lucide="calendar"></i>28 weeks</span>
                  <span><i data-lucide="signal"></i>Beginner → Advanced</span>
                  <span><i data-lucide="tag"></i>$449 full path</span>
                </div>
              </div>
              <div style="display:flex;flex-direction:column;gap:9px">
                <button class="btn btn-primary" data-action="enroll" data-id="path">Enrol in path</button>
                <a href="{{ route('courses') }}" class="btn btn-outline">View courses</a>
              </div>
            </div>
          </div>
          <div class="card" style="padding:28px">
            <div style="display:grid;grid-template-columns:auto 1fr auto;gap:26px;align-items:center" class="path-card">
              <div class="path-icon"><i data-lucide="bar-chart-3"></i></div>
              <div>
                <h2 class="display" style="font-size:1.25rem">Data Analyst Path</h2>
                <p style="margin-top:9px;font-size:14.4px;line-height:1.68;color:var(--ink-500);max-width:700px">SQL, Python, statistics and visual storytelling, ending with a portfolio case study reviewed by a hiring manager.</p>
                <div class="path-meta">
                  <span><i data-lucide="book-open"></i>5 courses</span>
                  <span><i data-lucide="calendar"></i>22 weeks</span>
                  <span><i data-lucide="signal"></i>Beginner → Intermediate</span>
                  <span><i data-lucide="tag"></i>$389 full path</span>
                </div>
              </div>
              <div style="display:flex;flex-direction:column;gap:9px">
                <button class="btn btn-primary" data-action="enroll" data-id="path">Enrol in path</button>
                <a href="{{ route('courses') }}" class="btn btn-outline">View courses</a>
              </div>
            </div>
          </div>
          <div class="card" style="padding:28px">
            <div style="display:grid;grid-template-columns:auto 1fr auto;gap:26px;align-items:center" class="path-card">
              <div class="path-icon"><i data-lucide="pen-tool"></i></div>
              <div>
                <h2 class="display" style="font-size:1.25rem">Product Designer Path</h2>
                <p style="margin-top:9px;font-size:14.4px;line-height:1.68;color:var(--ink-500);max-width:700px">Research, interface design, design systems and a full portfolio-ready case study from brief to prototype.</p>
                <div class="path-meta">
                  <span><i data-lucide="book-open"></i>5 courses</span>
                  <span><i data-lucide="calendar"></i>20 weeks</span>
                  <span><i data-lucide="signal"></i>Beginner → Intermediate</span>
                  <span><i data-lucide="tag"></i>$359 full path</span>
                </div>
              </div>
              <div style="display:flex;flex-direction:column;gap:9px">
                <button class="btn btn-primary" data-action="enroll" data-id="path">Enrol in path</button>
                <a href="{{ route('courses') }}" class="btn btn-outline">View courses</a>
              </div>
            </div>
          </div>
          <div class="card" style="padding:28px">
            <div style="display:grid;grid-template-columns:auto 1fr auto;gap:26px;align-items:center" class="path-card">
              <div class="path-icon"><i data-lucide="cloud"></i></div>
              <div>
                <h2 class="display" style="font-size:1.25rem">Cloud Engineer Path</h2>
                <p style="margin-top:9px;font-size:14.4px;line-height:1.68;color:var(--ink-500);max-width:700px">AWS core services, containers, infrastructure as code and CI/CD pipelines, with three practice certification exams.</p>
                <div class="path-meta">
                  <span><i data-lucide="book-open"></i>4 courses</span>
                  <span><i data-lucide="calendar"></i>18 weeks</span>
                  <span><i data-lucide="signal"></i>Intermediate</span>
                  <span><i data-lucide="tag"></i>$329 full path</span>
                </div>
              </div>
              <div style="display:flex;flex-direction:column;gap:9px">
                <button class="btn btn-primary" data-action="enroll" data-id="path">Enrol in path</button>
                <a href="{{ route('courses') }}" class="btn btn-outline">View courses</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</main>
@endsection
