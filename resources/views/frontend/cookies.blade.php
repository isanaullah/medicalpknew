@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Cookie Policy — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Details on cookies and tracking technologies used on our website.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $legal = $sections['legal_articles'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>{{ $hero->title ?? 'Cookie Policy' }}</span></nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3vw,2.3rem)">{{ $hero->title ?? 'Cookie Policy' }}</h1>
        <p class="small muted" style="margin-top:10px">{{ $hero->subtitle ?? 'Last updated: 22 June 2025' }}</p>
      </div>
    </section>
    @endif

    @if(!isset($legal) || $legal->is_visible)
    <section data-section-key="legal_articles" data-section-id="{{ $legal->id ?? '' }}" class="section-sm">
      <div class="container" style="max-width:820px">
        <p style="font-size:16px;line-height:1.8;color:var(--ink-700);margin-bottom:36px">{{ $hero->description ?? 'This policy explains how Verdant Academy uses cookies and similar technologies on our website.' }}</p>
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
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">1. What cookies are</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">Cookies are small text files placed on your device when you visit a website. They allow the site to remember your actions and preferences over time.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">2. Strictly necessary cookies</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">These cookies are required for the platform to function — for example, maintaining your login session and remembering your shopping cart. They cannot be disabled.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">3. Analytics cookies</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">We use analytics cookies to understand how visitors navigate the platform, which pages are most visited and where users encounter problems. Data is aggregated and anonymised.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">4. Marketing cookies</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">Where you have consented, we use marketing cookies to measure the effectiveness of our advertising campaigns and to avoid showing you the same advertisement repeatedly.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">5. Managing cookies</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">You can control cookies through your browser settings. Disabling strictly necessary cookies will prevent parts of the platform from working correctly.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">6. Contact</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">Questions about our use of cookies can be sent to privacy@verdantacademy.com.</p>
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
