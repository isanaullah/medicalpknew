@extends('layouts.student')

@section('title', 'Student Dashboard — Verdant Academy')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-head">
    <div>
      <h1>Welcome back, Elena</h1>
      <p>You're 62% through the web development bootcamp. Keep going — you're ahead of schedule.</p>
    </div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <a href="{{ route('courses') }}" class="btn btn-outline"><i data-lucide="compass"></i> Explore courses</a>
      <button class="btn btn-primary" data-action="resume"><i data-lucide="play"></i> Resume learning</button>
    </div>
  </div>

  <div class="grid g4" style="margin-bottom:28px">
    <div class="stat-card">
      <div class="stat-top"><div class="stat-icon"><i data-lucide="book-open"></i></div></div>
      <div class="stat-value">2</div>
      <div class="stat-label">Enrolled courses</div>
    </div>
    <div class="stat-card">
      <div class="stat-top"><div class="stat-icon gold"><i data-lucide="check-circle-2"></i></div></div>
      <div class="stat-value">237</div>
      <div class="stat-label">Lessons completed</div>
      <div class="stat-delta up"><i data-lucide="trending-up"></i>+12 this week</div>
    </div>
    <div class="stat-card">
      <div class="stat-top"><div class="stat-icon ivory"><i data-lucide="clock"></i></div></div>
      <div class="stat-value">38h</div>
      <div class="stat-label">Time learned</div>
      <div class="stat-delta up"><i data-lucide="trending-up"></i>+4.5h this week</div>
    </div>
    <div class="stat-card">
      <div class="stat-top"><div class="stat-icon gold"><i data-lucide="award"></i></div></div>
      <div class="stat-value">1</div>
      <div class="stat-label">Certificate earned</div>
      <div class="stat-delta up"><i data-lucide="sparkles"></i>1 in progress</div>
    </div>
  </div>

  <div class="grid" style="grid-template-columns:1.5fr 1fr;gap:24px;align-items:start" id="student-grid">
    <div>
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
        <h2 class="display" style="font-size:1.22rem">Continue learning</h2>
        <a href="{{ route('student.courses') }}" class="small" style="color:var(--wine-700);font-weight:600">View all</a>
      </div>
      <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:30px">
        
          <div class="continue-card">
            <img class="cimg" src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70" alt="" onerror="this.style.display='none'">
            <div>
              <span class="course-cat">Web Development</span>
              <h3 style="font-size:15.4px;margin-top:5px;line-height:1.4">The Complete Web Development Bootcamp</h3>
              <div style="display:flex;align-items:center;gap:10px;margin-top:12px">
                <div class="progress" style="flex:1;max-width:260px"><i style="width:86%"></i></div>
                <span class="small" style="font-weight:700;color:var(--wine-800)">86%</span>
              </div>
              <p class="small muted" style="margin-top:7px">Next: Authentication and sessions · 38 min</p>
            </div>
            <button class="btn btn-primary btn-sm" data-action="resume"><i data-lucide="play"></i> Resume</button>
          </div>
          <div class="continue-card">
            <img class="cimg" src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=70" alt="" onerror="this.style.display='none'">
            <div>
              <span class="course-cat">Data &amp; Analytics</span>
              <h3 style="font-size:15.4px;margin-top:5px;line-height:1.4">Data Analytics with Python &amp; SQL</h3>
              <div style="display:flex;align-items:center;gap:10px;margin-top:12px">
                <div class="progress" style="flex:1;max-width:260px"><i style="width:64%"></i></div>
                <span class="small" style="font-weight:700;color:var(--wine-800)">64%</span>
              </div>
              <p class="small muted" style="margin-top:7px">Next: Working with PostgreSQL · 38 min</p>
            </div>
            <button class="btn btn-primary btn-sm" data-action="resume"><i data-lucide="play"></i> Resume</button>
          </div>
      </div>

      <h2 class="display" style="font-size:1.22rem;margin-bottom:14px">Recently accessed lessons</h2>
      <div class="card" style="padding:6px 22px">
        
          <div class="activity">
            <div class="a-ic"><i data-lucide="play-circle"></i></div>
            <div style="flex:1">
              <div class="a-t"><b>Authentication and sessions</b> <span class="muted">· Web Development Bootcamp</span></div>
              <div class="a-time">2 hours ago · 38:55</div>
            </div>
            <button class="mini-btn" data-action="resume" aria-label="Resume lesson"><i data-lucide="play"></i></button>
          </div>
          <div class="activity">
            <div class="a-ic"><i data-lucide="play-circle"></i></div>
            <div style="flex:1">
              <div class="a-t"><b>Window functions</b> <span class="muted">· Data Analytics with Python &amp; SQL</span></div>
              <div class="a-time">Yesterday · 35:18</div>
            </div>
            <button class="mini-btn" data-action="resume" aria-label="Resume lesson"><i data-lucide="play"></i></button>
          </div>
          <div class="activity">
            <div class="a-ic"><i data-lucide="play-circle"></i></div>
            <div style="flex:1">
              <div class="a-t"><b>Compound components</b> <span class="muted">· Advanced React &amp; TypeScript</span></div>
              <div class="a-time">3 days ago · 32:18</div>
            </div>
            <button class="mini-btn" data-action="resume" aria-label="Resume lesson"><i data-lucide="play"></i></button>
          </div>
          <div class="activity">
            <div class="a-ic"><i data-lucide="play-circle"></i></div>
            <div style="flex:1">
              <div class="a-t"><b>Driver-based forecasting</b> <span class="muted">· Financial Modelling for Managers</span></div>
              <div class="a-time">5 days ago · 35:20</div>
            </div>
            <button class="mini-btn" data-action="resume" aria-label="Resume lesson"><i data-lucide="play"></i></button>
          </div>
      </div>
    </div>

    <div>
      <div class="card card-pad" style="margin-bottom:18px">
        <h2 style="font-size:15.6px;margin-bottom:18px">Weekly goal</h2>
        <div style="display:flex;align-items:center;gap:16px">
          <div style="position:relative;width:86px;height:86px;flex:none">
            <svg viewBox="0 0 36 36" style="transform:rotate(-90deg)">
              <circle cx="18" cy="18" r="15.9" fill="none" stroke="#F2E9D3" stroke-width="3.4"></circle>
              <circle cx="18" cy="18" r="15.9" fill="none" stroke="#D9A521" stroke-width="3.4"
                      stroke-dasharray="72 100" stroke-linecap="round"></circle>
            </svg>
            <div style="position:absolute;inset:0;display:grid;place-items:center;font-family:var(--font-display);font-size:1.2rem;font-weight:600;color:var(--ink-900)">72%</div>
          </div>
          <div>
            <div style="font-size:14.4px;font-weight:600;color:var(--ink-900)">5h 45m of 8h</div>
            <p class="small muted" style="margin-top:5px;line-height:1.55">You need 2h 15m more to hit this week's target.</p>
          </div>
        </div>
        <div class="notice gold" style="margin-top:16px;font-size:12.8px">
          <i data-lucide="flame"></i>
          <span>You're on a 12-day learning streak. Keep it alive!</span>
        </div>
      </div>

      <div class="card card-pad" style="margin-bottom:18px">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
          <h2 style="font-size:15.6px">Recent notifications</h2>
          <a href="{{ route('student.notifications') }}" class="small" style="color:var(--wine-700);font-weight:600">All</a>
        </div>
        
          <div class="activity">
            <div class="a-ic"><i data-lucide="award"></i></div>
            <div style="flex:1">
              <div class="a-t">You earned a certificate in Data Analytics</div>
              <div class="a-time">2 days ago</div>
            </div>
          </div>
          <div class="activity">
            <div class="a-ic"><i data-lucide="message-square"></i></div>
            <div style="flex:1">
              <div class="a-t">Marcus Feld replied to your question</div>
              <div class="a-time">4 days ago</div>
            </div>
          </div>
          <div class="activity">
            <div class="a-ic"><i data-lucide="sparkles"></i></div>
            <div style="flex:1">
              <div class="a-t">New course added to your wishlist category</div>
              <div class="a-time">1 week ago</div>
            </div>
          </div>
      </div>

      <div class="card card-pad">
        <h2 style="font-size:15.6px;margin-bottom:14px">Your instructors</h2>
        
          <div class="activity">
            <img src="https://i.pravatar.cc/160?img=45" alt="" onerror="this.style.display='none'">
            <div style="flex:1">
              <div class="a-t"><b>Dr. Amara Osei</b></div>
              <div class="a-time">Lead Data Scientist</div>
            </div>
            <button class="mini-btn" data-action="toast-demo" data-msg="Message sent to Dr. Amara Osei"><i data-lucide="message-square"></i></button>
          </div>
          <div class="activity">
            <img src="https://i.pravatar.cc/160?img=12" alt="" onerror="this.style.display='none'">
            <div style="flex:1">
              <div class="a-t"><b>Marcus Feld</b></div>
              <div class="a-time">Full-Stack Engineer</div>
            </div>
            <button class="mini-btn" data-action="toast-demo" data-msg="Message sent to Marcus Feld"><i data-lucide="message-square"></i></button>
          </div>
          <div class="activity">
            <img src="https://i.pravatar.cc/160?img=47" alt="" onerror="this.style.display='none'">
            <div style="flex:1">
              <div class="a-t"><b>Priya Raghunathan</b></div>
              <div class="a-time">Product Design Director</div>
            </div>
            <button class="mini-btn" data-action="toast-demo" data-msg="Message sent to Priya Raghunathan"><i data-lucide="message-square"></i></button>
          </div>
      </div>
    </div>
  </div>
@endsection
