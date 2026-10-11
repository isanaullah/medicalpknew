@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Disclaimer — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Educational disclaimers and liability limitations.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $legal = $sections['legal_articles'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>{{ $hero->title ?? 'Disclaimer' }}</span></nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3vw,2.3rem)">{{ $hero->title ?? 'Disclaimer' }}</h1>
        <p class="small muted" style="margin-top:10px">{{ $hero->subtitle ?? 'Last updated: 22 June 2025' }}</p>
      </div>
    </section>
    @endif

    @if(!isset($legal) || $legal->is_visible)
    <section data-section-key="legal_articles" data-section-id="{{ $legal->id ?? '' }}" class="section-sm">
      <div class="container" style="max-width:820px">
        <p style="font-size:16px;line-height:1.8;color:var(--ink-700);margin-bottom:36px">{{ $hero->description ?? 'Please read this disclaimer carefully before relying on any content published on the Verdant Academy platform.' }}</p>
        <div style="display:flex;flex-direction:column;gap:32px">
          @if(isset($legal) && is_array($legal?->config('articles')))
            @foreach($legal?->config('articles') as $article)
              <div>
                <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">{{ $article['title'] ?? '' }}</h2>
                <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">{{ $article['text'] ?? '' }}</p>
              </div>
            @endforeach
          @else
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">1. Educational purpose only</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">All content on this platform is provided for general educational purposes. It does not constitute professional, legal, financial or medical advice and should not be relied upon as such.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">2. No guarantee of outcomes</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">While we publish completion and career outcome statistics honestly, we cannot and do not guarantee that any student will obtain employment, a promotion or a specific level of income after completing a course.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">3. Accuracy of information</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">We make reasonable efforts to keep course and book content current, but technology and industry practices change rapidly. We make no warranty that all content is complete, accurate or up to date.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">4. External links</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">Our platform may link to third-party websites. We are not responsible for the content, accuracy or privacy practices of those sites.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">5. Limitation of liability</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">To the maximum extent permitted by law, Verdant Academy is not liable for any indirect, incidental or consequential loss arising from your use of the platform.</p>
            </div>
          @endif
        </div>
        <div class="notice ivory" style="margin-top:44px">
          <i data-lucide="info"></i>
          <span>{{ $legal->body ?? 'This document is sample content created for a frontend demonstration and does not constitute legal advice.' }}</span>
        </div>
      </div>
    </section>
    @endif
</main>
@endsection
