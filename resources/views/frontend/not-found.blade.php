@extends('layouts.frontend')

@section('title', 'Page Not Found — Verdant Academy')

@section('content')
<main>
    <section class="section" style="padding:110px 0">
      <div class="container" style="text-align:center;max-width:640px">
        <div style="font-family:var(--font-display);font-size:clamp(5rem,14vw,9rem);font-weight:700;line-height:1;background:linear-gradient(140deg,var(--wine-700),var(--mustard-600));-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent">404</div>
        <h1 class="display" style="font-size:1.9rem;margin-top:16px">We couldn't find that page</h1>
        <p class="lead" style="margin-top:16px">
          The link may be broken, or the page may have been moved. Try searching for a course or book instead.
        </p>
        <div style="display:flex;gap:11px;justify-content:center;flex-wrap:wrap;margin-top:32px">
          <a href="{{ route('home') }}" class="btn btn-primary btn-lg"><i data-lucide="home"></i> Back to home</a>
          <a href="{{ route('courses') }}" class="btn btn-outline btn-lg"><i data-lucide="search"></i> Browse courses</a>
        </div>
      </div>
    </section>
  </main>
@endsection
