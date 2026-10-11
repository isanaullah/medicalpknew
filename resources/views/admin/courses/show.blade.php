@extends('layouts.admin')

@section('title', $course->title . ' — Verdant Academy')
@section('page-title', 'Course Details')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.courses') }}">Courses</a><span class="sep">/</span>
    <span>{{ $course->title }}</span>
  </nav>

  <div class="page-head">
    <div>
      <h1>{{ $course->title }}</h1>
      <p>
        <span class="badge {{ $course->isPaid() ? 'badge-wine' : 'badge-forest' }}">{{ $course->type }}</span>
        @if ($course->category)
          <span class="badge badge-amber" style="margin-left:6px">{{ $course->category->name }}</span>
        @else
          <span class="badge badge-gray" style="margin-left:6px">Uncategorized</span>
        @endif
        <span class="badge {{ $course->status === 'Published' ? 'badge-success' : 'badge-amber' }}" style="margin-left:6px">{{ $course->status }}</span>
        <span style="margin-left:12px;color:var(--ink-500)">{{ $course->level }} · {{ $course->duration ?? 'Self-paced' }}</span>
      </p>
    </div>
    <div style="display:flex;gap:9px">
      <a href="{{ route('admin.curriculum', ['course_id' => $course->slug]) }}" class="btn btn-primary">
        <i data-lucide="layers"></i> Open Course Builder
      </a>
      <a href="{{ route('admin.courses.edit', $course->slug) }}" class="btn btn-outline">
        <i data-lucide="pencil"></i> Edit Course
      </a>
      <a href="{{ route('admin.courses') }}" class="btn btn-outline">
        <i data-lucide="arrow-left"></i> All Courses
      </a>
    </div>
  </div>

  <div class="grid" style="grid-template-columns:1.6fr 1fr;gap:24px;align-items:start">
    <div>
      <!-- Preview Video Player Card -->
      <div class="card" style="margin-bottom:24px;overflow:hidden">
        <div style="padding:16px 20px;background:var(--wine-900);color:#fff;display:flex;align-items:center;justify-content:space-between">
          <div style="display:flex;align-items:center;gap:10px">
            <i data-lucide="play-circle" style="color:var(--mustard-400)"></i>
            <b style="font-size:15px">Course Preview Video Player</b>
          </div>
          <span class="badge badge-amber" style="font-size:11px">Accessible without purchase</span>
        </div>
        
        <div style="background:#000;aspect-ratio:16/9;display:flex;align-items:center;justify-content:center">
          @if ($course->preview_video_url)
            @php
              $vUrl = $course->preview_video_url;
              $embed = null;
              if (str_contains($vUrl, 'youtube.com/watch?v=')) {
                $vid = explode('v=', $vUrl)[1];
                $vid = explode('&', $vid)[0];
                $embed = 'https://www.youtube.com/embed/' . $vid;
              } elseif (str_contains($vUrl, 'youtu.be/')) {
                $vid = explode('youtu.be/', $vUrl)[1];
                $vid = explode('?', $vid)[0];
                $embed = 'https://www.youtube.com/embed/' . $vid;
              } elseif (str_contains($vUrl, 'vimeo.com/')) {
                $vid = explode('vimeo.com/', $vUrl)[1];
                $vid = explode('?', $vid)[0];
                $embed = 'https://player.vimeo.com/video/' . $vid;
              }
            @endphp
            @if ($embed)
              <iframe src="{{ $embed }}" style="width:100%;height:100%;border:none" allowfullscreen></iframe>
            @else
              <video controls style="width:100%;height:100%">
                <source src="{{ $course->preview_video_url }}">
                Your browser does not support HTML5 video.
              </video>
            @endif
          @elseif ($course->preview_video_path)
            <video controls style="width:100%;height:100%">
              <source src="{{ Storage::disk('public')->url($course->preview_video_path) }}">
              Your browser does not support HTML5 video.
            </video>
          @else
            <div style="text-align:center;color:var(--cream-300);padding:30px">
              <i data-lucide="video-off" style="width:36px;height:36px;margin-bottom:8px"></i>
              <p style="margin:0;font-size:14px">No preview video configured for this course yet.</p>
              <a href="{{ route('admin.courses.edit', $course->id) }}" style="color:var(--mustard-400);font-size:13px;display:inline-block;margin-top:6px">Add preview video</a>
            </div>
          @endif
        </div>
        <div style="padding:14px 20px;background:var(--cream-50);font-size:13px;color:var(--ink-500)">
          <b>Preview Video Rule:</b> Unenrolled visitors can watch this preview video freely. Full lessons, PDF downloads, and quizzes are protected by server-side entitlement checks.
        </div>
      </div>

      <!-- Syllabus & Lessons List -->
      <div class="card" style="margin-bottom:24px;padding:22px">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
          <h3 style="margin:0;font-size:17px;color:var(--wine-900)">
            Curriculum ({{ $course->lessons->count() }} Lessons)
          </h3>
          <a href="{{ route('admin.curriculum', ['course_id' => $course->id]) }}" class="btn btn-outline btn-sm">
            <i data-lucide="plus"></i> Add Lessons in Builder
          </a>
        </div>

        @if ($course->lessons->isEmpty())
          <div style="text-align:center;padding:32px;color:var(--ink-400)">
            No lessons added yet. Use the Course Builder to add video lessons, PDF notes, and quizzes.
          </div>
        @else
          <div style="display:flex;flex-direction:column;gap:10px">
            @foreach ($course->lessons as $lesson)
              <div style="padding:14px 18px;border:1px solid var(--cream-200);border-radius:var(--radius-sm);background:var(--cream-50);display:flex;align-items:center;justify-content:space-between">
                <div>
                  <div style="font-weight:600;color:var(--ink-900);font-size:14px">
                    {{ $loop->iteration }}. {{ $lesson->title }}
                  </div>
                  <div class="small muted" style="margin-top:4px">
                    {{ $lesson->duration ?? 'Lesson' }} · 
                    <a href="{{ route('admin.lessons.notes.index', $lesson->slug) }}" style="color:var(--wine-700)">{{ $lesson->notes->count() }} notes</a> · 
                    <a href="{{ route('admin.lessons.quizzes.index', $lesson->slug) }}" style="color:var(--wine-700)">{{ $lesson->quizzes->count() }} quizzes</a>
                    @if ($lesson->is_free_preview)
                      <span class="badge badge-forest" style="margin-left:8px;font-size:10px">Free preview</span>
                    @endif
                  </div>
                </div>
                <div style="display:flex;gap:6px">
                  <a href="{{ route('admin.lessons.notes.index', $lesson->slug) }}" class="mini-btn" title="Manage Notes"><i data-lucide="file-text"></i></a>
                  <a href="{{ route('admin.lessons.quizzes.index', $lesson->slug) }}" class="mini-btn" title="Manage Quizzes"><i data-lucide="help-circle"></i></a>
                  <a href="{{ route('admin.lessons.edit', $lesson->slug) }}" class="mini-btn" title="Edit Lesson"><i data-lucide="pencil"></i></a>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>

    <!-- Right Column: Course Metadata -->
    <div>
      <div class="card" style="margin-bottom:24px;padding:22px">
        <h3 style="margin-top:0;margin-bottom:14px;font-size:16px;color:var(--wine-900)">Pricing Summary</h3>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200)">
          <span class="muted">Access Type</span>
          <b>{{ $course->type }}</b>
        </div>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200)">
          <span class="muted">Regular Price</span>
          <b>${{ number_format($course->price, 2) }}</b>
        </div>
        @if ($course->discount_price)
          <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200)">
            <span class="muted">Discount Price</span>
            <b style="color:var(--success)">${{ number_format($course->discount_price, 2) }}</b>
          </div>
        @endif
        <div style="display:flex;justify-content:space-between;padding:8px 0">
          <span class="muted">Active Students</span>
          <b>{{ $course->enrollments()->count() }} enrolled</b>
        </div>
      </div>

      <div class="card" style="margin-bottom:24px;padding:22px">
        <h3 style="margin-top:0;margin-bottom:14px;font-size:16px;color:var(--wine-900)">Course Cover</h3>
        <img src="{{ $course->thumbnail_url }}" alt="" style="width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:8px">
      </div>

      <div class="card" style="padding:22px">
        <h3 style="margin-top:0;margin-bottom:14px;font-size:16px;color:var(--wine-900)">Description</h3>
        <p style="font-size:13.6px;line-height:1.6;color:var(--ink-700)">
          {{ $course->short_description ?: 'No short description provided.' }}
        </p>
      </div>
    </div>
  </div>
@endsection
