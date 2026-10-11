@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Privacy Policy — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Read our complete privacy policy and information handling practices.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $legal = $sections['legal_articles'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>{{ $hero->title ?? 'Privacy Policy' }}</span></nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3vw,2.3rem)">{{ $hero->title ?? 'Privacy Policy' }}</h1>
        <p class="small muted" style="margin-top:10px">{{ $hero->subtitle ?? 'Last updated: 22 June 2025' }}</p>
      </div>
    </section>
    @endif

    @if(!isset($legal) || $legal->is_visible)
    <section data-section-key="legal_articles" data-section-id="{{ $legal->id ?? '' }}" class="section-sm">
      <div class="container" style="max-width:820px">
        <p style="font-size:16px;line-height:1.8;color:var(--ink-700);margin-bottom:36px">{{ $hero->description ?? 'This policy explains what personal data Verdant Academy collects, why we collect it, and the rights you have over it.' }}</p>
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
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">1. Information we collect</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">We collect the information you provide when you create an account, enrol in a course, purchase a book, contact support or subscribe to our newsletter. This includes your name, email address, billing details, shipping address and learning activity within the platform.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">2. How we use your data</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">Your data is used to deliver courses and books, track progress, issue certificates, process payments, respond to support requests and — where you have opted in — send you course announcements and educational content.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">3. Legal basis for processing</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">We process personal data on the basis of contract performance (delivering courses and books you have purchased), legitimate interest (improving our platform) and consent (marketing communications).</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">4. Data retention</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">Account data is retained for as long as your account remains active. Learning records are retained for seven years to support certificate verification. You may request deletion at any time.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">5. Your rights</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">You have the right to access, correct, export or delete your personal data, and to withdraw consent for marketing at any time. Requests are handled within 30 days.</p>
            </div>
            <div>
              <h2 class="display" style="font-size:1.24rem;margin-bottom:10px">6. Contacting us</h2>
              <p style="font-size:15px;line-height:1.8;color:var(--ink-500)">For any privacy question, contact our data protection team at privacy@verdantacademy.com.</p>
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
