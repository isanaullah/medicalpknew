@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Verdant Academy — Learn Skills That Matter')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Master software engineering, cloud systems, and modern AI with expert-led courses and career tracks.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $statsBar = $sections['stats_bar'] ?? null;
  $catIntro = $sections['categories_intro'] ?? null;
  $featIntro = $sections['featured_courses_intro'] ?? null;
  $whyVerdant = $sections['why_verdant'] ?? null;
  $pathsSec = $sections['learning_paths'] ?? null;
  $booksPromo = $sections['books_promo'] ?? null;
  $howItWorks = $sections['how_it_works'] ?? null;
  $instIntro = $sections['instructors_intro'] ?? null;
  $testimonials = $sections['testimonials'] ?? null;
  $blogIntro = $sections['blog_latest_intro'] ?? null;
  $faqHome = $sections['faq_home_intro'] ?? null;
  $newsletter = $sections['newsletter'] ?? null;
@endphp
<main>
    <!-- HERO SECTION -->
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="position:relative;overflow:hidden;background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300)">
      <div style="position:absolute;top:-200px;right:-150px;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(217,165,33,.16),transparent 65%);pointer-events:none"></div>
      <div style="position:absolute;bottom:-260px;left:-180px;width:640px;height:640px;border-radius:50%;background:radial-gradient(circle,rgba(184,85,120,.13),transparent 65%);pointer-events:none"></div>
      <div class="container" style="position:relative">
        <div class="grid g2" style="align-items:center;gap:56px;padding:72px 0 84px">
          <div>
            <span class="badge badge-forest" style="margin-bottom:22px"><i data-lucide="{{ $hero?->config('badge_icon', 'award') }}"></i> {{ $hero->subtitle ?? 'Accredited Online Academy' }}</span>
            <h1 class="display">{{ $hero->title ?? "Build a career you're proud of, one skill at a time." }}</h1>
            <p class="lead" style="margin-top:22px;max-width:540px">
              {{ $hero->description ?? 'Verdant Academy delivers structured, expert-led programmes and books in technology, business and design — with mentor feedback, graded projects and certificates recognised by hiring teams.' }}
            </p>
            <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:32px">
              <a href="{{ $hero?->config('primary_btn_url', route('courses')) }}" class="btn btn-primary btn-lg">{{ $hero?->config('primary_btn_label', 'Explore Courses') }} <i data-lucide="arrow-right"></i></a>
              <a href="{{ $hero?->config('secondary_btn_url', route('books')) }}" class="btn btn-outline btn-lg"><i data-lucide="book-open"></i> {{ $hero?->config('secondary_btn_label', 'Shop Books') }}</a>
            </div>
            <div style="display:flex;align-items:center;gap:18px;margin-top:36px;flex-wrap:wrap">
              <div class="avatar-stack">
                @if(isset($hero) && is_array($hero?->config('avatars')))
                  @foreach($hero?->config('avatars') as $avatar)
                    <img src="{{ $avatar }}" alt="" onerror="this.style.display='none'">
                  @endforeach
                @else
                  <img src="https://i.pravatar.cc/160?img=20" alt="" onerror="this.style.display='none'"><img src="https://i.pravatar.cc/160?img=15" alt="" onerror="this.style.display='none'"><img src="https://i.pravatar.cc/160?img=32" alt="" onerror="this.style.display='none'"><img src="https://i.pravatar.cc/160?img=51" alt="" onerror="this.style.display='none'">
                @endif
              </div>
              <div>
                <div style="display:flex;align-items:center;gap:7px">
                  <span class="stars"><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i></span> <b style="color:var(--ink-900);font-size:14.5px">{{ $hero?->config('rating', '4.9') }}</b>
                </div>
                <p class="small muted" style="margin-top:2px">from {{ $hero?->config('reviews_count', '12,480') }} verified student reviews</p>
              </div>
            </div>
          </div>
          <div style="position:relative">
            <div style="position:absolute;inset:-14px;border-radius:22px;background:linear-gradient(140deg,rgba(184,85,120,.16),rgba(217,165,33,.16));filter:blur(30px);pointer-events:none"></div>
            <img src="{{ $hero->image ?? 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1100&q=75' }}" alt="Students collaborating during an online academy workshop"
                 style="position:relative;width:100%;height:440px;object-fit:cover;border-radius:var(--radius-lg);box-shadow:var(--shadow-lg)"
                 onerror="this.style.display='none'">
            <div class="card card-pad" style="position:absolute;bottom:-22px;left:20px;width:242px;box-shadow:var(--shadow-lg);border-color:var(--mustard-300)">
              <div style="display:flex;align-items:center;gap:7px;font-size:11.5px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--wine-700)">
                <i data-lucide="trending-up" style="width:15px;height:15px"></i> {{ $hero?->config('outcome_label', 'Career outcomes') }}
              </div>
              <p class="display" style="font-size:2rem;margin-top:8px;color:var(--wine-800)">{{ $hero?->config('outcome_stat', '87%') }}</p>
              <p class="small muted" style="line-height:1.5">{{ $hero?->config('outcome_desc', 'of graduates report a role change within 8 months of finishing.') }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- STATS STRIP -->
    @if(!isset($statsBar) || $statsBar->is_visible)
    <section data-section-key="stats_bar" data-section-id="{{ $statsBar->id ?? '' }}" style="background:linear-gradient(135deg,var(--wine-900),var(--wine-950))">
      <div class="container">
        <div class="stat-strip">
          @if(isset($statsBar) && is_array($statsBar?->config('items')))
            @foreach($statsBar?->config('items') as $stat)
              <div>
                <div class="v"><span data-count="{{ $stat['value'] ?? 0 }}">0</span>{{ $stat['suffix'] ?? '' }}</div>
                <div class="l">{{ $stat['label'] ?? '' }}</div>
              </div>
            @endforeach
          @else
            <div><div class="v" data-count="48500">0</div><div class="l">Enrolled Students</div></div>
            <div><div class="v" data-count="216">0</div><div class="l">Expert-Led Courses</div></div>
            <div><div class="v" data-count="64">0</div><div class="l">Industry Instructors</div></div>
            <div><div class="v"><span data-count="96">0</span>%</div><div class="l">Student Satisfaction</div></div>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- CATEGORIES -->
    @if(!isset($catIntro) || $catIntro->is_visible)
    <section data-section-key="categories_intro" data-section-id="{{ $catIntro->id ?? '' }}" class="section">
      <div class="container">
        <div style="max-width:640px">
          <span class="eyebrow">{{ $catIntro->subtitle ?? 'Browse by field' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $catIntro->title ?? 'Popular course categories' }}</h2>
          <p class="lead" style="margin-top:16px">{{ $catIntro->description ?? 'Choose a discipline and follow a curriculum designed with hiring managers, not just academics.' }}</p>
        </div>
        <div class="grid g4" style="margin-top:44px">
          @if(isset($categories) && $categories->count() > 0)
            @foreach($categories as $cat)
              <a href="{{ route('courses', ['cat' => $cat->slug]) }}" class="card card-hover card-pad" style="display:block">
                <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="{{ $cat->icon ?? 'code-2' }}"></i></div>
                <h3 style="font-size:15.6px;margin-bottom:6px">{{ $cat->name }}</h3>
                <p class="small muted" style="line-height:1.55;min-height:40px">{{ Str::limit($cat->description, 55) }}</p>
                <p class="small" style="margin-top:12px;color:var(--wine-700);font-weight:600">{{ $cat->courses_count }} courses <i data-lucide="arrow-right" style="width:13px;height:13px;vertical-align:-2px"></i></p>
              </a>
            @endforeach
          @else
            <a href="{{ route('courses', ['cat' => 'web']) }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="code-2"></i></div>
              <h3 style="font-size:15.6px;margin-bottom:6px">Web Development</h3>
              <p class="small muted" style="line-height:1.55;min-height:40px">Frontend, backend and full-stack engineering.</p>
              <p class="small" style="margin-top:12px;color:var(--wine-700);font-weight:600">58 courses <i data-lucide="arrow-right" style="width:13px;height:13px;vertical-align:-2px"></i></p>
            </a>
            <a href="{{ route('courses', ['cat' => 'data']) }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="bar-chart-3"></i></div>
              <h3 style="font-size:15.6px;margin-bottom:6px">Data &amp; Analytics</h3>
              <p class="small muted" style="line-height:1.55;min-height:40px">SQL, Python, visualisation and machine learning.</p>
              <p class="small" style="margin-top:12px;color:var(--wine-700);font-weight:600">44 courses <i data-lucide="arrow-right" style="width:13px;height:13px;vertical-align:-2px"></i></p>
            </a>
            <a href="{{ route('courses', ['cat' => 'design']) }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="pen-tool"></i></div>
              <h3 style="font-size:15.6px;margin-bottom:6px">Product Design</h3>
              <p class="small muted" style="line-height:1.55;min-height:40px">UX research, interface design and design systems.</p>
              <p class="small" style="margin-top:12px;color:var(--wine-700);font-weight:600">37 courses <i data-lucide="arrow-right" style="width:13px;height:13px;vertical-align:-2px"></i></p>
            </a>
            <a href="{{ route('courses', ['cat' => 'business']) }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="briefcase"></i></div>
              <h3 style="font-size:15.6px;margin-bottom:6px">Business &amp; Management</h3>
              <p class="small muted" style="line-height:1.55;min-height:40px">Strategy, operations, finance and leadership.</p>
              <p class="small" style="margin-top:12px;color:var(--wine-700);font-weight:600">41 courses <i data-lucide="arrow-right" style="width:13px;height:13px;vertical-align:-2px"></i></p>
            </a>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- FEATURED COURSES -->
    @if(!isset($featIntro) || $featIntro->is_visible)
    <section data-section-key="featured_courses_intro" data-section-id="{{ $featIntro->id ?? '' }}" class="section section-alt divider-y">
      <div class="container">
        <div class="flex justify-between items-center wrap gap-16" style="align-items:flex-end">
          <div style="max-width:600px">
            <span class="eyebrow">{{ $featIntro->subtitle ?? 'Handpicked' }}</span>
            <h2 class="display" style="margin-top:14px">{{ $featIntro->title ?? 'Featured courses this term' }}</h2>
            <p class="lead" style="margin-top:16px">{{ $featIntro->description ?? 'Our most enrolled programmes, updated for the 2025 curriculum.' }}</p>
          </div>
          <a href="{{ $featIntro?->config('btn_url', route('courses')) }}" class="btn btn-outline">{{ $featIntro?->config('btn_label', 'View all courses') }} <i data-lucide="arrow-right"></i></a>
        </div>
        <div class="grid g3" style="margin-top:44px">
          @if(isset($featuredCourses) && $featuredCourses->count() > 0)
            @foreach($featuredCourses as $course)
              <article class="course-card">
                <div class="thumb">
                  <img src="{{ $course->thumbnail ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70' }}" alt="{{ $course->title }}" loading="lazy" onerror="this.style.display='none'">
                  <div class="thumb-tag">
                    <span class="badge {{ $course->is_featured ? 'badge-gold' : 'badge-ivory' }}">{{ $course->level }}</span>
                  </div>
                  <button class="thumb-fav" data-action="wishlist" data-id="{{ $course->id }}" aria-label="Save course">
                    <i data-lucide="heart"></i>
                  </button>
                </div>
                <div class="course-body">
                  <span class="course-cat">{{ $course->category->name ?? 'Course' }}</span>
                  <h3 class="course-title"><a href="{{ route('course.detail', $course->slug) }}">{{ $course->title }}</a></h3>
                  <div class="course-inst">
                    <img src="{{ $course->instructor->avatar ?? 'https://i.pravatar.cc/160?img=12' }}" alt="" onerror="this.style.display='none'">
                    <span>{{ $course->instructor->name ?? 'Verdant Faculty' }}</span>
                  </div>
                  <div class="course-meta">
                    <span><span class="stars"><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i></span> <b class="rating-val">4.9</b></span>
                  </div>
                  <div class="course-meta">
                    <span><i data-lucide="clock"></i>{{ $course->duration ?? '30h' }}</span>
                    <span><i data-lucide="play-circle"></i>{{ $course->lessons_count ?? '120' }} lessons</span>
                    <span><i data-lucide="signal"></i>{{ $course->level }}</span>
                  </div>
                  <div class="course-foot">
                    <span class="price">${{ $course->price }} @if($course->discount_price)<s>${{ $course->discount_price }}</s>@endif</span>
                    <a href="{{ route('course.detail', $course->slug) }}" class="btn btn-soft btn-sm">View</a>
                  </div>
                </div>
              </article>
            @endforeach
          @else
            <article class="course-card">
              <div class="thumb">
                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70" alt="The Complete Web Development Bootcamp" loading="lazy" onerror="this.style.display='none'">
                <div class="thumb-tag"><span class="badge badge-gold">Bestseller</span></div>
                <button class="thumb-fav" data-action="wishlist" data-id="1" aria-label="Save course"><i data-lucide="heart"></i></button>
              </div>
              <div class="course-body">
                <span class="course-cat">Web Development</span>
                <h3 class="course-title"><a href="{{ route('courses') }}">The Complete Web Development Bootcamp</a></h3>
                <div class="course-inst"><img src="https://i.pravatar.cc/160?img=12" alt="" onerror="this.style.display='none'"><span>Marcus Feld</span></div>
                <div class="course-meta"><span><span class="stars"><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i><i data-lucide="star"></i></span> <b class="rating-val">4.8</b> <span class="muted">(3,412)</span></span></div>
                <div class="course-meta"><span><i data-lucide="clock"></i>52h</span><span><i data-lucide="play-circle"></i>214 lessons</span><span><i data-lucide="signal"></i>Beginner</span></div>
                <div class="course-foot"><span class="price">$89<s>$189</s></span><a href="{{ route('courses') }}" class="btn btn-soft btn-sm">View</a></div>
              </div>
            </article>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- WHY VERDANT -->
    @if(!isset($whyVerdant) || $whyVerdant->is_visible)
    <section data-section-key="why_verdant" data-section-id="{{ $whyVerdant->id ?? '' }}" class="section">
      <div class="container">
        <div class="two-col">
          <div>
            <span class="eyebrow">{{ $whyVerdant->subtitle ?? 'Why Verdant' }}</span>
            <h2 class="display" style="margin-top:14px">{{ $whyVerdant->title ?? 'An academy built around how adults actually learn' }}</h2>
            <p class="lead" style="margin-top:20px">
              {{ $whyVerdant->description ?? 'We started Verdant Academy in 2016 after watching too many online courses end in an unfinished video playlist. Our programmes are paced, mentored and assessed — because accountability is what turns information into ability.' }}
            </p>
            <a href="{{ $whyVerdant?->config('btn_url', route('about')) }}" class="btn btn-outline" style="margin-top:28px">{{ $whyVerdant?->config('btn_label', 'Our story') }} <i data-lucide="arrow-right"></i></a>
          </div>
          <div class="grid g2 gap-lg">
            @if(isset($whyVerdant) && is_array($whyVerdant?->config('features')))
              @foreach($whyVerdant?->config('features') as $feat)
                <div class="feature">
                  <div class="feature-icon"><i data-lucide="{{ $feat['icon'] ?? 'check' }}"></i></div>
                  <h3>{{ $feat['title'] ?? '' }}</h3>
                  <p>{{ $feat['desc'] ?? '' }}</p>
                </div>
              @endforeach
            @else
              <div class="feature"><div class="feature-icon"><i data-lucide="users"></i></div><h3>Live mentor sessions</h3><p>Weekly small-group calls with practising professionals, not teaching assistants.</p></div>
              <div class="feature"><div class="feature-icon"><i data-lucide="folder-check"></i></div><h3>Portfolio projects</h3><p>Every programme ends with graded, real-world work you can show an employer.</p></div>
              <div class="feature"><div class="feature-icon"><i data-lucide="badge-check"></i></div><h3>Verified certificates</h3><p>Shareable credentials with a unique verification ID for each graduate.</p></div>
              <div class="feature"><div class="feature-icon"><i data-lucide="calendar-clock"></i></div><h3>Learn at your pace</h3><p>Lifetime access to lessons, with structured weekly milestones to keep momentum.</p></div>
            @endif
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- LEARNING PATHS -->
    @if(!isset($pathsSec) || $pathsSec->is_visible)
    <section data-section-key="learning_paths" data-section-id="{{ $pathsSec->id ?? '' }}" class="section section-alt divider-y" id="paths">
      <div class="container">
        <div style="max-width:640px">
          <span class="eyebrow">{{ $pathsSec->subtitle ?? 'Structured programmes' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $pathsSec->title ?? 'Popular learning paths' }}</h2>
          <p class="lead" style="margin-top:16px">{{ $pathsSec->description ?? 'Multi-course tracks that take you from fundamentals to job-ready in a defined number of weeks.' }}</p>
        </div>
        <div style="margin-top:42px;display:flex;flex-direction:column;gap:16px">
          @if(isset($pathsSec) && is_array($pathsSec?->config('items')))
            @foreach($pathsSec?->config('items') as $path)
              <div class="path-card">
                <div class="path-icon"><i data-lucide="{{ $path['icon'] ?? 'code-2' }}"></i></div>
                <div>
                  <h3 style="font-size:17px">{{ $path['title'] ?? '' }}</h3>
                  <p class="small muted" style="margin-top:6px;max-width:640px;line-height:1.6">{{ $path['desc'] ?? '' }}</p>
                  <div class="path-meta">
                    <span><i data-lucide="book-open"></i>{{ $path['courses'] ?? '' }}</span>
                    <span><i data-lucide="calendar"></i>{{ $path['duration'] ?? '' }}</span>
                    <span><i data-lucide="signal"></i>{{ $path['level'] ?? '' }}</span>
                  </div>
                </div>
                <a href="{{ route('paths') }}" class="btn btn-outline">View path</a>
              </div>
            @endforeach
          @else
            <div class="path-card">
              <div class="path-icon"><i data-lucide="code-2"></i></div>
              <div>
                <h3 style="font-size:17px">Full-Stack Developer Path</h3>
                <p class="small muted" style="margin-top:6px;max-width:640px;line-height:1.6">Six courses taking you from HTML fundamentals to deploying production applications.</p>
                <div class="path-meta"><span><i data-lucide="book-open"></i>6 courses</span><span><i data-lucide="calendar"></i>28 weeks</span><span><i data-lucide="signal"></i>Beginner → Advanced</span></div>
              </div>
              <a href="{{ route('paths') }}" class="btn btn-outline">View path</a>
            </div>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- BOOKS PROMO -->
    @if(!isset($booksPromo) || $booksPromo->is_visible)
    <section data-section-key="books_promo" data-section-id="{{ $booksPromo->id ?? '' }}" class="section">
      <div class="container">
        <div class="bundle-hero">
          <div>
            <span class="badge badge-gold" style="margin-bottom:16px"><i data-lucide="book-open"></i> {{ $booksPromo->subtitle ?? 'New: Books & Workbooks' }}</span>
            <h2 class="display" style="color:#fff;font-size:clamp(1.7rem,3vw,2.4rem);line-height:1.14">{{ $booksPromo->title ?? 'Learn deeper with our printed workbooks and companion guides.' }}</h2>
            <p style="margin-top:18px;color:rgba(184,149,166,.85);font-size:15px;line-height:1.72;max-width:560px">
              {{ $booksPromo->description ?? 'Written by the same instructors who teach our courses. Each book pairs with a specific programme, with 40–60 guided exercises, code samples and end-of-chapter assessments.' }}
            </p>
            <div style="display:flex;gap:12px;margin-top:26px;flex-wrap:wrap">
              <a href="{{ $booksPromo?->config('primary_btn_url', route('books')) }}" class="btn btn-gold btn-lg"><i data-lucide="shopping-bag"></i> {{ $booksPromo?->config('primary_btn_label', 'Browse the collection') }}</a>
              <a href="{{ $booksPromo?->config('secondary_btn_url', route('books')) }}" class="btn btn-white btn-lg" style="background:rgba(255,255,255,.1);color:#fff;border-color:rgba(255,255,255,.2)">{{ $booksPromo?->config('secondary_btn_label', 'View bundles') }}</a>
            </div>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;position:relative;z-index:1">
            @if(isset($booksPromo) && is_array($booksPromo?->config('images')))
              @foreach($booksPromo?->config('images') as $idx => $img)
                <div style="border-radius:10px;overflow:hidden;box-shadow:0 14px 34px rgba(0,0,0,.32);transform:rotate({{ $idx % 2 === 0 ? '-2deg' : '2deg' }});transition:.3s" class="book-tile">
                  <img src="{{ $img }}" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
                </div>
              @endforeach
            @else
              <div style="border-radius:10px;overflow:hidden;box-shadow:0 14px 34px rgba(0,0,0,.32);transform:rotate(-2deg);transition:.3s" class="book-tile">
                <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=75" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
              </div>
              <div style="border-radius:10px;overflow:hidden;box-shadow:0 14px 34px rgba(0,0,0,.32);transform:rotate(2deg);transition:.3s" class="book-tile">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=75" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- HOW IT WORKS -->
    @if(!isset($howItWorks) || $howItWorks->is_visible)
    <section data-section-key="how_it_works" data-section-id="{{ $howItWorks->id ?? '' }}" class="section section-alt divider-y">
      <div class="container">
        <div style="max-width:640px">
          <span class="eyebrow">{{ $howItWorks->subtitle ?? 'Getting started' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $howItWorks->title ?? 'How enrolment and learning works' }}</h2>
        </div>
        <ol class="grid g4" style="margin-top:52px">
          @if(isset($howItWorks) && is_array($howItWorks?->config('steps')))
            @foreach($howItWorks?->config('steps') as $step)
              <li class="step"><span class="step-num">{{ $step['num'] ?? '01' }}</span><h3>{{ $step['title'] ?? '' }}</h3><p>{{ $step['desc'] ?? '' }}</p></li>
            @endforeach
          @else
            <li class="step"><span class="step-num">01</span><h3>Create your account</h3><p>Register free in under a minute. No card required to browse or preview lessons.</p></li>
            <li class="step"><span class="step-num">02</span><h3>Choose your course</h3><p>Compare curriculum, level and duration. Read reviews from verified graduates.</p></li>
            <li class="step"><span class="step-num">03</span><h3>Enrol and start learning</h3><p>Get instant access to all modules, downloadable resources and the student community.</p></li>
            <li class="step"><span class="step-num">04</span><h3>Earn your certificate</h3><p>Complete assessments and receive a verifiable certificate for your profile.</p></li>
          @endif
        </ol>
      </div>
    </section>
    @endif

    <!-- INSTRUCTORS -->
    @if(!isset($instIntro) || $instIntro->is_visible)
    <section data-section-key="instructors_intro" data-section-id="{{ $instIntro->id ?? '' }}" class="section">
      <div class="container">
        <div class="flex justify-between items-center wrap gap-16" style="align-items:flex-end">
          <div style="max-width:600px">
            <span class="eyebrow">{{ $instIntro->subtitle ?? 'Our faculty' }}</span>
            <h2 class="display" style="margin-top:14px">{{ $instIntro->title ?? 'Learn from practitioners' }}</h2>
            <p class="lead" style="margin-top:16px">{{ $instIntro->description ?? 'Instructors who still work in their field, teaching what they use daily.' }}</p>
          </div>
          <a href="{{ $instIntro?->config('btn_url', route('courses')) }}" class="btn btn-outline">{{ $instIntro?->config('btn_label', 'Browse their courses') }} <i data-lucide="arrow-right"></i></a>
        </div>
        <div class="grid g4" style="margin-top:44px">
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=45" alt="Dr. Amara Osei" loading="lazy" onerror="this.style.display='none'">
            <h3>Dr. Amara Osei</h3>
            <div class="role">Lead Data Scientist</div>
            <p class="bio">Former principal data scientist with 12 years across fintech and healthcare analytics.</p>
            <div class="instructor-stats"><div><b>18.4k</b>Students</div><div><b>6</b>Courses</div><div><b>4.9</b>Rating</div></div>
          </article>
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=12" alt="Marcus Feld" loading="lazy" onerror="this.style.display='none'">
            <h3>Marcus Feld</h3>
            <div class="role">Full-Stack Engineer</div>
            <p class="bio">Built payment infrastructure at scale. Teaches the patterns he uses in production every day.</p>
            <div class="instructor-stats"><div><b>22.1k</b>Students</div><div><b>8</b>Courses</div><div><b>4.8</b>Rating</div></div>
          </article>
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=47" alt="Priya Raghunathan" loading="lazy" onerror="this.style.display='none'">
            <h3>Priya Raghunathan</h3>
            <div class="role">Product Design Director</div>
            <p class="bio">Design lead for two unicorn startups. Specialises in research-driven interface work.</p>
            <div class="instructor-stats"><div><b>14.7k</b>Students</div><div><b>5</b>Courses</div><div><b>4.9</b>Rating</div></div>
          </article>
          <article class="instructor-card">
            <img src="https://i.pravatar.cc/160?img=33" alt="Jonas Lindqvist" loading="lazy" onerror="this.style.display='none'">
            <h3>Jonas Lindqvist</h3>
            <div class="role">Cloud Architect</div>
            <p class="bio">AWS certified architect managing multi-region infrastructure for European media groups.</p>
            <div class="instructor-stats"><div><b>9.3k</b>Students</div><div><b>4</b>Courses</div><div><b>4.7</b>Rating</div></div>
          </article>
        </div>
      </div>
    </section>
    @endif

    <!-- TESTIMONIALS -->
    @if(!isset($testimonials) || $testimonials->is_visible)
    <section data-section-key="testimonials" data-section-id="{{ $testimonials->id ?? '' }}" class="section section-alt divider-y">
      <div class="container">
        <div style="max-width:640px">
          <span class="eyebrow">{{ $testimonials->subtitle ?? 'Student stories' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $testimonials->title ?? 'What graduates say' }}</h2>
        </div>
        <div class="grid g3" style="margin-top:44px">
          @if(isset($testimonials) && is_array($testimonials?->config('items')))
            @foreach($testimonials?->config('items') as $quote)
              <div class="quote-card">
                <div class="quote-mark">&ldquo;</div>
                <p class="quote-text">{{ $quote['quote'] ?? '' }}</p>
                <div class="quote-who">
                  <img src="{{ $quote['avatar'] ?? 'https://i.pravatar.cc/160?img=20' }}" alt="" onerror="this.style.display='none'">
                  <div><div class="nm">{{ $quote['name'] ?? '' }}</div><div class="rl">{{ $quote['role'] ?? '' }}</div></div>
                </div>
              </div>
            @endforeach
          @else
            <div class="quote-card">
              <div class="quote-mark">&ldquo;</div>
              <p class="quote-text">I had tried three other online courses before this. The difference here is the accountability — mentors actually review your work and tell you what to fix.</p>
              <div class="quote-who"><img src="https://i.pravatar.cc/160?img=20" alt="" onerror="this.style.display='none'"><div><div class="nm">Elena Petrova</div><div class="rl">Data Analyst at Northwind</div></div></div>
            </div>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- LATEST ARTICLES -->
    @if(!isset($blogIntro) || $blogIntro->is_visible)
    <section data-section-key="blog_latest_intro" data-section-id="{{ $blogIntro->id ?? '' }}" class="section">
      <div class="container">
        <div class="flex justify-between items-center wrap gap-16" style="align-items:flex-end">
          <div style="max-width:600px">
            <span class="eyebrow">{{ $blogIntro->subtitle ?? 'Learning resources' }}</span>
            <h2 class="display" style="margin-top:14px">{{ $blogIntro->title ?? 'Latest from the academy journal' }}</h2>
          </div>
          <a href="{{ $blogIntro?->config('btn_url', route('blog')) }}" class="btn btn-outline">{{ $blogIntro?->config('btn_label', 'All articles') }} <i data-lucide="arrow-right"></i></a>
        </div>
        <div class="grid g3" style="margin-top:44px">
          @if(isset($articles) && $articles->count() > 0)
            @foreach($articles as $article)
              <article class="article-card">
                <div class="thumb"><img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=70' }}" alt="{{ $article->title }}" loading="lazy" onerror="this.style.display='none'"></div>
                <div class="article-body">
                  <span class="badge badge-ivory" style="align-self:flex-start">{{ $article->category->name ?? 'Article' }}</span>
                  <h3><a href="{{ route('blog.detail', $article->slug) }}">{{ $article->title }}</a></h3>
                  <p>{{ Str::limit($article->excerpt, 100) }}</p>
                  <div class="article-meta">
                    <i data-lucide="calendar" style="width:14px;height:14px"></i>{{ $article->created_at->format('d M Y') }}
                    <span style="opacity:.4">•</span>5 min read
                  </div>
                </div>
              </article>
            @endforeach
          @else
            <article class="article-card">
              <div class="thumb"><img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=70" alt="How to Choose Your First Programming Language in 2025" loading="lazy" onerror="this.style.display='none'"></div>
              <div class="article-body">
                <span class="badge badge-ivory" style="align-self:flex-start">Career</span>
                <h3><a href="{{ route('blog') }}">How to Choose Your First Programming Language in 2025</a></h3>
                <p>The honest answer depends less on the language and more on what you want to build in the next six months.</p>
                <div class="article-meta"><i data-lucide="calendar" style="width:14px;height:14px"></i>02 Oct 2025<span style="opacity:.4">•</span>7 min read</div>
              </div>
            </article>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- FAQ HOME -->
    @if(!isset($faqHome) || $faqHome->is_visible)
    <section data-section-key="faq_home_intro" data-section-id="{{ $faqHome->id ?? '' }}" class="section section-alt divider-y">
      <div class="container">
        <div class="two-col" style="grid-template-columns:340px 1fr">
          <div>
            <span class="eyebrow">{{ $faqHome->subtitle ?? 'Questions' }}</span>
            <h2 class="display" style="margin-top:14px">{{ $faqHome->title ?? 'Frequently asked' }}</h2>
            <p class="lead" style="margin-top:16px">{{ $faqHome->description ?? "Can't find what you need? Our support team replies within one business day." }}</p>
            <a href="{{ $faqHome?->config('btn_url', route('contact')) }}" class="btn btn-outline" style="margin-top:22px">{{ $faqHome?->config('btn_label', 'Contact support') }}</a>
          </div>
          <div style="border-top:1px solid var(--cream-300)">
            @if(isset($faqs) && count($faqs) > 0)
              @foreach($faqs as $idx => $faq)
                <div class="accordion-item {{ $idx === 0 ? 'open' : '' }}">
                  <button class="acc-head" data-action="accordion" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                    <span>{{ $faq->question }}</span><i data-lucide="chevron-down"></i>
                  </button>
                  <div class="acc-body"><p>{!! nl2br(e($faq->answer)) !!}</p></div>
                </div>
              @endforeach
            @else
              <div class="accordion-item open">
                <button class="acc-head" data-action="accordion" aria-expanded="true">
                  <span>Do I get a certificate when I finish a course?</span><i data-lucide="chevron-down"></i>
                </button>
                <div class="acc-body"><p>Yes. Every course includes a verifiable certificate of completion. Once you finish all lessons and pass the final assessment, your certificate is generated automatically with a unique verification ID you can share on LinkedIn or with employers.</p></div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- NEWSLETTER -->
    @if(!isset($newsletter) || $newsletter->is_visible)
    <section data-section-key="newsletter" data-section-id="{{ $newsletter->id ?? '' }}" style="background:linear-gradient(135deg,var(--wine-900),var(--wine-950));position:relative;overflow:hidden">
      <div style="position:absolute;top:-100px;right:-80px;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(217,165,33,.24),transparent 70%);pointer-events:none"></div>
      <div class="container" style="padding:72px 24px;position:relative">
        <div class="grid g2" style="align-items:center;gap:44px">
          <div>
            <h2 class="display" style="color:#fff">{{ $newsletter->title ?? 'New courses, straight to your inbox' }}</h2>
            <p style="margin-top:14px;color:rgba(184,149,166,.85);max-width:520px;font-size:15px;line-height:1.7">
              {{ $newsletter->description ?? 'One email a fortnight with new course launches, free lessons and scholarship openings. No spam, unsubscribe anytime.' }}
            </p>
          </div>
          <form data-action="newsletter" style="width:100%;max-width:460px;justify-self:end" novalidate>
            <div style="display:flex;gap:11px;flex-wrap:wrap">
              <div style="flex:1;min-width:200px">
                <label class="sr-only" for="nl-email">Email address</label>
                <input id="nl-email" name="email" type="email" required class="input" placeholder="you@example.com"
                       style="background:rgba(253,251,246,.97);border-color:transparent;color:var(--ink-900)">
              </div>
              <button type="submit" class="btn btn-gold">Subscribe</button>
            </div>
            <p class="form-msg" style="margin-top:12px" aria-live="polite"></p>
          </form>
        </div>
      </div>
    </section>
    @endif
</main>
@endsection
