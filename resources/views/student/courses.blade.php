@extends('layouts.student')

@section('title', 'My Enrolled Courses — Verdant Academy')
@section('page-title', 'My Courses')

@section('content')
<div class="page-head">
    <div><h1>My Courses</h1><p>2 active enrolments · 1 completed</p></div>
    <a href="{{ route('courses') }}" class="btn btn-primary"><i data-lucide="plus"></i> Find a new course</a>
  </div>

  <div class="tabs" style="margin-bottom:8px">
    <button class="tab-btn active" data-action="tab" data-tab="sc-active">In progress (1)</button>
    <button class="tab-btn" data-action="tab" data-tab="sc-done">Completed (1)</button>
  </div>

  <div class="tab-panel active" id="tab-sc-active">
    <div class="grid g2" style="margin-top:22px">
      
        <div class="card" style="overflow:hidden">
          <div class="thumb" style="aspect-ratio:16/7">
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=70" alt="" onerror="this.style.display='none'">
          </div>
          <div class="card-pad">
            <span class="course-cat">Data &amp; Analytics</span>
            <h3 style="font-size:15.6px;margin-top:6px;line-height:1.4">Data Analytics with Python &amp; SQL</h3>
            <p class="small muted" style="margin-top:6px">Dr. Amara Osei</p>
            <div style="display:flex;align-items:center;gap:11px;margin-top:14px">
              <div class="progress" style="flex:1"><i style="width:64%"></i></div>
              <span class="small" style="font-weight:700;color:var(--wine-800)">64%</span>
            </div>
            <div class="info-row" style="margin-top:12px;border-bottom:0;padding-bottom:0">
              <span class="k"><i data-lucide="play-circle"></i>168 lessons</span>
              <span class="k"><i data-lucide="clock"></i>44h</span>
            </div>
            <div style="display:flex;gap:9px;margin-top:16px">
              <button class="btn btn-primary btn-sm btn-block" data-action="resume"><i data-lucide="play"></i> Continue</button>
              <a href="{{ route('course.detail', 2) }}" class="btn btn-outline btn-sm">Details</a>
            </div>
          </div>
        </div>
        <div class="card" style="overflow:hidden">
          <div class="thumb" style="aspect-ratio:16/7">
            <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=70" alt="" onerror="this.style.display='none'">
          </div>
          <div class="card-pad">
            <span class="course-cat">Product Design</span>
            <h3 style="font-size:15.6px;margin-top:6px;line-height:1.4">Product Design Foundations</h3>
            <p class="small muted" style="margin-top:6px">Priya Raghunathan</p>
            <div style="display:flex;align-items:center;gap:11px;margin-top:14px">
              <div class="progress" style="flex:1"><i style="width:41%"></i></div>
              <span class="small" style="font-weight:700;color:var(--wine-800)">41%</span>
            </div>
            <div class="info-row" style="margin-top:12px;border-bottom:0;padding-bottom:0">
              <span class="k"><i data-lucide="play-circle"></i>142 lessons</span>
              <span class="k"><i data-lucide="clock"></i>36h</span>
            </div>
            <div style="display:flex;gap:9px;margin-top:16px">
              <button class="btn btn-primary btn-sm btn-block" data-action="resume"><i data-lucide="play"></i> Continue</button>
              <a href="{{ route('course.detail', 3) }}" class="btn btn-outline btn-sm">Details</a>
            </div>
          </div>
        </div>
        <div class="card" style="overflow:hidden">
          <div class="thumb" style="aspect-ratio:16/7">
            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=70" alt="" onerror="this.style.display='none'">
          </div>
          <div class="card-pad">
            <span class="course-cat">Cloud &amp; DevOps</span>
            <h3 style="font-size:15.6px;margin-top:6px;line-height:1.4">AWS Certified Cloud Practitioner</h3>
            <p class="small muted" style="margin-top:6px">Jonas Lindqvist</p>
            <div style="display:flex;align-items:center;gap:11px;margin-top:14px">
              <div class="progress" style="flex:1"><i style="width:22%"></i></div>
              <span class="small" style="font-weight:700;color:var(--wine-800)">22%</span>
            </div>
            <div class="info-row" style="margin-top:12px;border-bottom:0;padding-bottom:0">
              <span class="k"><i data-lucide="play-circle"></i>118 lessons</span>
              <span class="k"><i data-lucide="clock"></i>28h</span>
            </div>
            <div style="display:flex;gap:9px;margin-top:16px">
              <button class="btn btn-primary btn-sm btn-block" data-action="resume"><i data-lucide="play"></i> Continue</button>
              <a href="{{ route('course.detail', 4) }}" class="btn btn-outline btn-sm">Details</a>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="tab-panel" id="tab-sc-done">
    <div class="grid g2" style="margin-top:22px">
      
        <div class="card" style="overflow:hidden">
          <div class="thumb" style="aspect-ratio:16/7">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70" alt="" onerror="this.style.display='none'">
            <div class="thumb-tag"><span class="badge badge-success"><i data-lucide="check"></i> Completed</span></div>
          </div>
          <div class="card-pad">
            <span class="course-cat">Web Development</span>
            <h3 style="font-size:15.6px;margin-top:6px">The Complete Web Development Bootcamp</h3>
            <div class="progress" style="margin-top:14px"><i style="width:100%"></i></div>
            <p class="small muted" style="margin-top:8px">Finished 14 September 2025 · Grade: Merit</p>
            <div style="display:flex;gap:9px;margin-top:16px">
              <button class="btn btn-gold btn-sm" data-action="view-cert"><i data-lucide="award"></i> View certificate</button>
              <a href="{{ route('course.detail', 1) }}" class="btn btn-outline btn-sm">Review course</a>
            </div>
          </div>
        </div>
      <div class="empty-state" style="height:100%">
        <i data-lucide="graduation-cap"></i>
        <h3>Complete another course</h3>
        <p>Finish your current programme to earn your next verified certificate.</p>
        <a href="{{ route('courses') }}" class="btn btn-primary">Browse courses</a>
      </div>
    </div>
  </div>
@endsection
