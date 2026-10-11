@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Terms & Conditions — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'The terms, conditions, and usage policies governing Verdant Academy.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $legal = $sections['legal_articles'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>{{ $hero->title ?? 'Terms & Conditions' }}</span></nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3vw,2.3rem)">{{ $hero->title ?? 'Terms & Conditions' }}</h1>
        <p class="small muted" style="margin-top:10px">{{ $hero->subtitle ?? 'Last updated: 22 June 2025' }}</p>
      </div>
    </section>
    @endif

    @if(!isset($legal) || $legal->is_visible)
    <section data-section-key="legal_articles" data-section-id="{{ $legal->id ?? '' }}" class="section-sm">
      <div class="container" style="max-width:820px">
        <p style="font-size:16px;line-height:1.8;color:var(--ink-700);margin-bottom:36px">{{ $hero->description ?? 'These terms govern your use of the Verdant Academy platform, the courses and books purchased through it.' }}</p>
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
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">1. Account responsibilities</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">You are responsible for maintaining the confidentiality of your account credentials and for all activity that occurs under your account. Accounts are personal and may not be shared.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">2. Course access and licence</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">Purchasing a course grants you a personal, non-transferable licence to access its content for your own learning. Redistribution, resale or public performance of course materials is prohibited.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">3. Book purchases</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">Books sold through Verdant Press are covered by our shipping and returns policy. eBooks are licensed for personal use only and may not be redistributed.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">4. Payments and refunds</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">All prices are displayed in US dollars and include applicable taxes where required. Course refunds are available within 30 days of purchase provided less than 30% of the course has been completed. Physical books may be returned within 30 days in original condition.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">5. Intellectual property</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">All course and book content, including videos, written materials, code samples and assessments, remains the intellectual property of Verdant Academy or its instructors.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">6. Acceptable use</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">You agree not to harass instructors or other students, post unlawful content, attempt to circumvent platform security, or use the platform to distribute unsolicited commercial messages.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">7. Changes to these terms</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">We may update these terms to reflect changes in our services or legal obligations. Material changes will be communicated by email at least 14 days in advance.</p>
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
