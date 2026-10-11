@extends('layouts.frontend')

@section('title', 'Course Details — Verdant Academy')

@section('content')
<main>
    <section style="background:linear-gradient(135deg,var(--wine-900),var(--wine-950));color:#fff;padding:48px 0 50px;position:relative;overflow:hidden">
      <div style="position:absolute;top:-160px;right:-100px;width:480px;height:480px;border-radius:50%;background:radial-gradient(circle,rgba(217,165,33,.2),transparent 70%);pointer-events:none"></div>
      <div class="container" style="position:relative">
        <nav class="crumbs" style="color:rgba(184,149,166,.6)" aria-label="Breadcrumb">
          <a href="{{ route('home') }}" style="color:rgba(184,149,166,.85)">Home</a><span class="sep">/</span>
          <a href="{{ route('courses') }}" style="color:rgba(184,149,166,.85)">Courses</a><span class="sep">/</span>
          <a href="{{ route('courses', ['cat' => 'web']) }}" style="color:rgba(184,149,166,.85)">Web Development</a><span class="sep">/</span>
          <span>The Complete Web Development Bootcamp</span>
        </nav>
        <div style="display:grid;grid-template-columns:1fr 370px;gap:44px;align-items:start" class="course-detail-grid">
          <div>
            <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px">
              <span class="badge badge-gold">Bestseller</span>
              <span class="badge badge-ivory">Beginner</span>
              <span class="badge badge-ivory">Updated Sep 2025</span>
            </div>
            <h1 class="display" style="color:#fff;font-size:clamp(1.7rem,3.2vw,2.4rem)">The Complete Web Development Bootcamp</h1>
            <p style="margin-top:18px;font-size:16px;color:rgba(184,149,166,.85);max-width:640px;line-height:1.7">Go from zero to deploying full-stack applications with HTML, CSS, JavaScript, Node and PostgreSQL.</p>
            <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-top:24px">
              <span style="display:flex;align-items:center;gap:7px;font-size:14px">
                <span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b style="color:#fff">4.8</b>
                <span style="color:rgba(184,149,166,.6)">(3,412 reviews)</span>
              </span>
              <span style="color:rgba(184,149,166,.4)">•</span>
              <span style="font-size:14px;color:rgba(184,149,166,.85)"><b style="color:#fff">18,420</b> students enrolled</span>
            </div>
            <div style="display:flex;align-items:center;gap:12px;margin-top:26px">
              <img src="https://i.pravatar.cc/160?img=12" alt="" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid rgba(184,149,166,.3)" onerror="this.style.display='none'">
              <div>
                <div style="font-size:14.5px;font-weight:600">Marcus Feld</div>
                <div style="font-size:12.8px;color:rgba(184,149,166,.65)">Full-Stack Engineer</div>
              </div>
            </div>
          </div>
          <div></div>
        </div>
      </div>
    </section>

    <section class="section-sm">
      <div class="container">
        <div class="course-detail-grid">
          <div>
            <div class="tabs" role="tablist">
              <button class="tab-btn active" data-action="tab" data-tab="overview" role="tab">Overview</button>
              <button class="tab-btn" data-action="tab" data-tab="curriculum" role="tab">Curriculum</button>
              <button class="tab-btn" data-action="tab" data-tab="instructor" role="tab">Instructor</button>
              <button class="tab-btn" data-action="tab" data-tab="reviews" role="tab">Reviews</button>
            </div>

            <div class="tab-panel active" id="tab-overview">
              <h2 class="display" style="font-size:1.4rem;margin-bottom:14px">Course overview</h2>
              <p style="font-size:15px;line-height:1.75;color:var(--ink-500)">This bootcamp is the most complete web development programme we offer. You will build eleven real projects, including an e-commerce storefront, a real-time chat application and a REST API with authentication. Each module ends with a graded assignment reviewed by a mentor.</p>

              <h3 class="display" style="font-size:1.22rem;margin:38px 0 16px">What you will learn</h3>
              <ul class="check-list grid g2 gap-sm">
                <li><i data-lucide="check-circle-2"></i><span>Build responsive interfaces with modern HTML, CSS and JavaScript</span></li><li><i data-lucide="check-circle-2"></i><span>Create REST APIs with Node.js, Express and PostgreSQL</span></li><li><i data-lucide="check-circle-2"></i><span>Implement authentication, sessions and secure password storage</span></li><li><i data-lucide="check-circle-2"></i><span>Deploy production applications with CI/CD pipelines</span></li><li><i data-lucide="check-circle-2"></i><span>Write clean, testable code using industry conventions</span></li><li><i data-lucide="check-circle-2"></i><span>Debug and profile applications using browser and server tooling</span></li>
              </ul>

              <h3 class="display" style="font-size:1.22rem;margin:38px 0 16px">Requirements</h3>
              <ul class="bullet-list"><li>A computer with any operating system</li><li>No prior programming experience required</li><li>Willingness to commit 8–10 hours per week</li></ul>

              <h3 class="display" style="font-size:1.22rem;margin:38px 0 16px">Who this course is for</h3>
              <ul class="bullet-list"><li>Aspiring developers changing careers</li><li>Designers who want to build their own prototypes</li><li>Students preparing for junior developer interviews</li></ul>
            </div>

            <div class="tab-panel" id="tab-curriculum">
              <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px">
                <h2 class="display" style="font-size:1.4rem">Course curriculum</h2>
                <span class="small muted">4 modules · 15 lessons · 52h</span>
              </div>
              
                <div class="curriculum-module open">
                  <button class="mod-head" data-action="module" aria-expanded="true">
                    <i data-lucide="layers" style="width:17px;height:17px;color:var(--wine-600)"></i>
                    <span class="mt">Foundations of the Web</span>
                    <span class="small muted" style="margin-right:8px">4 lessons</span>
                    <i data-lucide="chevron-down"></i>
                  </button>
                  <div class="mod-body">
                    
                      <div class="lesson">
                        <i data-lucide="play-circle"></i>
                        <span class="lt">How the web actually works</span>
                        <span class="free">Free preview</span>
                        <span class="ld">12:40</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">HTML structure and semantics</span>
                        
                        <span class="ld">24:10</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">CSS layout with Flexbox and Grid</span>
                        
                        <span class="ld">38:22</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Responsive design principles</span>
                        
                        <span class="ld">26:05</span>
                      </div>
                  </div>
                </div>
                <div class="curriculum-module ">
                  <button class="mod-head" data-action="module" aria-expanded="false">
                    <i data-lucide="layers" style="width:17px;height:17px;color:var(--wine-600)"></i>
                    <span class="mt">JavaScript in Depth</span>
                    <span class="small muted" style="margin-right:8px">4 lessons</span>
                    <i data-lucide="chevron-down"></i>
                  </button>
                  <div class="mod-body">
                    
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Variables, types and scope</span>
                        
                        <span class="ld">19:30</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Functions, closures and the this keyword</span>
                        
                        <span class="ld">31:15</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">DOM manipulation and events</span>
                        
                        <span class="ld">28:44</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Async JavaScript and fetch</span>
                        
                        <span class="ld">35:02</span>
                      </div>
                  </div>
                </div>
                <div class="curriculum-module ">
                  <button class="mod-head" data-action="module" aria-expanded="false">
                    <i data-lucide="layers" style="width:17px;height:17px;color:var(--wine-600)"></i>
                    <span class="mt">Backend with Node &amp; Express</span>
                    <span class="small muted" style="margin-right:8px">4 lessons</span>
                    <i data-lucide="chevron-down"></i>
                  </button>
                  <div class="mod-body">
                    
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Setting up a Node project</span>
                        
                        <span class="ld">16:20</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Routing and middleware</span>
                        
                        <span class="ld">27:48</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Working with PostgreSQL</span>
                        
                        <span class="ld">41:12</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Authentication and sessions</span>
                        
                        <span class="ld">38:55</span>
                      </div>
                  </div>
                </div>
                <div class="curriculum-module ">
                  <button class="mod-head" data-action="module" aria-expanded="false">
                    <i data-lucide="layers" style="width:17px;height:17px;color:var(--wine-600)"></i>
                    <span class="mt">Deployment &amp; DevOps Basics</span>
                    <span class="small muted" style="margin-right:8px">3 lessons</span>
                    <i data-lucide="chevron-down"></i>
                  </button>
                  <div class="mod-body">
                    
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Environment variables and secrets</span>
                        
                        <span class="ld">14:05</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">Deploying to a cloud host</span>
                        
                        <span class="ld">29:33</span>
                      </div>
                      <div class="lesson">
                        <i data-lucide="file-video"></i>
                        <span class="lt">CI/CD with GitHub Actions</span>
                        
                        <span class="ld">23:17</span>
                      </div>
                  </div>
                </div>
            </div>

            <div class="tab-panel" id="tab-instructor">
              <div class="card card-pad" style="display:flex;gap:24px;flex-wrap:wrap;align-items:flex-start">
                <img src="https://i.pravatar.cc/160?img=12" alt="Marcus Feld" style="width:100px;height:100px;border-radius:50%;object-fit:cover;flex:none;box-shadow:0 8px 20px rgba(32,8,15,.16)" onerror="this.style.display='none'">
                <div style="flex:1;min-width:240px">
                  <h2 class="display" style="font-size:1.35rem">Marcus Feld</h2>
                  <p style="color:var(--mustard-700);font-weight:600;font-size:13.6px;margin-top:4px">Full-Stack Engineer</p>
                  <p style="margin-top:14px;font-size:14.6px;line-height:1.72;color:var(--ink-500)">Built payment infrastructure at scale. Teaches the patterns he uses in production every day.</p>
                  <div style="display:flex;gap:24px;flex-wrap:wrap;margin-top:22px;padding-top:20px;border-top:1px solid var(--cream-200)">
                    <div><div style="font-family:var(--font-display);font-size:1.35rem;color:var(--wine-800)">22,130</div><div class="small muted">Students taught</div></div>
                    <div><div style="font-family:var(--font-display);font-size:1.35rem;color:var(--wine-800)">8</div><div class="small muted">Courses</div></div>
                    <div><div style="font-family:var(--font-display);font-size:1.35rem;color:var(--wine-800)">4.8</div><div class="small muted">Instructor rating</div></div>
                  </div>
                  <div style="display:flex;gap:9px;margin-top:22px">
                    <a href="{{ route('home') }}" class="btn btn-outline btn-sm"><i data-lucide="linkedin"></i> LinkedIn</a>
                    <a href="{{ route('home') }}" class="btn btn-outline btn-sm"><i data-lucide="twitter"></i> X</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-panel" id="tab-reviews">
              <h2 class="display" style="font-size:1.4rem;margin-bottom:22px">Student reviews</h2>
              <div class="card card-pad" style="display:flex;gap:36px;flex-wrap:wrap;align-items:center;margin-bottom:26px">
                <div style="text-align:center">
                  <div style="font-family:var(--font-display);font-size:3.2rem;font-weight:600;color:var(--wine-800);line-height:1">4.8</div>
                  <div style="margin-top:8px"><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></div>
                  <div class="small muted" style="margin-top:6px">3,412 reviews</div>
                </div>
                <div style="flex:1;min-width:250px">
                  <div style="display:flex;align-items:center;gap:11px;margin-bottom:8px">
                      <span class="small" style="width:36px;color:var(--ink-400)">5 star</span>
                      <div class="progress" style="flex:1"><i style="width:72%"></i></div>
                      <span class="small muted" style="width:38px;text-align:right">72%</span>
                    </div><div style="display:flex;align-items:center;gap:11px;margin-bottom:8px">
                      <span class="small" style="width:36px;color:var(--ink-400)">4 star</span>
                      <div class="progress" style="flex:1"><i style="width:21%"></i></div>
                      <span class="small muted" style="width:38px;text-align:right">21%</span>
                    </div><div style="display:flex;align-items:center;gap:11px;margin-bottom:8px">
                      <span class="small" style="width:36px;color:var(--ink-400)">3 star</span>
                      <div class="progress" style="flex:1"><i style="width:5%"></i></div>
                      <span class="small muted" style="width:38px;text-align:right">5%</span>
                    </div><div style="display:flex;align-items:center;gap:11px;margin-bottom:8px">
                      <span class="small" style="width:36px;color:var(--ink-400)">2 star</span>
                      <div class="progress" style="flex:1"><i style="width:1%"></i></div>
                      <span class="small muted" style="width:38px;text-align:right">1%</span>
                    </div><div style="display:flex;align-items:center;gap:11px;margin-bottom:8px">
                      <span class="small" style="width:36px;color:var(--ink-400)">1 star</span>
                      <div class="progress" style="flex:1"><i style="width:1%"></i></div>
                      <span class="small muted" style="width:38px;text-align:right">1%</span>
                    </div>
                </div>
              </div>
              <div class="card card-pad" style="margin-bottom:14px">
                  <div style="display:flex;gap:13px;align-items:flex-start">
                    <img src="https://i.pravatar.cc/160?img=20" alt="" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex:none" onerror="this.style.display='none'">
                    <div style="flex:1">
                      <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap">
                        <div>
                          <div style="font-weight:600;font-size:14.4px;color:var(--ink-900)">Elena Petrova</div>
                          <div class="small muted">18 Sep 2025</div>
                        </div>
                        <div><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></div>
                      </div>
                      <p style="margin-top:11px;font-size:14.4px;line-height:1.7;color:var(--ink-500)">By far the most structured course I have taken. The mentor feedback on my final project was genuinely useful.</p>
                    </div>
                  </div>
                </div><div class="card card-pad" style="margin-bottom:14px">
                  <div style="display:flex;gap:13px;align-items:flex-start">
                    <img src="https://i.pravatar.cc/160?img=32" alt="" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex:none" onerror="this.style.display='none'">
                    <div style="flex:1">
                      <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap">
                        <div>
                          <div style="font-weight:600;font-size:14.4px;color:var(--ink-900)">Sofia Lindberg</div>
                          <div class="small muted">04 Sep 2025</div>
                        </div>
                        <div><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></div>
                      </div>
                      <p style="margin-top:11px;font-size:14.4px;line-height:1.7;color:var(--ink-500)">The SQL module alone was worth the price. I use window functions at work every week now.</p>
                    </div>
                  </div>
                </div><div class="card card-pad" style="margin-bottom:14px">
                  <div style="display:flex;gap:13px;align-items:flex-start">
                    <img src="https://i.pravatar.cc/160?img=24" alt="" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex:none" onerror="this.style.display='none'">
                    <div style="flex:1">
                      <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap">
                        <div>
                          <div style="font-weight:600;font-size:14.4px;color:var(--ink-900)">Claire Dubois</div>
                          <div class="small muted">22 Aug 2025</div>
                        </div>
                        <div><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style="opacity:.25"></i></span></div>
                      </div>
                      <p style="margin-top:11px;font-size:14.4px;line-height:1.7;color:var(--ink-500)">Excellent strategic content. I would have liked more depth on TikTok advertising, but the fundamentals are solid.</p>
                    </div>
                  </div>
                </div><div class="card card-pad" style="margin-bottom:14px">
                  <div style="display:flex;gap:13px;align-items:flex-start">
                    <img src="https://i.pravatar.cc/160?img=15" alt="" style="width:44px;height:44px;border-radius:50%;object-fit:cover;flex:none" onerror="this.style.display='none'">
                    <div style="flex:1">
                      <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap">
                        <div>
                          <div style="font-weight:600;font-size:14.4px;color:var(--ink-900)">Daniel Okonkwo</div>
                          <div class="small muted">11 Aug 2025</div>
                        </div>
                        <div><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></div>
                      </div>
                      <p style="margin-top:11px;font-size:14.4px;line-height:1.7;color:var(--ink-500)">I came in with zero design experience and finished with a portfolio piece I am proud of.</p>
                    </div>
                  </div>
                </div>
            </div>

            <div style="margin-top:60px">
              <h2 class="display" style="font-size:1.4rem;margin-bottom:24px">Related courses</h2>
              <div class="grid g3"><article class="course-card">
    <div class="thumb">
      <img src="https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?auto=format&fit=crop&w=800&q=70" alt="Advanced React &amp; TypeScript" loading="lazy" onerror="this.style.display='none'">
      <div class="thumb-tag">
        <span class="badge badge-ivory">Advanced</span>
      </div>
      <button class="thumb-fav " data-action="wishlist" data-id="7" aria-label="Save course" aria-pressed="false">
        <i data-lucide="heart"></i>
      </button>
    </div>
    <div class="course-body">
      <span class="course-cat">Web Development</span>
      <h3 class="course-title"><a href="{{ route('course.detail', 7) }}">Advanced React &amp; TypeScript</a></h3>
      <div class="course-inst">
        <img src="https://i.pravatar.cc/160?img=12" alt="" onerror="this.style.display='none'">
        <span>Marcus Feld</span>
      </div>
      <div class="course-meta">
        <span><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span> <b class="rating-val">4.9</b> <span class="muted">(1,418)</span></span>
      </div>
      <div class="course-meta">
        <span><i data-lucide="clock"></i>38h</span>
        <span><i data-lucide="play-circle"></i>152 lessons</span>
        <span><i data-lucide="signal"></i>Advanced</span>
      </div>
      <div class="course-foot">
        <span class="price">$109<s>$199</s></span>
        <a href="{{ route('course.detail', 7) }}" class="btn btn-soft btn-sm">View</a>
      </div>
    </div>
  </article></div>
            </div>
          </div>

          <aside>
            <div class="card sticky-card" style="overflow:hidden;border-color:var(--mustard-300);box-shadow:var(--shadow-md)">
              <div class="thumb" style="aspect-ratio:16/10">
                <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70" alt="The Complete Web Development Bootcamp" onerror="this.style.display='none'">
                <div style="position:absolute;inset:0;display:grid;place-items:center;background:rgba(32,8,15,.4);z-index:1">
                  <span style="width:60px;height:60px;border-radius:50%;background:rgba(253,251,246,.97);display:grid;place-items:center;color:var(--wine-800);box-shadow:0 8px 24px rgba(0,0,0,.22)">
                    <i data-lucide="play" style="width:24px;height:24px;margin-left:4px"></i>
                  </span>
                </div>
              </div>
              <div class="card-pad">
                <div style="display:flex;align-items:baseline;gap:10px">
                  <span class="price" style="font-size:2.1rem">$89</span>
                  <s class="muted" style="font-size:15px">$189</s>
                  <span class="badge badge-danger" style="margin-left:auto">53% off</span>
                </div>
                <p class="small" style="color:var(--mustard-700);font-weight:600;margin-top:10px"><i data-lucide="clock" style="width:13px;height:13px;vertical-align:-2px"></i> Offer ends in 2 days</p>

                <div style="display:flex;flex-direction:column;gap:9px;margin-top:20px">
                  <button class="btn btn-primary btn-lg btn-block" data-action="enroll" data-id="1">
                    <i data-lucide="check-circle-2"></i> Enrolled — Go to course
                  </button>
                  <button class="btn btn-outline btn-block" data-action="wishlist" data-id="1">
                    <i data-lucide="heart"></i> Add to wishlist
                  </button>
                </div>

                <div style="margin-top:24px;padding-top:22px;border-top:1px solid var(--cream-200)">
                  <p style="font-size:12.5px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--ink-400);margin-bottom:14px">This course includes</p>
                  <div style="display:flex;flex-direction:column;gap:11px">
                    <div style="display:flex;align-items:center;gap:10px;font-size:13.8px;color:var(--ink-500)"><i data-lucide="video" style="width:16px;height:16px;color:var(--wine-600);flex:none"></i>52h of on-demand video</div><div style="display:flex;align-items:center;gap:10px;font-size:13.8px;color:var(--ink-500)"><i data-lucide="file-text" style="width:16px;height:16px;color:var(--wine-600);flex:none"></i>15 lessons and resources</div><div style="display:flex;align-items:center;gap:10px;font-size:13.8px;color:var(--ink-500)"><i data-lucide="infinity" style="width:16px;height:16px;color:var(--wine-600);flex:none"></i>Lifetime access</div><div style="display:flex;align-items:center;gap:10px;font-size:13.8px;color:var(--ink-500)"><i data-lucide="smartphone" style="width:16px;height:16px;color:var(--wine-600);flex:none"></i>Access on mobile and desktop</div><div style="display:flex;align-items:center;gap:10px;font-size:13.8px;color:var(--ink-500)"><i data-lucide="award" style="width:16px;height:16px;color:var(--wine-600);flex:none"></i>Certificate of completion</div><div style="display:flex;align-items:center;gap:10px;font-size:13.8px;color:var(--ink-500)"><i data-lucide="message-square" style="width:16px;height:16px;color:var(--wine-600);flex:none"></i>Mentor support and community</div>
                  </div>
                </div>

                <div style="margin-top:22px;padding-top:20px;border-top:1px solid var(--cream-200)">
                  <div class="info-row"><span class="k"><i data-lucide="signal"></i>Level</span><span class="v">Beginner</span></div>
                  <div class="info-row"><span class="k"><i data-lucide="globe"></i>Language</span><span class="v">English</span></div>
                  <div class="info-row"><span class="k"><i data-lucide="users"></i>Enrolled</span><span class="v">18,420</span></div>
                  <div class="info-row"><span class="k"><i data-lucide="refresh-cw"></i>Last updated</span><span class="v">Sep 2025</span></div>
                </div>

                <div class="notice ivory" style="margin-top:18px;font-size:12.8px">
                  <i data-lucide="shield-check"></i>
                  <span>30-day money-back guarantee. Full refund if you complete less than 30% of the course.</span>
                </div>
              </div>
            </div>

            <div class="card" style="margin-top:20px">
              <div class="card-pad" style="padding-bottom:6px">
                <h3 style="font-size:15.5px">Course questions</h3>
              </div>
              <div style="padding:0 22px 12px">
                
                  <div class="accordion-item">
                    <button class="acc-head" data-action="accordion" style="font-size:14px;padding:14px 0" aria-expanded="false">
                      <span>Do I get a certificate when I finish a course?</span><i data-lucide="chevron-down"></i>
                    </button>
                    <div class="acc-body"><p style="font-size:13.6px;padding-bottom:14px">Yes. Every course includes a verifiable certificate of completion. Once you finish all lessons and pass the final assessment, your certificate is generated automatically with a unique verification ID you can share on LinkedIn or with employers.</p></div>
                  </div>
                  <div class="accordion-item">
                    <button class="acc-head" data-action="accordion" style="font-size:14px;padding:14px 0" aria-expanded="false">
                      <span>How long do I have access to a course?</span><i data-lucide="chevron-down"></i>
                    </button>
                    <div class="acc-body"><p style="font-size:13.6px;padding-bottom:14px">You get lifetime access to any course you enrol in, including all future updates, new lessons and downloadable resources. There is no recurring fee for course access.</p></div>
                  </div>
                  <div class="accordion-item">
                    <button class="acc-head" data-action="accordion" style="font-size:14px;padding:14px 0" aria-expanded="false">
                      <span>Can I get a refund if the course is not right for me?</span><i data-lucide="chevron-down"></i>
                    </button>
                    <div class="acc-body"><p style="font-size:13.6px;padding-bottom:14px">We offer a 30-day refund policy. If you have completed less than 30% of the course and it is within 30 days of purchase, contact support and we will process a full refund, no questions asked.</p></div>
                  </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>
  </main>
@endsection
