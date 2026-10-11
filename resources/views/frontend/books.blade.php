@extends('layouts.frontend')

@section('title', (isset($page) && $page->meta_title) ? $page->meta_title : 'Books & Workbooks — Verdant Academy')
@section('meta_description', (isset($page) && $page->meta_description) ? $page->meta_description : 'Deep dive into comprehensive technical textbooks, architectural field guides, and reference manuals.')

@section('content')
@php
  $hero = $sections['hero'] ?? null;
  $bundle = $sections['featured_bundle'] ?? null;
@endphp
<main>
    @if(!isset($hero) || $hero->is_visible)
    <section data-section-key="hero" data-section-id="{{ $hero->id ?? '' }}" style="background:linear-gradient(180deg,var(--wine-50) 0%,var(--cream-50) 100%);border-bottom:1px solid var(--cream-300);padding:44px 0">
      <div class="container">
        <nav class="crumbs" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Home</a><span class="sep">/</span><span>Books</span>
        </nav>
        <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:20px">
          <div style="max-width:640px">
            <span class="eyebrow">{{ $hero->subtitle ?? 'The Verdant Press' }}</span>
            <h1 class="display" style="margin-top:12px;font-size:clamp(1.8rem,3.2vw,2.6rem)">{{ $hero->title ?? 'Books & Workbooks' }}</h1>
            <p class="lead" style="margin-top:14px">
              {{ $hero->description ?? 'Written by the instructors who teach our courses. Each title pairs with a specific programme and includes 40–60 guided exercises, code samples and end-of-chapter assessments.' }}
            </p>
          </div>
          <div style="display:flex;gap:9px;flex-wrap:wrap">
            @if(isset($hero) && is_array($hero?->config('badges')))
              @foreach($hero?->config('badges') as $badge)
                <span class="badge {{ $badge['class'] ?? 'badge-sage' }}"><i data-lucide="{{ $badge['icon'] ?? 'check' }}"></i> {{ $badge['label'] ?? '' }}</span>
              @endforeach
            @else
              <span class="badge badge-sage"><i data-lucide="truck"></i> Free shipping over $50</span>
              <span class="badge badge-gold"><i data-lucide="zap"></i> Instant eBook delivery</span>
            @endif
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- Featured bundle -->
    @if(!isset($bundle) || $bundle->is_visible)
    <section data-section-key="featured_bundle" data-section-id="{{ $bundle->id ?? '' }}" class="section-sm">
      <div class="container">
        <div class="bundle-hero">
          <div style="position:relative;z-index:1">
            <span class="badge badge-gold" style="margin-bottom:16px"><i data-lucide="layers"></i> {{ $bundle->subtitle ?? 'Collection bundle' }}</span>
            <h2 class="display" style="color:#fff;font-size:clamp(1.6rem,2.6vw,2.1rem);line-height:1.16">
              {{ $bundle->title ?? "The Full-Stack Developer's Library" }}
            </h2>
            <p style="margin-top:16px;color:rgba(184,149,166,.85);font-size:15px;line-height:1.72;max-width:520px">
              {{ $bundle->description ?? 'Four titles covering the entire modern stack — JavaScript patterns, SQL for analysts, cloud architecture and engineering leadership. Everything you need for a full-stack career, in a single bundle at 32% off.' }}
            </p>
            <div style="display:flex;align-items:baseline;gap:14px;margin-top:24px">
              <span class="bundle-price">{{ $bundle?->config('price', '$112') }}</span>
              <s style="color:rgba(184,149,166,.6);font-size:16px">{{ $bundle?->config('original_price', '$164') }}</s>
              <span class="badge badge-danger" style="margin-left:6px">{{ $bundle?->config('discount_label', 'Save $52') }}</span>
            </div>
            <div style="display:flex;gap:12px;margin-top:26px;flex-wrap:wrap">
              <button class="btn btn-gold btn-lg" data-action="buy-bundle"><i data-lucide="shopping-bag"></i> {{ $bundle?->config('primary_btn_label', 'Add bundle to cart') }}</button>
              <a href="{{ $bundle?->config('secondary_btn_url', route('books')) }}" class="btn btn-white btn-lg" style="background:rgba(255,255,255,.1);color:#fff;border-color:rgba(255,255,255,.2)">{{ $bundle?->config('secondary_btn_label', "See what's inside") }}</a>
            </div>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;position:relative;z-index:1">
            @if(isset($bundle) && is_array($bundle?->config('images')))
              @foreach($bundle?->config('images') as $idx => $img)
                <div style="border-radius:10px;overflow:hidden;box-shadow:0 14px 34px rgba(0,0,0,.32);transform:rotate({{ $idx % 2 === 0 ? '-2deg' : '2deg' }})">
                  <img src="{{ $img }}" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
                </div>
              @endforeach
            @else
              <div style="border-radius:10px;overflow:hidden;box-shadow:0 14px 34px rgba(0,0,0,.32);transform:rotate(-2deg)">
                <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=75" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
              </div>
              <div style="border-radius:10px;overflow:hidden;box-shadow:0 14px 34px rgba(0,0,0,.32);transform:rotate(2deg)">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=75" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
              </div>
              <div style="border-radius:10px;overflow:hidden;box-shadow:0 14px 34px rgba(0,0,0,.32);transform:rotate(-2deg)">
                <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=600&q=75" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
              </div>
              <div style="border-radius:10px;overflow:hidden;box-shadow:0 14px 34px rgba(0,0,0,.32);transform:rotate(2deg)">
                <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=600&q=75" alt="" style="width:100%;aspect-ratio:3/4;object-fit:cover" onerror="this.style.display='none'">
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>
    @endif

    <!-- Filters & grid -->
    <section class="section-sm">
      <div class="container">
        <div class="card card-pad" style="margin-bottom:28px">
          <div style="display:grid;grid-template-columns:1.6fr 1fr 1fr 1fr;gap:12px;align-items:end">
            <div>
              <label class="label" for="bf-q">Search</label>
              <div class="input-icon">
                <i data-lucide="search"></i>
                <input id="bf-q" class="input" type="search" placeholder="Title, author or topic" value="" data-filter="bq">
              </div>
            </div>
            <div>
              <label class="label" for="bf-cat">Category</label>
              <select id="bf-cat" class="select" data-filter="bcat">
                <option value="all" selected>All categories</option><option value="Programming" >Programming</option><option value="Data" >Data</option><option value="Design" >Design</option><option value="Cloud" >Cloud</option><option value="Marketing" >Marketing</option><option value="Career" >Career</option>
              </select>
            </div>
            <div>
              <label class="label" for="bf-format">Format</label>
              <select id="bf-format" class="select" data-filter="bformat">
                <option value="all" selected>Any format</option><option value="Paperback" >Paperback</option><option value="Hardcover" >Hardcover</option><option value="eBook" >eBook</option>
              </select>
            </div>
            <div>
              <label class="label" for="bf-sort">Sort by</label>
              <select id="bf-sort" class="select" data-filter="bsort">
                <option value="popular" selected>Most popular</option>
                <option value="newest" >Newest</option>
                <option value="rating" >Highest rated</option>
                <option value="price-asc" >Price: low to high</option>
                <option value="price-desc" >Price: high to low</option>
              </select>
            </div>
          </div>
          <div style="display:flex;gap:9px;flex-wrap:wrap;margin-top:18px;align-items:center">
            <span class="small muted" style="font-weight:600">Quick filters:</span>
            <button class="pill " data-action="quick-book-cat" data-cat="Programming">Programming</button><button class="pill " data-action="quick-book-cat" data-cat="Data">Data</button><button class="pill " data-action="quick-book-cat" data-cat="Design">Design</button><button class="pill " data-action="quick-book-cat" data-cat="Cloud">Cloud</button><button class="pill " data-action="quick-book-cat" data-cat="Marketing">Marketing</button><button class="pill " data-action="quick-book-cat" data-cat="Career">Career</button>
            <button class="btn btn-ghost btn-sm" data-action="clear-book-filters" style="margin-left:auto"><i data-lucide="rotate-ccw"></i> Reset</button>
          </div>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:22px">
          <p class="small muted">Showing <b style="color:var(--ink-900)">6</b> books</p>
          <div style="display:flex;gap:8px">
            <span class="badge badge-ivory"><i data-lucide="truck"></i> Free shipping over $50</span>
            <span class="badge badge-ivory"><i data-lucide="rotate-ccw"></i> 30-day returns</span>
          </div>
        </div>

        
          <div class="grid g3"><article class="book-card">
    <div class="book-cover">
      <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=75" alt="The Pragmatic Programmer&#39;s Workbook cover" loading="lazy" onerror="this.style.display='none'">
      <span class="btag badge badge-gold">New</span>
      <div class="book-cover-inner">
        <div class="bcat">Programming</div>
        <div class="btitle">The Pragmatic Programmer&#39;s Workbook</div>
        <div class="bauthor">Marcus Feld</div>
      </div>
    </div>
    <div class="book-body">
      <div class="book-meta">
        <span><i data-lucide="book"></i>368 pages</span>
        <span><i data-lucide="package"></i>Paperback</span>
      </div>
      <h3 class="book-title"><a href="{{ route('books') }}" data-action="view-book" data-id="b1">The Pragmatic Programmer&#39;s Workbook</a></h3>
      <div class="book-author">by Marcus Feld</div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.8</b> <span class="muted">(412)</span></span>
      </div>
      <div class="book-foot">
        <span class="price">$34<s>$52</s></span>
        <button class="btn btn-primary btn-sm" data-action="buy-book" data-id="b1"><i data-lucide="shopping-bag"></i> Buy</button>
      </div>
    </div>
  </article><article class="book-card">
    <div class="book-cover">
      <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=75" alt="SQL Patterns for Analysts cover" loading="lazy" onerror="this.style.display='none'">
      <span class="btag badge badge-gold">Bestseller</span>
      <div class="book-cover-inner">
        <div class="bcat">Data</div>
        <div class="btitle">SQL Patterns for Analysts</div>
        <div class="bauthor">Dr. Amara Osei</div>
      </div>
    </div>
    <div class="book-body">
      <div class="book-meta">
        <span><i data-lucide="book"></i>412 pages</span>
        <span><i data-lucide="package"></i>Hardcover</span>
      </div>
      <h3 class="book-title"><a href="{{ route('books') }}" data-action="view-book" data-id="b2">SQL Patterns for Analysts</a></h3>
      <div class="book-author">by Dr. Amara Osei</div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.9</b> <span class="muted">(287)</span></span>
      </div>
      <div class="book-foot">
        <span class="price">$42<s>$68</s></span>
        <button class="btn btn-primary btn-sm" data-action="buy-book" data-id="b2"><i data-lucide="shopping-bag"></i> Buy</button>
      </div>
    </div>
  </article><article class="book-card">
    <div class="book-cover">
      <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?auto=format&fit=crop&w=600&q=75" alt="Growth Marketing Playbook cover" loading="lazy" onerror="this.style.display='none'">
      <span class="btag badge badge-gold">eBook</span>
      <div class="book-cover-inner">
        <div class="bcat">Marketing</div>
        <div class="btitle">Growth Marketing Playbook</div>
        <div class="bauthor">Helena Marchetti</div>
      </div>
    </div>
    <div class="book-body">
      <div class="book-meta">
        <span><i data-lucide="book"></i>296 pages</span>
        <span><i data-lucide="package"></i>eBook</span>
      </div>
      <h3 class="book-title"><a href="{{ route('books') }}" data-action="view-book" data-id="b5">Growth Marketing Playbook</a></h3>
      <div class="book-author">by Helena Marchetti</div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.8</b> <span class="muted">(224)</span></span>
      </div>
      <div class="book-foot">
        <span class="price">$24<s>$39</s></span>
        <button class="btn btn-primary btn-sm" data-action="buy-book" data-id="b5"><i data-lucide="shopping-bag"></i> Buy</button>
      </div>
    </div>
  </article><article class="book-card">
    <div class="book-cover">
      <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=600&q=75" alt="Design Systems in Practice cover" loading="lazy" onerror="this.style.display='none'">
      
      <div class="book-cover-inner">
        <div class="bcat">Design</div>
        <div class="btitle">Design Systems in Practice</div>
        <div class="bauthor">Priya Raghunathan</div>
      </div>
    </div>
    <div class="book-body">
      <div class="book-meta">
        <span><i data-lucide="book"></i>344 pages</span>
        <span><i data-lucide="package"></i>Paperback</span>
      </div>
      <h3 class="book-title"><a href="{{ route('books') }}" data-action="view-book" data-id="b3">Design Systems in Practice</a></h3>
      <div class="book-author">by Priya Raghunathan</div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.9</b> <span class="muted">(198)</span></span>
      </div>
      <div class="book-foot">
        <span class="price">$38<s>$59</s></span>
        <button class="btn btn-primary btn-sm" data-action="buy-book" data-id="b3"><i data-lucide="shopping-bag"></i> Buy</button>
      </div>
    </div>
  </article><article class="book-card">
    <div class="book-cover">
      <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=600&q=75" alt="Cloud Architecture Field Guide cover" loading="lazy" onerror="this.style.display='none'">
      
      <div class="book-cover-inner">
        <div class="bcat">Cloud</div>
        <div class="btitle">Cloud Architecture Field Guide</div>
        <div class="bauthor">Jonas Lindqvist</div>
      </div>
    </div>
    <div class="book-body">
      <div class="book-meta">
        <span><i data-lucide="book"></i>388 pages</span>
        <span><i data-lucide="package"></i>Paperback</span>
      </div>
      <h3 class="book-title"><a href="{{ route('books') }}" data-action="view-book" data-id="b4">Cloud Architecture Field Guide</a></h3>
      <div class="book-author">by Jonas Lindqvist</div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.7</b> <span class="muted">(156)</span></span>
      </div>
      <div class="book-foot">
        <span class="price">$44<s>$72</s></span>
        <button class="btn btn-primary btn-sm" data-action="buy-book" data-id="b4"><i data-lucide="shopping-bag"></i> Buy</button>
      </div>
    </div>
  </article><article class="book-card">
    <div class="book-cover">
      <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=600&q=75" alt="Leadership for Engineers cover" loading="lazy" onerror="this.style.display='none'">
      
      <div class="book-cover-inner">
        <div class="bcat">Career</div>
        <div class="btitle">Leadership for Engineers</div>
        <div class="bauthor">Samuel Adeyemi</div>
      </div>
    </div>
    <div class="book-body">
      <div class="book-meta">
        <span><i data-lucide="book"></i>308 pages</span>
        <span><i data-lucide="package"></i>Hardcover</span>
      </div>
      <h3 class="book-title"><a href="{{ route('books') }}" data-action="view-book" data-id="b6">Leadership for Engineers</a></h3>
      <div class="book-author">by Samuel Adeyemi</div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.8</b> <span class="muted">(143)</span></span>
      </div>
      <div class="book-foot">
        <span class="price">$36<s>$56</s></span>
        <button class="btn btn-primary btn-sm" data-action="buy-book" data-id="b6"><i data-lucide="shopping-bag"></i> Buy</button>
      </div>
    </div>
  </article></div>
        
      </div>
    </section>

    <!-- Why buy -->
    <section class="section section-alt divider-y">
      <div class="container">
        <div style="max-width:640px;margin-bottom:44px">
          <span class="eyebrow">Why buy from Verdant Press</span>
          <h2 class="display" style="margin-top:14px">Books built for real learning, not just reading.</h2>
        </div>
        <div class="grid g4">
          
            <div class="card card-pad" style="height:100%">
              <div class="feature-icon" style="margin-bottom:14px"><i data-lucide="pen-line"></i></div>
              <h3 style="font-size:15.6px;margin-bottom:8px">Written by instructors</h3>
              <p class="small muted" style="line-height:1.65">Every book is authored by someone who teaches the subject weekly on our platform.</p>
            </div>
            <div class="card card-pad" style="height:100%">
              <div class="feature-icon" style="margin-bottom:14px"><i data-lucide="layers"></i></div>
              <h3 style="font-size:15.6px;margin-bottom:8px">Paired with a course</h3>
              <p class="small muted" style="line-height:1.65">Each title maps to a specific course module, so you can read and practise in sync.</p>
            </div>
            <div class="card card-pad" style="height:100%">
              <div class="feature-icon" style="margin-bottom:14px"><i data-lucide="package"></i></div>
              <h3 style="font-size:15.6px;margin-bottom:8px">Free shipping, worldwide</h3>
              <p class="small muted" style="line-height:1.65">We ship paperback and hardcover to 42 countries. Free on orders over $50.</p>
            </div>
            <div class="card card-pad" style="height:100%">
              <div class="feature-icon" style="margin-bottom:14px"><i data-lucide="zap"></i></div>
              <h3 style="font-size:15.6px;margin-bottom:8px">Instant eBook delivery</h3>
              <p class="small muted" style="line-height:1.65">Buy the eBook and download your PDF and ePub immediately, DRM-free.</p>
            </div>
        </div>
      </div>
    </section>

    <!-- Reviews -->
    <section class="section">
      <div class="container">
        <div style="max-width:640px;margin-bottom:40px">
          <span class="eyebrow">Reader reviews</span>
          <h2 class="display" style="margin-top:14px">What readers say</h2>
        </div>
        <div class="grid g3">
          
            <div class="quote-card">
              <div class="quote-mark">&ldquo;</div>
              <p class="quote-text">The SQL Patterns book is now the reference I keep on my desk. The examples are practical and the diagrams finally made window functions click.</p>
              <div class="quote-who">
                <img src="https://i.pravatar.cc/160?img=37" alt="" onerror="this.style.display='none'">
                <div><div class="nm">Ravi Krishnan</div><div class="rl">Backend Engineer at Stripe</div></div>
              </div>
            </div>
            <div class="quote-card">
              <div class="quote-mark">&ldquo;</div>
              <p class="quote-text">Design Systems in Practice is the most useful design book I have read in years. No fluff, just the exact processes I use daily.</p>
              <div class="quote-who">
                <img src="https://i.pravatar.cc/160?img=29" alt="" onerror="this.style.display='none'">
                <div><div class="nm">Ines Almeida</div><div class="rl">Product Designer at Figma</div></div>
              </div>
            </div>
            <div class="quote-card">
              <div class="quote-mark">&ldquo;</div>
              <p class="quote-text">The Cloud Architecture Field Guide got me through my AWS Solutions Architect exam and it is still my first reference for real projects.</p>
              <div class="quote-who">
                <img src="https://i.pravatar.cc/160?img=53" alt="" onerror="this.style.display='none'">
                <div><div class="nm">Kenji Nakamura</div><div class="rl">Cloud Engineer at Rakuten</div></div>
              </div>
            </div>
        </div>
      </div>
    </section>

    <!-- Book FAQ -->
    <section class="section section-alt divider-y">
      <div class="container">
        <div class="two-col" style="grid-template-columns:340px 1fr">
          <div>
            <span class="eyebrow">Questions</span>
            <h2 class="display" style="margin-top:14px">Shipping & returns</h2>
            <p class="lead" style="margin-top:16px">Everything you need to know about buying, receiving and returning our books.</p>
            <a href="{{ route('contact') }}" class="btn btn-outline" style="margin-top:22px">Contact us</a>
          </div>
          <div style="border-top:1px solid var(--cream-300)">
            
              <div class="accordion-item open">
                <button class="acc-head" data-action="accordion" aria-expanded="true">
                  <span>Do you ship internationally?</span><i data-lucide="chevron-down"></i>
                </button>
                <div class="acc-body"><p>Yes. We ship paperback and hardcover titles to 42 countries. Standard shipping is free on orders over $50; express delivery is available at checkout. eBooks are delivered instantly by email.</p></div>
              </div>
              <div class="accordion-item ">
                <button class="acc-head" data-action="accordion" aria-expanded="false">
                  <span>Are the books available as eBooks?</span><i data-lucide="chevron-down"></i>
                </button>
                <div class="acc-body"><p>Every title is available as a DRM-free PDF and ePub. When you buy the eBook format you get instant download links for both, plus access to any future editions at no extra cost.</p></div>
              </div>
              <div class="accordion-item ">
                <button class="acc-head" data-action="accordion" aria-expanded="false">
                  <span>Do the books come with course access?</span><i data-lucide="chevron-down"></i>
                </button>
                <div class="acc-body"><p>Some titles include a companion code for a related course or workbook. Look for the &quot;Includes course access&quot; badge on the book page — it means you get free access to a matching module or short programme.</p></div>
              </div>
              <div class="accordion-item ">
                <button class="acc-head" data-action="accordion" aria-expanded="false">
                  <span>What is your return policy for books?</span><i data-lucide="chevron-down"></i>
                </button>
                <div class="acc-body"><p>Physical books can be returned within 30 days in original condition for a full refund. eBooks are non-refundable once downloaded, but we will happily exchange a title if you bought the wrong one.</p></div>
              </div>
              <div class="accordion-item ">
                <button class="acc-head" data-action="accordion" aria-expanded="false">
                  <span>Can I buy a bundle of related books?</span><i data-lucide="chevron-down"></i>
                </button>
                <div class="acc-body"><p>Yes. Our collection bundles combine three or four related titles at 25–35% off the individual prices. Bundles are listed at the top of this page and are updated every quarter.</p></div>
              </div>
              <div class="accordion-item ">
                <button class="acc-head" data-action="accordion" aria-expanded="false">
                  <span>Are the books used in your courses?</span><i data-lucide="chevron-down"></i>
                </button>
                <div class="acc-body"><p>Many are. The instructor who wrote each book uses it as the primary reference for one of their courses. You will find a link to the related course on every book page.</p></div>
              </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
