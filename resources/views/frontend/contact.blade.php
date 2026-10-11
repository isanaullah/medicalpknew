@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Contact Us — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Get in touch with the Verdant Academy team for admissions and technical support.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $formHdr = $sections['form_header'] ?? null;
  $info = $sections['info'] ?? null;
  $hours = $sections['office_hours'] ?? null;
  $map = $sections['hq_map'] ?? null;
  $faqPrev = $sections['faq_preview'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:48px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>{{ $hero->title ?? 'Contact Us' }}</span></nav>
        <h1 class="display" style="font-size:clamp(1.8rem,3.2vw,2.5rem)">{{ $hero->title ?? 'Contact Us' }}</h1>
        <p class="lead" style="margin-top:12px;max-width:620px">
          {{ $hero->description ?? 'Questions about a course, a book order, corporate training or your account? Send us a message and we will reply within one business day.' }}
        </p>
      </div>
    </section>
    @endif

    <section class="section-sm">
      <div class="container">
        <div class="two-col" style="grid-template-columns:1.2fr .8fr">
          <div data-section-key="form_header" data-section-id="{{ $formHdr->id ?? '' }}" class="card card-pad" style="padding:32px">
            <h2 class="display" style="font-size:1.35rem;margin-bottom:8px">{{ $formHdr->title ?? 'Send us a message' }}</h2>
            <p class="small muted" style="margin-bottom:26px">{{ $formHdr->subtitle ?? 'Fields marked with * are required.' }}</p>
            <form data-action="contact" novalidate>
              <div class="grid g2 gap-sm" style="gap:0 18px">
                <div class="field">
                  <label class="label" for="c-name">Full name <span class="req">*</span></label>
                  <input id="c-name" name="name" class="input" type="text" required placeholder="Jane Doe">
                  <span class="field-error"><i data-lucide="alert-circle"></i>Please enter your full name.</span>
                </div>
                <div class="field">
                  <label class="label" for="c-email">Email address <span class="req">*</span></label>
                  <input id="c-email" name="email" class="input" type="email" required placeholder="jane@example.com">
                  <span class="field-error"><i data-lucide="alert-circle"></i>Please enter a valid email address.</span>
                </div>
              </div>
              <div class="field">
                <label class="label" for="c-subject">Subject <span class="req">*</span></label>
                <select id="c-subject" name="subject" class="select" required>
                  <option value="">Choose a topic…</option>
                  <option>Course enquiry</option>
                  <option>Book order or shipping</option>
                  <option>Corporate training</option>
                  <option>Billing or payment</option>
                  <option>Certificate verification</option>
                  <option>Technical support</option>
                  <option>Partnership</option>
                  <option>Other</option>
                </select>
                <span class="field-error"><i data-lucide="alert-circle"></i>Please choose a subject.</span>
              </div>
              <div class="field">
                <label class="label" for="c-msg">Message <span class="req">*</span></label>
                <textarea id="c-msg" name="message" class="textarea" required placeholder="Tell us how we can help…"></textarea>
                <span class="field-error"><i data-lucide="alert-circle"></i>Please write a message of at least 20 characters.</span>
              </div>
              <label class="check" style="margin-bottom:20px">
                <input type="checkbox" name="consent" required>
                <span>I agree that Verdant Academy may store and process my message in line with the <a href="{{ route('privacy') }}" style="color:var(--wine-700);text-decoration:underline">Privacy Policy</a>.</span>
              </label>
              <button type="submit" class="btn btn-primary btn-lg"><i data-lucide="send"></i> Send message</button>
              <p class="form-msg" aria-live="polite"></p>
            </form>
          </div>

          <div>
            @if(!isset($info) || $info->is_visible)
            <div data-section-key="info" data-section-id="{{ $info->id ?? '' }}" class="card card-pad" style="margin-bottom:16px">
              <h3 style="font-size:16px;margin-bottom:18px">{{ $info->title ?? 'Contact information' }}</h3>
              
              <div style="display:flex;gap:13px;padding:13px 0;border-bottom:1px solid var(--cream-200)">
                <div class="stat-icon" style="width:38px;height:38px;flex:none"><i data-lucide="map-pin"></i></div>
                <div>
                  <div style="font-size:13.6px;font-weight:600;color:var(--ink-900)">{{ $info?->config('address_title', 'Address') }}</div>
                  <div style="font-size:13.6px;color:var(--ink-500);margin-top:3px;line-height:1.6">{!! nl2br(e($info?->config('address', "42 Alder House, Kingsway\nLondon WC2B 6AN, United Kingdom"))) !!}</div>
                </div>
              </div>

              <div style="display:flex;gap:13px;padding:13px 0;border-bottom:1px solid var(--cream-200)">
                <div class="stat-icon" style="width:38px;height:38px;flex:none"><i data-lucide="mail"></i></div>
                <div>
                  <div style="font-size:13.6px;font-weight:600;color:var(--ink-900)">{{ $info?->config('email_title', 'Email') }}</div>
                  <div style="font-size:13.6px;color:var(--ink-500);margin-top:3px;line-height:1.6">{!! nl2br(e($info?->config('email', "hello@verdantacademy.com\nsupport@verdantacademy.com"))) !!}</div>
                </div>
              </div>

              <div style="display:flex;gap:13px;padding:13px 0;border-bottom:1px solid var(--cream-200)">
                <div class="stat-icon" style="width:38px;height:38px;flex:none"><i data-lucide="phone"></i></div>
                <div>
                  <div style="font-size:13.6px;font-weight:600;color:var(--ink-900)">{{ $info?->config('phone_title', 'Phone') }}</div>
                  <div style="font-size:13.6px;color:var(--ink-500);margin-top:3px;line-height:1.6">{!! nl2br(e($info?->config('phone', "+44 20 7123 4567\nMon–Fri, 09:00–18:00 GMT"))) !!}</div>
                </div>
              </div>

              <div style="display:flex;gap:13px;padding:13px 0;border-bottom:1px solid var(--cream-200)">
                <div class="stat-icon" style="width:38px;height:38px;flex:none"><i data-lucide="building-2"></i></div>
                <div>
                  <div style="font-size:13.6px;font-weight:600;color:var(--ink-900)">{{ $info?->config('corporate_title', 'Corporate') }}</div>
                  <div style="font-size:13.6px;color:var(--ink-500);margin-top:3px;line-height:1.6">{{ $info?->config('corporate', 'enterprise@verdantacademy.com') }}</div>
                </div>
              </div>
            </div>
            @endif

            @if(!isset($hours) || $hours->is_visible)
            <div data-section-key="office_hours" data-section-id="{{ $hours->id ?? '' }}" class="card card-pad" style="margin-bottom:16px">
              <h3 style="font-size:16px;margin-bottom:14px">{{ $hours->title ?? 'Office hours' }}</h3>
              @if(isset($hours) && is_array($hours?->config('hours')))
                @foreach($hours?->config('hours') as $hr)
                  <div class="info-row"><span class="k">{{ $hr['day'] }}</span><span class="v">{{ $hr['time'] }}</span></div>
                @endforeach
              @else
                <div class="info-row"><span class="k">Monday – Friday</span><span class="v">09:00 – 18:00</span></div>
                <div class="info-row"><span class="k">Saturday</span><span class="v">10:00 – 14:00</span></div>
                <div class="info-row"><span class="k">Sunday</span><span class="v">Closed</span></div>
              @endif
              <div class="notice ivory" style="margin-top:14px;font-size:12.8px">
                <i data-lucide="info"></i>
                <span>{{ $hours->description ?? 'Student support replies within one business day. Urgent account issues are prioritised.' }}</span>
              </div>
            </div>
            @endif

            @if(!isset($map) || $map->is_visible)
            <div data-section-key="hq_map" data-section-id="{{ $map->id ?? '' }}" class="card" style="overflow:hidden">
              <div style="height:240px;background:linear-gradient(135deg,var(--wine-800),var(--wine-950));position:relative;display:grid;place-items:center">
                <div style="position:absolute;inset:0;opacity:.15;background-image:linear-gradient(rgba(255,255,255,.5) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.5) 1px,transparent 1px);background-size:36px 36px"></div>
                <div style="position:relative;text-align:center;color:#fff">
                  <i data-lucide="map-pin" style="width:36px;height:36px;margin:0 auto 12px;color:var(--mustard-400)"></i>
                  <p style="font-weight:600;font-size:15px">{{ $map->title ?? 'Verdant Academy HQ' }}</p>
                  <p style="font-size:13px;color:rgba(184,149,166,.8);margin-top:4px">{{ $map->subtitle ?? 'Kingsway, London WC2B 6AN' }}</p>
                  <p style="font-size:11.6px;color:rgba(184,149,166,.55);margin-top:12px">{{ $map->description ?? 'Interactive map placeholder' }}</p>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </section>

    @if(!isset($faqPrev) || $faqPrev->is_visible)
    <section data-section-key="faq_preview" data-section-id="{{ $faqPrev->id ?? '' }}" class="section section-alt divider-y">
      <div class="container">
        <div class="two-col" style="grid-template-columns:340px 1fr">
          <div>
            <span class="eyebrow">{{ $faqPrev->subtitle ?? 'Before you write' }}</span>
            <h2 class="display" style="margin-top:14px;font-size:1.5rem">{{ $faqPrev->title ?? 'Common contact questions' }}</h2>
            <p class="lead" style="margin-top:14px;font-size:14.6px">{{ $faqPrev->description ?? 'Many enquiries are answered instantly in our help centre.' }}</p>
            <a href="{{ $faqPrev?->config('btn_url', route('faq')) }}" class="btn btn-outline" style="margin-top:18px">{{ $faqPrev?->config('btn_label', 'Visit help centre') }}</a>
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
        </div>
      </div>
    </section>
    @endif
</main>
@endsection
