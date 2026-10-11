@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'FAQ & Help Centre — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Browse answers and troubleshooting guides for Verdant Academy students.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $topicCards = $sections['topic_cards'] ?? null;
  $faqIntro = $sections['faq_accordion_intro'] ?? null;
  $supportCta = $sections['support_cta'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>Help Centre</span></nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3.2vw,2.5rem)">{{ $hero->title ?? 'Help Centre & FAQ' }}</h1>
        <p class="lead" style="margin-top:12px;max-width:620px">{{ $hero->description ?? 'Answers to the questions we receive most often. Still stuck? Our support team replies within one business day.' }}</p>
      </div>
    </section>
    @endif

    <section class="section-sm">
      <div class="container" style="max-width:900px">
        @if(!isset($topicCards) || $topicCards->is_visible)
        <div data-section-key="topic_cards" data-section-id="{{ $topicCards->id ?? '' }}" class="grid g3 gap-sm" style="margin-bottom:42px">
          @if(isset($topicCards) && is_array($topicCards?->config('cards')))
            @foreach($topicCards?->config('cards') as $card)
              <a href="{{ $card['url'] ?? route('contact') }}" class="card card-hover card-pad" style="display:block">
                <div class="stat-icon" style="margin-bottom:13px"><i data-lucide="{{ $card['icon'] ?? 'book-open' }}"></i></div>
                <h3 style="font-size:14.8px;margin-bottom:5px">{{ $card['title'] ?? '' }}</h3>
                <p class="small muted" style="line-height:1.5">{{ $card['desc'] ?? '' }}</p>
              </a>
            @endforeach
          @else
            <a href="{{ route('contact') }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:13px"><i data-lucide="book-open"></i></div>
              <h3 style="font-size:14.8px;margin-bottom:5px">Getting started</h3>
              <p class="small muted" style="line-height:1.5">Enrolment, accounts and first steps</p>
            </a>
            <a href="{{ route('contact') }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:13px"><i data-lucide="credit-card"></i></div>
              <h3 style="font-size:14.8px;margin-bottom:5px">Payments & refunds</h3>
              <p class="small muted" style="line-height:1.5">Pricing, invoices and our 30-day policy</p>
            </a>
            <a href="{{ route('contact') }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:13px"><i data-lucide="award"></i></div>
              <h3 style="font-size:14.8px;margin-bottom:5px">Certificates</h3>
              <p class="small muted" style="line-height:1.5">Verification and sharing credentials</p>
            </a>
            <a href="{{ route('contact') }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:13px"><i data-lucide="book"></i></div>
              <h3 style="font-size:14.8px;margin-bottom:5px">Books & shipping</h3>
              <p class="small muted" style="line-height:1.5">Orders, delivery and returns</p>
            </a>
            <a href="{{ route('contact') }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:13px"><i data-lucide="video"></i></div>
              <h3 style="font-size:14.8px;margin-bottom:5px">Technical issues</h3>
              <p class="small muted" style="line-height:1.5">Playback, downloads and devices</p>
            </a>
            <a href="{{ route('contact') }}" class="card card-hover card-pad" style="display:block">
              <div class="stat-icon" style="margin-bottom:13px"><i data-lucide="briefcase"></i></div>
              <h3 style="font-size:14.8px;margin-bottom:5px">Corporate training</h3>
              <p class="small muted" style="line-height:1.5">Team plans and invoicing</p>
            </a>
          @endif
        </div>
        @endif

        <div data-section-key="faq_accordion_intro" data-section-id="{{ $faqIntro->id ?? '' }}">
          <h2 class="display" style="font-size:1.45rem;margin-bottom:6px">{{ $faqIntro->title ?? 'All frequently asked questions' }}</h2>
          <p class="small muted" style="margin-bottom:22px">{{ isset($faqs) ? count($faqs) : 6 }} articles in this section</p>
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
            <div class="accordion-item">
              <button class="acc-head" data-action="accordion" aria-expanded="false">
                <span>How long do I have access to a course?</span><i data-lucide="chevron-down"></i>
              </button>
              <div class="acc-body"><p>You get lifetime access to any course you enrol in, including all future updates, new lessons and downloadable resources. There is no recurring fee for course access.</p></div>
            </div>
          @endif
        </div>

        @if(!isset($supportCta) || $supportCta->is_visible)
        <div data-section-key="support_cta" data-section-id="{{ $supportCta->id ?? '' }}" class="card card-pad" style="margin-top:42px;text-align:center;padding:44px;border-color:var(--mustard-300)">
          <div class="stat-icon" style="margin:0 auto 16px;width:48px;height:48px"><i data-lucide="{{ $supportCta?->config('icon', 'life-buoy') }}"></i></div>
          <h2 class="display" style="font-size:1.35rem">{{ $supportCta->title ?? 'Still need help?' }}</h2>
          <p class="small muted" style="margin-top:10px;max-width:440px;margin-left:auto;margin-right:auto;line-height:1.7">
            {{ $supportCta->description ?? 'Our student support team is available Monday to Friday, 09:00–18:00 GMT, and replies to every message within one business day.' }}
          </p>
          <a href="{{ $supportCta?->config('btn_url', route('contact')) }}" class="btn btn-primary" style="margin-top:20px"><i data-lucide="mail"></i> {{ $supportCta?->config('btn_label', 'Contact support') }}</a>
        </div>
        @endif
      </div>
    </section>
</main>
@endsection
