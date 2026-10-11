@extends('layouts.admin')

@section('title', 'Admin Dashboard — Verdant Academy')
@section('page-title', 'Dashboard')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Dashboard</span>
  </nav>
  <div class="page-head">
    <div><h1>Dashboard</h1><p>Platform overview for October 2025</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-outline" data-action="toast-demo" data-msg="Report exported as CSV"><i data-lucide="download"></i> Export report</button>
      <button class="btn btn-primary" data-action="new-course"><i data-lucide="plus"></i> New course</button>
    </div>
  </div>

  <div class="grid g4" style="margin-bottom:24px">
    <div class="stat-card">
      <div class="stat-top"><div class="stat-icon"><i data-lucide="book-open"></i></div><span class="badge badge-success">+8</span></div>
      <div class="stat-value">216</div><div class="stat-label">Total courses</div>
      <div class="stat-delta up"><i data-lucide="trending-up"></i>+3.8% vs last month</div>
    </div>
    <div class="stat-card">
      <div class="stat-top"><div class="stat-icon gold"><i data-lucide="users"></i></div><span class="badge badge-success">+612</span></div>
      <div class="stat-value">48,512</div><div class="stat-label">Total students</div>
      <div class="stat-delta up"><i data-lucide="trending-up"></i>+1.3% vs last month</div>
    </div>
    <div class="stat-card">
      <div class="stat-top"><div class="stat-icon"><i data-lucide="clipboard-list"></i></div><span class="badge badge-success">+84</span></div>
      <div class="stat-value">1,268</div><div class="stat-label">Enrollments this month</div>
      <div class="stat-delta up"><i data-lucide="trending-up"></i>+7.1% vs last month</div>
    </div>
    <div class="stat-card">
      <div class="stat-top"><div class="stat-icon ivory"><i data-lucide="graduation-cap"></i></div></div>
      <div class="stat-value">64</div><div class="stat-label">Active instructors</div>
      <div class="stat-delta"><i data-lucide="minus"></i>No change</div>
    </div>
  </div>

  <div class="grid" style="grid-template-columns:1.6fr 1fr;gap:24px;align-items:start;margin-bottom:24px" id="admin-grid">
    <div class="card">
      <div style="padding:22px 24px;border-bottom:1px solid var(--cream-300);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px">
        <div>
          <h2 style="font-size:15.6px">Enrollments over time</h2>
          <p class="small muted" style="margin-top:3px">Monthly course registrations, last 12 months</p>
        </div>
        <span class="badge badge-forest"><i data-lucide="trending-up"></i> +207% year over year</span>
      </div>
      <div style="padding:26px 24px 14px">
        <div class="chart">
          
            <div class="bar-wrap">
              <div class="bar " style="height:32%" data-val="412 enrollments"></div>
              <span class="bar-lbl">Nov</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:29%" data-val="368 enrollments"></div>
              <span class="bar-lbl">Dec</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:54%" data-val="684 enrollments"></div>
              <span class="bar-lbl">Jan</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:58%" data-val="731 enrollments"></div>
              <span class="bar-lbl">Feb</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:64%" data-val="812 enrollments"></div>
              <span class="bar-lbl">Mar</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:61%" data-val="769 enrollments"></div>
              <span class="bar-lbl">Apr</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:71%" data-val="894 enrollments"></div>
              <span class="bar-lbl">May</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:66%" data-val="842 enrollments"></div>
              <span class="bar-lbl">Jun</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:81%" data-val="1032 enrollments"></div>
              <span class="bar-lbl">Jul</span>
            </div>
            <div class="bar-wrap">
              <div class="bar " style="height:76%" data-val="968 enrollments"></div>
              <span class="bar-lbl">Aug</span>
            </div>
            <div class="bar-wrap">
              <div class="bar gold" style="height:93%" data-val="1184 enrollments"></div>
              <span class="bar-lbl">Sep</span>
            </div>
            <div class="bar-wrap">
              <div class="bar gold" style="height:100%" data-val="1268 enrollments"></div>
              <span class="bar-lbl">Oct</span>
            </div>
        </div>
      </div>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid var(--cream-300)">
        <div style="padding:18px 24px;border-right:1px solid var(--cream-300)">
          <div class="small muted">Total enrollments</div>
          <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--wine-800);margin-top:3px">10,964</div>
        </div>
        <div style="padding:18px 24px;border-right:1px solid var(--cream-300)">
          <div class="small muted">Average per month</div>
          <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--wine-800);margin-top:3px">914</div>
        </div>
        <div style="padding:18px 24px">
          <div class="small muted">Completion rate</div>
          <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--wine-800);margin-top:3px">68%</div>
        </div>
      </div>
    </div>

    <div class="card card-pad">
      <h2 style="font-size:15.6px;margin-bottom:6px">Quick actions</h2>
      <p class="small muted" style="margin-bottom:18px">Common administrative tasks</p>
      <div style="display:flex;flex-direction:column;gap:9px">
        <button class="btn btn-primary btn-block" data-action="new-course" style="justify-content:flex-start"><i data-lucide="plus-circle"></i> Add new course</button>
        <button class="btn btn-outline btn-block" data-action="new-instructor" style="justify-content:flex-start"><i data-lucide="user-plus"></i> Invite instructor</button>
        <button class="btn btn-outline btn-block" data-action="new-post" style="justify-content:flex-start"><i data-lucide="file-plus"></i> Write blog article</button>
        <button class="btn btn-outline btn-block" data-action="new-notification" style="justify-content:flex-start"><i data-lucide="megaphone"></i> Send announcement</button>
        <a href="{{ route('admin.messages') }}" class="btn btn-outline btn-block" style="justify-content:flex-start"><i data-lucide="mail"></i> Review messages <span class="badge badge-danger" style="margin-left:auto">2</span></a>
      </div>
      <div class="notice" style="margin-top:18px;font-size:12.8px">
        <i data-lucide="info"></i>
        <span>Demo panel — all actions are simulated in the browser with sample data.</span>
      </div>
    </div>
  </div>

  <div class="grid g2" style="margin-bottom:24px">
    <div class="card">
      <div style="padding:20px 22px;border-bottom:1px solid var(--cream-300);display:flex;justify-content:space-between;align-items:center">
        <h2 style="font-size:15.4px">Recent enrollments</h2>
        <a href="{{ route('admin.enrollments') }}" class="small" style="color:var(--wine-700);font-weight:600">View all</a>
      </div>
      <div style="padding:4px 22px">
        <div class="activity">
            <img src="https://i.pravatar.cc/160?img=20" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Elena Petrova</b> enrolled in The Complete Web Development Bootcamp</div>
              <div class="a-time">14 Jan 2025 · $89</div>
            </div>
            <span class="badge badge-forest">Active</span>
          </div><div class="activity">
            <img src="https://i.pravatar.cc/160?img=32" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Sofia Lindberg</b> enrolled in Data Analytics with Python &amp; SQL</div>
              <div class="a-time">25 Feb 2025 · $99</div>
            </div>
            <span class="badge badge-success">Completed</span>
          </div><div class="activity">
            <img src="https://i.pravatar.cc/160?img=15" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Daniel Okonkwo</b> enrolled in Product Design Foundations</div>
              <div class="a-time">06 Feb 2025 · $79</div>
            </div>
            <span class="badge badge-forest">Active</span>
          </div><div class="activity">
            <img src="https://i.pravatar.cc/160?img=24" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Claire Dubois</b> enrolled in Digital Marketing Strategy</div>
              <div class="a-time">19 Apr 2025 · $85</div>
            </div>
            <span class="badge badge-forest">Active</span>
          </div><div class="activity">
            <img src="https://i.pravatar.cc/160?img=60" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Tomasz Kowalski</b> enrolled in The Complete Web Development Bootcamp</div>
              <div class="a-time">31 May 2025 · $89</div>
            </div>
            <span class="badge badge-forest">Active</span>
          </div>
      </div>
    </div>

    <div class="card">
      <div style="padding:20px 22px;border-bottom:1px solid var(--cream-300);display:flex;justify-content:space-between;align-items:center">
        <h2 style="font-size:15.4px">Popular courses</h2>
        <a href="{{ route('admin.courses') }}" class="small" style="color:var(--wine-700);font-weight:600">View all</a>
      </div>
      <div style="padding:4px 22px">
        
          <div class="activity">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70" alt="" style="border-radius:8px" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>The Complete Web Development Bootcamp</b></div>
              <div class="a-time">18,420 students · 4.8 rating</div>
            </div>
            <span style="font-weight:700;font-size:13.6px;color:var(--wine-800)">$89</span>
          </div>
          <div class="activity">
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=70" alt="" style="border-radius:8px" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Data Analytics with Python &amp; SQL</b></div>
              <div class="a-time">12,340 students · 4.9 rating</div>
            </div>
            <span style="font-weight:700;font-size:13.6px;color:var(--wine-800)">$99</span>
          </div>
          <div class="activity">
            <img src="https://images.unsplash.com/photo-1526379095098-d400fd0bf935?auto=format&fit=crop&w=800&q=70" alt="" style="border-radius:8px" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Python for Automation &amp; Scripting</b></div>
              <div class="a-time">11,240 students · 4.8 rating</div>
            </div>
            <span style="font-weight:700;font-size:13.6px;color:var(--wine-800)">$59</span>
          </div>
          <div class="activity">
            <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=70" alt="" style="border-radius:8px" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Product Design Foundations</b></div>
              <div class="a-time">9,860 students · 4.9 rating</div>
            </div>
            <span style="font-weight:700;font-size:13.6px;color:var(--wine-800)">$79</span>
          </div>
          <div class="activity">
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=70" alt="" style="border-radius:8px" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Digital Marketing Strategy</b></div>
              <div class="a-time">8,930 students · 4.8 rating</div>
            </div>
            <span style="font-weight:700;font-size:13.6px;color:var(--wine-800)">$85</span>
          </div>
      </div>
    </div>
  </div>

  <div class="grid g2">
    <div class="card">
      <div style="padding:20px 22px;border-bottom:1px solid var(--cream-300);display:flex;justify-content:space-between;align-items:center">
        <h2 style="font-size:15.4px">Recent registrations</h2>
        <a href="{{ route('admin.students') }}" class="small" style="color:var(--wine-700);font-weight:600">View all</a>
      </div>
      <div style="padding:4px 22px">
        
          <div class="activity">
            <img src="https://i.pravatar.cc/160?img=20" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Elena Petrova</b></div>
              <div class="a-time">elena.petrova@example.com · joined 12 Jan 2025</div>
            </div>
            <span class="badge badge-success">Active</span>
          </div>
          <div class="activity">
            <img src="https://i.pravatar.cc/160?img=15" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Daniel Okonkwo</b></div>
              <div class="a-time">daniel.okonkwo@example.com · joined 03 Feb 2025</div>
            </div>
            <span class="badge badge-success">Active</span>
          </div>
          <div class="activity">
            <img src="https://i.pravatar.cc/160?img=32" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Sofia Lindberg</b></div>
              <div class="a-time">sofia.lindberg@example.com · joined 22 Feb 2025</div>
            </div>
            <span class="badge badge-success">Active</span>
          </div>
          <div class="activity">
            <img src="https://i.pravatar.cc/160?img=51" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Rahul Mehta</b></div>
              <div class="a-time">rahul.mehta@example.com · joined 08 Mar 2025</div>
            </div>
            <span class="badge badge-ivory">Inactive</span>
          </div>
          <div class="activity">
            <img src="https://i.pravatar.cc/160?img=24" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Claire Dubois</b></div>
              <div class="a-time">claire.dubois@example.com · joined 17 Apr 2025</div>
            </div>
            <span class="badge badge-success">Active</span>
          </div>
      </div>
    </div>

    <div class="card">
      <div style="padding:20px 22px;border-bottom:1px solid var(--cream-300);display:flex;justify-content:space-between;align-items:center">
        <h2 style="font-size:15.4px">Recent reviews</h2>
        <a href="{{ route('admin.reviews') }}" class="small" style="color:var(--wine-700);font-weight:600">View all</a>
      </div>
      <div style="padding:4px 22px">
        <div class="activity">
            <img src="https://i.pravatar.cc/160?img=20" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Elena Petrova</b> rated The Complete Web Development Bootcamp</div>
              <div style="margin-top:5px"><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></div>
              <div class="a-time" style="margin-top:5px">18 Sep 2025</div>
            </div>
            <span class="badge badge-success">Approved</span>
          </div><div class="activity">
            <img src="https://i.pravatar.cc/160?img=32" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Sofia Lindberg</b> rated Data Analytics with Python &amp; SQL</div>
              <div style="margin-top:5px"><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></div>
              <div class="a-time" style="margin-top:5px">04 Sep 2025</div>
            </div>
            <span class="badge badge-success">Approved</span>
          </div><div class="activity">
            <img src="https://i.pravatar.cc/160?img=24" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Claire Dubois</b> rated Digital Marketing Strategy</div>
              <div style="margin-top:5px"><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style="opacity:.25"></i></span></div>
              <div class="a-time" style="margin-top:5px">22 Aug 2025</div>
            </div>
            <span class="badge badge-success">Approved</span>
          </div><div class="activity">
            <img src="https://i.pravatar.cc/160?img=15" alt="" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
              <div class="a-t"><b>Daniel Okonkwo</b> rated Product Design Foundations</div>
              <div style="margin-top:5px"><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></div>
              <div class="a-time" style="margin-top:5px">11 Aug 2025</div>
            </div>
            <span class="badge badge-success">Approved</span>
          </div>
      </div>
    </div>
  </div>
@endsection
