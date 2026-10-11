@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'About Us — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Learn about the mission, faculty, and educational philosophy of Verdant Academy.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $heroImg = $sections['hero_image'] ?? null;
  $mission = $sections['mission'] ?? null;
  $timeline = $sections['story_timeline'] ?? null;
  $faculty = $sections['faculty_intro'] ?? null;
  $stats = $sections['stats_strip'] ?? null;
  $cta = $sections['cta_banner'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>About Us</span></nav>
        <div style="max-width:720px">
          <span class="eyebrow">{{ $hero->subtitle ?? 'Since 2016' }}</span>
          <h1 class="display" style="margin-top:14px">{{ $hero->title ?? 'We build structured learning for people with real responsibilities.' }}</h1>
          <p class="lead" style="margin-top:18px">
            {{ $hero->description ?? 'Verdant Academy exists because most online education is designed for people with unlimited time. Our programmes are built for working adults who need a clear path, honest pacing and someone to hold them accountable.' }}
          </p>
        </div>
      </div>
    </section>
    @endif

    @if(!isset($heroImg) || $heroImg->is_visible)
    <section data-section-key="hero_image" data-section-id="{{ $heroImg->id ?? '' }}" class="section-sm">
      <div class="container">
        <img src="{{ $heroImg->image ?? 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1000&q=75' }}" alt="{{ $heroImg->title ?? 'Verdant Academy teaching studio' }}" style="width:100%;height:420px;object-fit:cover;border-radius:var(--radius-lg);box-shadow:var(--shadow-md)" onerror="this.style.display='none'">
      </div>
    </section>
    @endif

    @if(!isset($mission) || $mission->is_visible)
    <section data-section-key="mission" data-section-id="{{ $mission->id ?? '' }}" class="section">
      <div class="container">
        <div class="two-col">
          <div>
            <span class="eyebrow">{{ $mission->subtitle ?? 'Our mission' }}</span>
            <h2 class="display" style="margin-top:14px;font-size:1.7rem">{{ $mission->title ?? 'Make high-quality professional education genuinely completable.' }}</h2>
            <p style="margin-top:18px;font-size:15px;line-height:1.78;color:var(--ink-500)">
              {{ $mission->description ?? 'We measure ourselves on completion rates, not enrolments. Every design decision — from lesson length to assignment frequency — is made to help a working adult finish what they started. That means shorter videos, weekly milestones, real mentor feedback and assessments that prove understanding rather than attendance.' }}
            </p>
            <p style="margin-top:16px;font-size:15px;line-height:1.78;color:var(--ink-500)">
              {{ $mission->body ?? 'Since 2016 we have helped more than 48,000 students across 74 countries change roles, earn promotions and build businesses. Our average course completion rate is 68% — roughly four times the industry average for self-paced online learning.' }}
            </p>
          </div>
          <div>
            <div class="card card-pad" style="margin-bottom:16px">
              <div class="stat-icon" style="margin-bottom:14px"><i data-lucide="target"></i></div>
              <h3 style="font-size:16px;margin-bottom:8px">{{ $mission?->config('vision_title', 'Our vision') }}</h3>
              <p style="font-size:14.2px;line-height:1.7;color:var(--ink-500)">
                {{ $mission?->config('vision_desc', 'A world where professional education is judged by what graduates can do, not by how many hours they watched.') }}
              </p>
            </div>
            <div class="card card-pad">
              <div class="stat-icon gold" style="margin-bottom:14px"><i data-lucide="compass"></i></div>
              <h3 style="font-size:16px;margin-bottom:8px">{{ $mission?->config('values_title', 'Our values') }}</h3>
              <ul class="bullet-list" style="margin-top:10px">
                @if(isset($mission) && is_array($mission?->config('values')))
                  @foreach($mission?->config('values') as $val)
                    <li>{{ $val }}</li>
                  @endforeach
                @else
                  <li>Teach only what we practise professionally</li>
                  <li>Give honest feedback, even when it is uncomfortable</li>
                  <li>Pace for real life, not ideal schedules</li>
                  <li>Publish pricing and outcomes openly</li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

    @if(!isset($timeline) || $timeline->is_visible)
    <section data-section-key="story_timeline" data-section-id="{{ $timeline->id ?? '' }}" class="section section-alt divider-y">
      <div class="container">
        <div style="max-width:640px">
          <span class="eyebrow">{{ $timeline->subtitle ?? 'Our story' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $timeline->title ?? 'From a single evening class to a global academy' }}</h2>
        </div>
        <div style="margin-top:48px;display:grid;grid-template-columns:repeat(4,1fr);gap:28px" class="g4">
          @if(isset($timeline) && is_array($timeline?->config('timeline')))
            @foreach($timeline?->config('timeline') as $item)
              <div style="border-top:2px solid var(--mustard-500);padding-top:22px;position:relative">
                <div style="font-family:var(--font-display);font-size:1.6rem;color:var(--mustard-600);font-weight:600">{{ $item['year'] ?? '' }}</div>
                <h3 style="font-size:15.6px;margin-top:10px">{{ $item['title'] ?? '' }}</h3>
                <p style="font-size:13.8px;line-height:1.68;color:var(--ink-500);margin-top:8px">{{ $item['desc'] ?? '' }}</p>
              </div>
            @endforeach
          @else
            <div style="border-top:2px solid var(--mustard-500);padding-top:22px;position:relative">
              <div style="font-family:var(--font-display);font-size:1.6rem;color:var(--mustard-600);font-weight:600">2016</div>
              <h3 style="font-size:15.6px;margin-top:10px">The first cohort</h3>
              <p style="font-size:13.8px;line-height:1.68;color:var(--ink-500);margin-top:8px">Twelve students in a rented room in Shoreditch learning JavaScript fundamentals over eight weeks.</p>
            </div>
          @endif
        </div>
      </div>
    </section>
    @endif

    @if(!isset($faculty) || $faculty->is_visible)
    <section data-section-key="faculty_intro" data-section-id="{{ $faculty->id ?? '' }}" class="section">
      <div class="container">
        <div style="max-width:640px;margin-bottom:44px">
          <span class="eyebrow">{{ $faculty->subtitle ?? 'Faculty' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $faculty->title ?? 'The people who will teach you' }}</h2>
          <p class="lead" style="margin-top:16px">{{ $faculty->description ?? 'Every instructor at Verdant still works in their field. They teach what they use.' }}</p>
        </div>
        <div class="grid g3">
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=45" alt="Dr. Amara Osei" loading="lazy" onerror="this.style.display='none'">
            <h3>Dr. Amara Osei</h3>
            <div class="role">Lead Data Scientist</div>
            <p class="bio">Former principal data scientist with 12 years across fintech and healthcare analytics.</p>
            <div class="instructor-stats">
              <div><b>18.4k</b>Students</div>
              <div><b>6</b>Courses</div>
              <div><b>4.9</b>Rating</div>
            </div>
          </article>
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=12" alt="Marcus Feld" loading="lazy" onerror="this.style.display='none'">
            <h3>Marcus Feld</h3>
            <div class="role">Full-Stack Engineer</div>
            <p class="bio">Built payment infrastructure at scale. Teaches the patterns he uses in production every day.</p>
            <div class="instructor-stats">
              <div><b>22.1k</b>Students</div>
              <div><b>8</b>Courses</div>
              <div><b>4.8</b>Rating</div>
            </div>
          </article>
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=47" alt="Priya Raghunathan" loading="lazy" onerror="this.style.display='none'">
            <h3>Priya Raghunathan</h3>
            <div class="role">Product Design Director</div>
            <p class="bio">Design lead for two unicorn startups. Specialises in research-driven interface work.</p>
            <div class="instructor-stats">
              <div><b>14.7k</b>Students</div>
              <div><b>5</b>Courses</div>
              <div><b>4.9</b>Rating</div>
            </div>
          </article>
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=33" alt="Jonas Lindqvist" loading="lazy" onerror="this.style.display='none'">
            <h3>Jonas Lindqvist</h3>
            <div class="role">Cloud Architect</div>
            <p class="bio">AWS certified architect managing multi-region infrastructure for European media groups.</p>
            <div class="instructor-stats">
              <div><b>9.3k</b>Students</div>
              <div><b>4</b>Courses</div>
              <div><b>4.7</b>Rating</div>
            </div>
          </article>
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=26" alt="Helena Marchetti" loading="lazy" onerror="this.style.display='none'">
            <h3>Helena Marchetti</h3>
            <div class="role">Growth Marketing Lead</div>
            <p class="bio">Scaled three B2B SaaS companies from launch to series B using paid and content channels.</p>
            <div class="instructor-stats">
              <div><b>11.4k</b>Students</div>
              <div><b>5</b>Courses</div>
              <div><b>4.8</b>Rating</div>
            </div>
          </article>
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=59" alt="Samuel Adeyemi" loading="lazy" onerror="this.style.display='none'">
            <h3>Samuel Adeyemi</h3>
            <div class="role">Engineering Manager</div>
            <p class="bio">Leads a platform team of 14 engineers. Teaches system design and technical leadership.</p>
            <div class="instructor-stats">
              <div><b>7.9k</b>Students</div>
              <div><b>3</b>Courses</div>
              <div><b>4.9</b>Rating</div>
            </div>
          </article>
        </div>
      </div>
    </section>
    @endif

    @if(!isset($stats) || $stats->is_visible)
    <section data-section-key="stats_strip" data-section-id="{{ $stats->id ?? '' }}" style="background:linear-gradient(135deg,var(--wine-900),var(--wine-950))">
      <div class="container">
        <div class="stat-strip">
          @if(isset($stats) && is_array($stats?->config('items')))
            @foreach($stats?->config('items') as $stat)
              <div>
                <div class="v"><span data-count="{{ $stat['value'] ?? 0 }}">0</span>{{ $stat['suffix'] ?? '' }}</div>
                <div class="l">{{ $stat['label'] ?? '' }}</div>
              </div>
            @endforeach
          @else
            <div><div class="v" data-count="48500">0</div><div class="l">Students enrolled</div></div>
            <div><div class="v" data-count="74">0</div><div class="l">Countries reached</div></div>
            <div><div class="v"><span data-count="68">0</span>%</div><div class="l">Course completion rate</div></div>
            <div><div class="v"><span data-count="87">0</span>%</div><div class="l">Report career progression</div></div>
          @endif
        </div>
      </div>
    </section>
    @endif

    @if(!isset($cta) || $cta->is_visible)
    <section data-section-key="cta_banner" data-section-id="{{ $cta->id ?? '' }}" class="section">
      <div class="container">
        <div class="card card-pad" style="display:flex;justify-content:space-between;align-items:center;gap:28px;flex-wrap:wrap;padding:42px;border-color:var(--mustard-300)">
          <div style="max-width:560px">
            <h2 class="display" style="font-size:1.6rem">{{ $cta->title ?? 'Ready to start learning?' }}</h2>
            <p style="margin-top:12px;font-size:14.8px;color:var(--ink-500);line-height:1.7">
              {{ $cta->description ?? 'Browse 216 courses across eight disciplines, or speak to our team about corporate training for your organisation.' }}
            </p>
          </div>
          <div style="display:flex;gap:11px;flex-wrap:wrap">
            <a href="{{ $cta?->config('primary_btn_url', route('courses')) }}" class="btn btn-primary btn-lg">{{ $cta?->config('primary_btn_label', 'Browse courses') }}</a>
            <a href="{{ $cta?->config('secondary_btn_url', route('team')) }}" class="btn btn-outline btn-lg">{{ $cta?->config('secondary_btn_label', 'Meet the team') }}</a>
          </div>
        </div>
      </div>
    </section>
    @endif
</main>
@endsection
