@extends('layouts.frontend')

@section('title', 'Article — Verdant Academy')

@section('content')
<main>
    <section style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:42px 0">
      <div class="container" style="max-width:820px">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a><span class="sep">/</span><a href="{{ route('blog') }}">Blog</a><span class="sep">/</span><span>Career</span>
        </nav>
        <h1 class="display" style="font-size:clamp(1.6rem,3vw,2.2rem)">How to Choose Your First Programming Language in 2025</h1>
        <div style="display:flex;align-items:center;gap:12px;margin-top:22px;flex-wrap:wrap">
          <img src="https://i.pravatar.cc/160?img=12" alt="" style="width:42px;height:42px;border-radius:50%;object-fit:cover" onerror="this.style.display='none'">
          <div>
            <div style="font-size:14px;font-weight:600;color:var(--ink-900)">Marcus Feld</div>
            <div class="small muted">02 Oct 2025 · 7 min read</div>
          </div>
        </div>
      </div>
    </section>
    <section class="section-sm">
      <div class="container" style="max-width:820px">
        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=70" alt="" style="width:100%;height:380px;object-fit:cover;border-radius:var(--radius-lg);margin-bottom:40px;box-shadow:var(--shadow-md)" onerror="this.style.display='none'">
        <div style="font-size:16px;line-height:1.85;color:var(--ink-700)">
          <p style="margin-bottom:22px">The honest answer depends less on the language and more on what you want to build in the next six months.</p>
          <p style="margin-bottom:22px">The honest answer depends less on the language itself and more on what you want to build in the next six months. Most beginners spend weeks comparing syntax when they should be comparing the problems each ecosystem solves well.</p>
          <h2 class="display" style="font-size:1.45rem;margin:36px 0 16px">Start with the destination, not the tool</h2>
          <p style="margin-bottom:22px">If your goal is to build data pipelines and analysis tools, Python has the deepest ecosystem and the most forgiving learning curve. If you want to build interactive interfaces in a browser, JavaScript is unavoidable — and it is far more pleasant to learn today than it was a decade ago.</p>
          <blockquote style="border-left:3px solid var(--mustard-500);padding:6px 0 6px 24px;margin:32px 0;font-family:var(--font-display);font-size:1.18rem;font-weight:500;color:var(--wine-800);line-height:1.55">
            The language you pick matters far less than the number of complete projects you finish with it.
          </blockquote>
          <h2 class="display" style="font-size:1.45rem;margin:36px 0 16px">What actually predicts success</h2>
          <p style="margin-bottom:22px">Across our cohorts, the strongest predictor of completion is not prior experience or aptitude — it is whether a student has a concrete project they want to build. Students with a project finish at nearly twice the rate of those learning "for general knowledge".</p>
          <ul class="bullet-list" style="margin-bottom:22px">
            <li>Pick one language and commit for at least three months</li>
            <li>Build something you personally want to exist</li>
            <li>Share your work publicly, even when it is rough</li>
            <li>Read other people's code more than you read tutorials</li>
          </ul>
          <p>Whatever you choose, start this week. The gap between deciding and beginning is where most learning ambitions quietly disappear.</p>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:44px;padding-top:28px;border-top:1px solid var(--cream-300)">
          <span class="small muted" style="font-weight:600;align-self:center">Share:</span>
          <a href="{{ route('home') }}" class="btn btn-outline btn-sm"><i data-lucide="linkedin"></i> LinkedIn</a>
          <a href="{{ route('home') }}" class="btn btn-outline btn-sm"><i data-lucide="twitter"></i> X</a>
          <a href="{{ route('home') }}" class="btn btn-outline btn-sm"><i data-lucide="link"></i> Copy link</a>
        </div>

        <div class="card card-pad" style="margin-top:38px;display:flex;gap:18px;flex-wrap:wrap;align-items:center;border-color:var(--mustard-300)">
          <img src="https://i.pravatar.cc/160?img=12" alt="" style="width:72px;height:72px;border-radius:50%;object-fit:cover;flex:none" onerror="this.style.display='none'">
          <div style="flex:1;min-width:220px">
            <div style="font-size:15px;font-weight:600;color:var(--ink-900)">Marcus Feld</div>
            <div class="small" style="color:var(--mustard-700);font-weight:600">Full-Stack Engineer</div>
            <p class="small muted" style="margin-top:8px;line-height:1.65">Built payment infrastructure at scale. Teaches the patterns he uses in production every day.</p>
          </div>
          <a href="{{ route('courses') }}" class="btn btn-outline">View courses</a>
        </div>
      </div>
    </section>
  </main>
@endsection
