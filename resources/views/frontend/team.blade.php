@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Our Team — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Meet the instructors and engineering leaders teaching at Verdant Academy.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $stats = $sections['stats_strip'] ?? null;
  $leaderIntro = $sections['leadership_intro'] ?? null;
  $values = $sections['values'] ?? null;
  $culture = $sections['culture'] ?? null;
  $offices = $sections['offices'] ?? null;
  $careers = $sections['careers'] ?? null;
@endphp
<main>
    <!-- HERO -->
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" class="team-hero">
      <div class="container" style="position:relative;z-index:1">
        <div style="max-width:760px">
          <span class="eyebrow gold" style="color:var(--mustard-400)">{{ $hero->subtitle ?? 'The people behind Verdant' }}</span>
          <h1 class="display" style="color:#fff;margin-top:14px;font-size:clamp(2rem,4.2vw,3.2rem);line-height:1.08">
            {{ $hero->title ?? 'A small, senior team building education we would want our own children to take.' }}
          </h1>
          <p style="margin-top:22px;color:rgba(184,149,166,.85);font-size:16.5px;line-height:1.72;max-width:600px">
            {{ $hero->description ?? 'We are 64 people across 14 countries — instructors, curriculum designers, engineers and student-support specialists who believe professional education should be completable, honest and genuinely useful.' }}
          </p>
          <div style="display:flex;gap:12px;margin-top:32px;flex-wrap:wrap">
            <a href="{{ $hero?->config('primary_btn_url', '#careers') }}" class="btn btn-gold btn-lg"><i data-lucide="briefcase"></i> {{ $hero?->config('primary_btn_label', 'See open roles') }}</a>
            <a href="{{ $hero?->config('secondary_btn_url', route('contact')) }}" class="btn btn-lg" style="background:rgba(255,255,255,.1);color:#fff;border:1px solid rgba(255,255,255,.2)">{{ $hero?->config('secondary_btn_label', 'Get in touch') }}</a>
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- STAT STRIP -->
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
            <div><div class="v" data-count="64">0</div><div class="l">Team members</div></div>
            <div><div class="v" data-count="14">0</div><div class="l">Countries</div></div>
            <div><div class="v" data-count="4">0</div><div class="l">Offices worldwide</div></div>
            <div><div class="v"><span data-count="9">0</span> yrs</div><div class="l">Average experience</div></div>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- LEADERSHIP -->
    <section class="section">
      <div class="container">
        @if(!isset($leaderIntro) || $leaderIntro->is_visible)
        <div data-section-key="leadership_intro" data-section-id="{{ $leaderIntro->id ?? '' }}" style="max-width:640px;margin-bottom:52px">
          <span class="eyebrow">{{ $leaderIntro->subtitle ?? 'Leadership' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $leaderIntro->title ?? 'The people leading Verdant' }}</h2>
          <p class="lead" style="margin-top:16px">
            {{ $leaderIntro->description ?? 'Between them, our leadership team has run learning platforms used by over four million students and built curricula for three accredited universities.' }}
          </p>
        </div>
        @endif
        <div class="grid g4">
          
            <div class="team-card">
              <img class="tphoto" src="https://i.pravatar.cc/160?img=48" alt="Eleanor Whitfield" onerror="this.style.display='none'">
              <h3>Eleanor Whitfield</h3>
              <div class="trole">Co-founder &amp; CEO</div>
              <p class="tbio">Former VP of Learning at a global ed-tech company. Founded Verdant to make structured professional education genuinely completable.</p>
              <div class="tsocial">
                <a href="{{ route('home') }}" aria-label="LinkedIn"><i data-lucide="linkedin"></i></a>
                <a href="{{ route('home') }}" aria-label="X"><i data-lucide="twitter"></i></a>
                <a href="{{ route('contact') }}" aria-label="Email"><i data-lucide="mail"></i></a>
              </div>
            </div>
            <div class="team-card">
              <img class="tphoto" src="https://i.pravatar.cc/160?img=14" alt="Rahul Anand" onerror="this.style.display='none'">
              <h3>Rahul Anand</h3>
              <div class="trole">Co-founder &amp; CTO</div>
              <p class="tbio">Built learning platforms used by 4 million students. Leads the product and engineering organisation at Verdant.</p>
              <div class="tsocial">
                <a href="{{ route('home') }}" aria-label="LinkedIn"><i data-lucide="linkedin"></i></a>
                <a href="{{ route('home') }}" aria-label="X"><i data-lucide="twitter"></i></a>
                <a href="{{ route('contact') }}" aria-label="Email"><i data-lucide="mail"></i></a>
              </div>
            </div>
            <div class="team-card">
              <img class="tphoto" src="https://i.pravatar.cc/160?img=41" alt="Beatriz Castellanos" onerror="this.style.display='none'">
              <h3>Beatriz Castellanos</h3>
              <div class="trole">Chief Academic Officer</div>
              <p class="tbio">Designed curricula for three accredited universities. Ensures every Verdant programme meets real industry standards.</p>
              <div class="tsocial">
                <a href="{{ route('home') }}" aria-label="LinkedIn"><i data-lucide="linkedin"></i></a>
                <a href="{{ route('home') }}" aria-label="X"><i data-lucide="twitter"></i></a>
                <a href="{{ route('contact') }}" aria-label="Email"><i data-lucide="mail"></i></a>
              </div>
            </div>
            <div class="team-card">
              <img class="tphoto" src="https://i.pravatar.cc/160?img=52" alt="Tobias Keller" onerror="this.style.display='none'">
              <h3>Tobias Keller</h3>
              <div class="trole">Chief Operating Officer</div>
              <p class="tbio">Fifteen years running operations at high-growth education businesses across Europe and North America.</p>
              <div class="tsocial">
                <a href="{{ route('home') }}" aria-label="LinkedIn"><i data-lucide="linkedin"></i></a>
                <a href="{{ route('home') }}" aria-label="X"><i data-lucide="twitter"></i></a>
                <a href="{{ route('contact') }}" aria-label="Email"><i data-lucide="mail"></i></a>
              </div>
            </div>
        </div>
      </div>
    </section>

    <!-- FACULTY -->
    <section class="section section-alt divider-y">
      <div class="container">
        <div class="flex justify-between items-center wrap gap-16" style="align-items:flex-end;margin-bottom:44px">
          <div style="max-width:600px">
            <span class="eyebrow">Faculty</span>
            <h2 class="display" style="margin-top:14px">Our teaching staff</h2>
            <p class="lead" style="margin-top:16px">
              Six lead instructors, each still practising in their field. Between them they teach
              31 courses to over 48,000 students.
            </p>
          </div>
          <a href="{{ route('courses') }}" class="btn btn-outline">Browse their courses <i data-lucide="arrow-right"></i></a>
        </div>
        <div class="grid g3"><article class="instructor-card">
    <img src="https://i.pravatar.cc/160?img=45" alt="Dr. Amara Osei" loading="lazy" onerror="this.style.display='none'">
    <h3>Dr. Amara Osei</h3>
    <div class="role">Lead Data Scientist</div>
    <p class="bio">Former principal data scientist with 12 years across fintech and healthcare analytics.</p>
    <div class="instructor-stats">
      <div><b>18.4k</b>Students</div>
      <div><b>6</b>Courses</div>
      <div><b>4.9</b>Rating</div>
    </div>
  </article><article class="instructor-card">
    <img src="https://i.pravatar.cc/160?img=12" alt="Marcus Feld" loading="lazy" onerror="this.style.display='none'">
    <h3>Marcus Feld</h3>
    <div class="role">Full-Stack Engineer</div>
    <p class="bio">Built payment infrastructure at scale. Teaches the patterns he uses in production every day.</p>
    <div class="instructor-stats">
      <div><b>22.1k</b>Students</div>
      <div><b>8</b>Courses</div>
      <div><b>4.8</b>Rating</div>
    </div>
  </article><article class="instructor-card">
    <img src="https://i.pravatar.cc/160?img=47" alt="Priya Raghunathan" loading="lazy" onerror="this.style.display='none'">
    <h3>Priya Raghunathan</h3>
    <div class="role">Product Design Director</div>
    <p class="bio">Design lead for two unicorn startups. Specialises in research-driven interface work.</p>
    <div class="instructor-stats">
      <div><b>14.7k</b>Students</div>
      <div><b>5</b>Courses</div>
      <div><b>4.9</b>Rating</div>
    </div>
  </article><article class="instructor-card">
    <img src="https://i.pravatar.cc/160?img=33" alt="Jonas Lindqvist" loading="lazy" onerror="this.style.display='none'">
    <h3>Jonas Lindqvist</h3>
    <div class="role">Cloud Architect</div>
    <p class="bio">AWS certified architect managing multi-region infrastructure for European media groups.</p>
    <div class="instructor-stats">
      <div><b>9.3k</b>Students</div>
      <div><b>4</b>Courses</div>
      <div><b>4.7</b>Rating</div>
    </div>
  </article><article class="instructor-card">
    <img src="https://i.pravatar.cc/160?img=26" alt="Helena Marchetti" loading="lazy" onerror="this.style.display='none'">
    <h3>Helena Marchetti</h3>
    <div class="role">Growth Marketing Lead</div>
    <p class="bio">Scaled three B2B SaaS companies from launch to series B using paid and content channels.</p>
    <div class="instructor-stats">
      <div><b>11.4k</b>Students</div>
      <div><b>5</b>Courses</div>
      <div><b>4.8</b>Rating</div>
    </div>
  </article><article class="instructor-card">
    <img src="https://i.pravatar.cc/160?img=59" alt="Samuel Adeyemi" loading="lazy" onerror="this.style.display='none'">
    <h3>Samuel Adeyemi</h3>
    <div class="role">Engineering Manager</div>
    <p class="bio">Leads a platform team of 14 engineers. Teaches system design and technical leadership.</p>
    <div class="instructor-stats">
      <div><b>7.9k</b>Students</div>
      <div><b>3</b>Courses</div>
      <div><b>4.9</b>Rating</div>
    </div>
  </article></div>
      </div>
    </section>

    <!-- VALUES -->
    @if(!isset($values) || $values->is_visible)
    <section data-section-key="values" data-section-id="{{ $values->id ?? '' }}" class="section">
      <div class="container">
        <div style="max-width:640px;margin-bottom:48px">
          <span class="eyebrow">{{ $values->subtitle ?? 'What we believe' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $values->title ?? 'Four principles that shape every decision' }}</h2>
        </div>
        <div class="grid g4">
          @if(isset($values) && is_array($values?->config('items')))
            @foreach($values?->config('items') as $val)
              <div class="value-card">
                <div class="vnum">{{ $val['num'] ?? '01' }}</div>
                <h3>{{ $val['title'] ?? '' }}</h3>
                <p>{{ $val['desc'] ?? '' }}</p>
              </div>
            @endforeach
          @else
            <div class="value-card">
              <div class="vnum">01</div>
              <h3>Teach only what we practise</h3>
              <p>Every instructor at Verdant still works in their field. We teach what we use daily, not what we read about.</p>
            </div>
            <div class="value-card">
              <div class="vnum">02</div>
              <h3>Pace for real life</h3>
              <p>Lessons are short, milestones are weekly, and completion is the measure we optimise for — not enrolment.</p>
            </div>
            <div class="value-card">
              <div class="vnum">03</div>
              <h3>Give honest feedback</h3>
              <p>Mentors tell students what is not working as clearly as what is. That honesty is why our completion rate is 4× the industry average.</p>
            </div>
            <div class="value-card">
              <div class="vnum">04</div>
              <h3>Publish outcomes openly</h3>
              <p>Pricing, completion rates and career outcomes are public. If we cannot measure it, we do not claim it.</p>
            </div>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- CULTURE / PHOTO GRID -->
    @if(!isset($culture) || $culture->is_visible)
    <section data-section-key="culture" data-section-id="{{ $culture->id ?? '' }}" class="section section-alt divider-y">
      <div class="container">
        <div style="max-width:640px;margin-bottom:44px">
          <span class="eyebrow">{{ $culture->subtitle ?? 'Life at Verdant' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $culture->title ?? 'Distributed, deliberate, and quiet by default' }}</h2>
          <p class="lead" style="margin-top:16px">
            {{ $culture->description ?? 'We work asynchronously, meet in person twice a year, and protect long blocks of focused time — because good courses are built slowly.' }}
          </p>
        </div>
        <div class="grid g4" style="gap:14px">
          @if(isset($culture) && is_array($culture?->config('photos')))
            @foreach($culture?->config('photos') as $idx => $photo)
              <div class="culture-photo" style="{{ $idx === 0 ? 'grid-column:span 2;grid-row:span 2' : '' }}">
                <img src="{{ $photo }}" alt="Team photo" onerror="this.style.display='none'">
              </div>
            @endforeach
          @else
            <div class="culture-photo" style="grid-column:span 2;grid-row:span 2">
              <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=75" alt="Team working together" onerror="this.style.display='none'">
            </div>
            <div class="culture-photo"><img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=75" alt="Team meeting" onerror="this.style.display='none'"></div>
            <div class="culture-photo"><img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=75" alt="Office space" onerror="this.style.display='none'"></div>
            <div class="culture-photo"><img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=75" alt="Workshop session" onerror="this.style.display='none'"></div>
            <div class="culture-photo"><img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1000&q=75" alt="Learning in progress" onerror="this.style.display='none'"></div>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- SUPPORT TEAM -->
    <section class="section">
      <div class="container">
        <div style="max-width:640px;margin-bottom:44px">
          <span class="eyebrow">Support & operations</span>
          <h2 class="display" style="margin-top:14px">The team behind the scenes</h2>
          <p class="lead" style="margin-top:16px">
            Curriculum designers, engineers, marketers and student-support specialists who keep
            the academy running day to day.
          </p>
        </div>
        <div class="grid g4">
          
            <div class="team-mini">
              <img src="https://i.pravatar.cc/160?img=49" alt="Naomi Clarke" onerror="this.style.display='none'">
              <div style="min-width:0">
                <div class="tmname">Naomi Clarke</div>
                <div class="tmrole">Head of Student Support</div>
                <div class="tmloc"><i data-lucide="map-pin"></i>London</div>
              </div>
            </div>
            <div class="team-mini">
              <img src="https://i.pravatar.cc/160?img=61" alt="Kwame Boateng" onerror="this.style.display='none'">
              <div style="min-width:0">
                <div class="tmname">Kwame Boateng</div>
                <div class="tmrole">Director of Instructor Success</div>
                <div class="tmloc"><i data-lucide="map-pin"></i>Accra</div>
              </div>
            </div>
            <div class="team-mini">
              <img src="https://i.pravatar.cc/160?img=27" alt="Sofia Novak" onerror="this.style.display='none'">
              <div style="min-width:0">
                <div class="tmname">Sofia Novak</div>
                <div class="tmrole">Head of Curriculum</div>
                <div class="tmloc"><i data-lucide="map-pin"></i>Warsaw</div>
              </div>
            </div>
            <div class="team-mini">
              <img src="https://i.pravatar.cc/160?img=36" alt="David Kim" onerror="this.style.display='none'">
              <div style="min-width:0">
                <div class="tmname">David Kim</div>
                <div class="tmrole">Engineering Manager, Platform</div>
                <div class="tmloc"><i data-lucide="map-pin"></i>Seoul</div>
              </div>
            </div>
            <div class="team-mini">
              <img src="https://i.pravatar.cc/160?img=23" alt="Amelia Hart" onerror="this.style.display='none'">
              <div style="min-width:0">
                <div class="tmname">Amelia Hart</div>
                <div class="tmrole">Head of Marketing</div>
                <div class="tmloc"><i data-lucide="map-pin"></i>London</div>
              </div>
            </div>
            <div class="team-mini">
              <img src="https://i.pravatar.cc/160?img=54" alt="Yusuf Demir" onerror="this.style.display='none'">
              <div style="min-width:0">
                <div class="tmname">Yusuf Demir</div>
                <div class="tmrole">Head of Corporate Partnerships</div>
                <div class="tmloc"><i data-lucide="map-pin"></i>Istanbul</div>
              </div>
            </div>
            <div class="team-mini">
              <img src="https://i.pravatar.cc/160?img=30" alt="Lucia Rossi" onerror="this.style.display='none'">
              <div style="min-width:0">
                <div class="tmname">Lucia Rossi</div>
                <div class="tmrole">Learning Experience Designer</div>
                <div class="tmloc"><i data-lucide="map-pin"></i>Milan</div>
              </div>
            </div>
            <div class="team-mini">
              <img src="https://i.pravatar.cc/160?img=65" alt="Ethan Brooks" onerror="this.style.display='none'">
              <div style="min-width:0">
                <div class="tmname">Ethan Brooks</div>
                <div class="tmrole">Data &amp; Analytics Lead</div>
                <div class="tmloc"><i data-lucide="map-pin"></i>Toronto</div>
              </div>
            </div>
        </div>
      </div>
    </section>

    <!-- OFFICES -->
    @if(!isset($offices) || $offices->is_visible)
    <section data-section-key="offices" data-section-id="{{ $offices->id ?? '' }}" class="section section-alt divider-y">
      <div class="container">
        <div style="max-width:640px;margin-bottom:44px">
          <span class="eyebrow">{{ $offices->subtitle ?? 'Where we work' }}</span>
          <h2 class="display" style="margin-top:14px">{{ $offices->title ?? 'Four hubs, one academy' }}</h2>
        </div>
        <div class="grid g4">
          @if(isset($offices) && is_array($offices?->config('hubs')))
            @foreach($offices?->config('hubs') as $hub)
              <div class="office-card">
                <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="building-2"></i></div>
                <div class="ocity">{{ $hub['city'] ?? '' }}</div>
                <div class="ocountry">{{ $hub['country'] ?? '' }}</div>
                <div class="oaddr">{!! $hub['address'] ?? '' !!}</div>
                <div class="oteam"><i data-lucide="users" style="width:14px;height:14px"></i> {{ $hub['team'] ?? '' }}</div>
              </div>
            @endforeach
          @else
            <div class="office-card">
              <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="building-2"></i></div>
              <div class="ocity">London</div>
              <div class="ocountry">United Kingdom</div>
              <div class="oaddr">42 Alder House, Kingsway<br>London WC2B 6AN</div>
              <div class="oteam"><i data-lucide="users" style="width:14px;height:14px"></i> 18 people</div>
            </div>
            <div class="office-card">
              <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="building-2"></i></div>
              <div class="ocity">Berlin</div>
              <div class="ocountry">Germany</div>
              <div class="oaddr">Friedrichstraße 68<br>10117 Berlin</div>
              <div class="oteam"><i data-lucide="users" style="width:14px;height:14px"></i> 9 people</div>
            </div>
            <div class="office-card">
              <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="building-2"></i></div>
              <div class="ocity">Toronto</div>
              <div class="ocountry">Canada</div>
              <div class="oaddr">120 Adelaide Street West<br>Toronto, ON M5H 1T1</div>
              <div class="oteam"><i data-lucide="users" style="width:14px;height:14px"></i> 6 people</div>
            </div>
            <div class="office-card">
              <div class="stat-icon" style="margin-bottom:16px"><i data-lucide="globe-2"></i></div>
              <div class="ocity">Remote</div>
              <div class="ocountry">Worldwide</div>
              <div class="oaddr">Distributed across 14 countries<br>Supporting students 24/5</div>
              <div class="oteam"><i data-lucide="users" style="width:14px;height:14px"></i> 31 people</div>
            </div>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- CAREERS CTA -->
    @if(!isset($careers) || $careers->is_visible)
    <section id="careers" data-section-key="careers" data-section-id="{{ $careers->id ?? '' }}" class="section">
      <div class="container">
        <div class="card card-pad" style="padding:44px;border-color:var(--mustard-300);position:relative;overflow:hidden">
          <div style="position:absolute;top:-80px;right:-80px;width:280px;height:280px;border-radius:50%;background:radial-gradient(circle,rgba(217,165,33,.15),transparent 70%);pointer-events:none"></div>
          <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:44px;align-items:center;position:relative;z-index:1" class="g2">
            <div>
              <span class="eyebrow">{{ $careers->subtitle ?? 'Join us' }}</span>
              <h2 class="display" style="margin-top:14px;font-size:1.75rem">{{ $careers->title ?? 'We are hiring thoughtful people.' }}</h2>
              <p style="margin-top:16px;font-size:15px;color:var(--ink-500);line-height:1.72;max-width:560px">
                {{ $careers->description ?? 'We look for people who have built things they are proud of, care about craft and want to work on education that actually helps people change their careers. We hire slowly and deliberately — usually one or two people per quarter.' }}
              </p>
              <div style="display:flex;gap:12px;margin-top:26px;flex-wrap:wrap">
                <a href="{{ $careers?->config('primary_btn_url', route('contact')) }}" class="btn btn-primary btn-lg"><i data-lucide="send"></i> {{ $careers?->config('primary_btn_label', 'Send us your CV') }}</a>
                <a href="{{ $careers?->config('secondary_btn_url', route('contact')) }}" class="btn btn-outline btn-lg">{{ $careers?->config('secondary_btn_label', 'General enquiries') }}</a>
              </div>
            </div>
            <div>
              <div class="notice gold" style="align-items:flex-start">
                <i data-lucide="briefcase"></i>
                <div>
                  <div style="font-weight:700;font-size:13.6px;margin-bottom:6px">{{ $careers?->config('openings_title', 'Currently hiring') }}</div>
                  <ul class="bullet-list" style="margin-top:6px;font-size:13.4px">
                    @if(isset($careers) && is_array($careers?->config('roles')))
                      @foreach($careers?->config('roles') as $role)
                        <li>{{ $role }}</li>
                      @endforeach
                    @else
                      <li>Senior Curriculum Designer (Remote, EU)</li>
                      <li>Platform Engineer — Node & PostgreSQL (London)</li>
                      <li>Student Support Specialist (Toronto)</li>
                      <li>Growth Marketing Manager (Berlin)</li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
  </main>
@endsection
