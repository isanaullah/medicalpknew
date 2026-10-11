@extends('layouts.admin')

@section('title', 'Edit Course: ' . $course->title . ' — Verdant Academy')
@section('page-title', 'Edit Course')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.courses') }}">Courses</a><span class="sep">/</span>
    <span>Edit</span>
  </nav>

  <div class="page-head">
    <div>
      <h1>Edit Course: {{ $course->title }}</h1>
      <p>Modify course access, pricing, preview video, and content.</p>
    </div>
    <div style="display:flex;gap:9px">
      <a href="{{ route('admin.curriculum', ['course_id' => $course->slug]) }}" class="btn btn-outline">
        <i data-lucide="layers"></i> Manage Curriculum
      </a>
      <a href="{{ route('admin.courses.show', $course->slug) }}" class="btn btn-outline">
        <i data-lucide="eye"></i> View Course
      </a>
      <a href="{{ route('admin.courses') }}" class="btn btn-outline">
        <i data-lucide="arrow-left"></i> Back to courses
      </a>
    </div>
  </div>

  @if ($errors->any())
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:24px">
      <b style="display:block;margin-bottom:6px">Please fix the following errors:</b>
      <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.courses.update', $course->slug) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Section 1: Basic Information -->
    <div class="card" style="margin-bottom:24px;padding:24px">
      <h3 style="font-size:18px;color:var(--wine-900);margin-top:0;margin-bottom:16px;border-bottom:1px solid var(--cream-200);padding-bottom:10px">
        1. Course Identity & Classification
      </h3>
      
      <div class="field" style="margin-bottom:16px">
        <label class="label">Course Title <span style="color:var(--danger)">*</span></label>
        <input class="input" name="title" required value="{{ old('title', $course->title) }}">
      </div>

      <div class="field" style="margin-bottom:16px">
        <label class="label">Slug</label>
        <input class="input" name="slug" value="{{ old('slug', $course->slug) }}">
      </div>

      <div class="grid g2 gap-sm" style="gap:16px;margin-bottom:16px">
        <div class="field">
          <label class="label">Category (Optional)</label>
          <select class="select" name="category_id">
            <option value="">-- No Category (Uncategorized) --</option>
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id', $course->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="field">
          <label class="label">Course Level <span style="color:var(--danger)">*</span></label>
          <select class="select" name="level" required>
            <option value="Beginner" {{ old('level', $course->level) === 'Beginner' ? 'selected' : '' }}>Beginner</option>
            <option value="Intermediate" {{ old('level', $course->level) === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
            <option value="Advanced" {{ old('level', $course->level) === 'Advanced' ? 'selected' : '' }}>Advanced</option>
          </select>
        </div>
      </div>

      <div class="grid g2 gap-sm" style="gap:16px">
        <div class="field">
          <label class="label">Course Language <span style="color:var(--danger)">*</span></label>
          <input class="input" name="language" required value="{{ old('language', $course->language) }}">
        </div>

        <div class="field">
          <label class="label">Estimated Duration</label>
          <input class="input" name="duration" value="{{ old('duration', $course->duration) }}">
        </div>
      </div>
    </div>

    <!-- Section 2: Free & Paid System -->
    <div class="card" style="margin-bottom:24px;padding:24px">
      <h3 style="font-size:18px;color:var(--wine-900);margin-top:0;margin-bottom:16px;border-bottom:1px solid var(--cream-200);padding-bottom:10px">
        2. Pricing & Enrollment Access Model
      </h3>
      
      <div class="field" style="margin-bottom:18px">
        <label class="label">Course Type <span style="color:var(--danger)">*</span></label>
        <div style="display:flex;gap:24px;margin-top:8px">
          <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:600">
            <input type="radio" name="type" value="Free" id="typeFree" {{ old('type', $course->type) === 'Free' ? 'checked' : '' }} onchange="togglePricingFields()">
            <span class="badge badge-forest" style="padding:6px 14px;font-size:13px">Free Course ($0.00)</span>
          </label>
          <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-weight:600">
            <input type="radio" name="type" value="Paid" id="typePaid" {{ old('type', $course->type) === 'Paid' ? 'checked' : '' }} onchange="togglePricingFields()">
            <span class="badge badge-wine" style="padding:6px 14px;font-size:13px">Paid Course</span>
          </label>
        </div>
      </div>

      <div id="pricingRow" class="grid g2 gap-sm" style="gap:16px;display:{{ old('type', $course->type) === 'Paid' ? 'grid' : 'none' }}">
        <div class="field">
          <label class="label">Regular Price (USD) <span style="color:var(--danger)">*</span></label>
          <input class="input" type="number" step="0.01" name="price" id="inputPrice" value="{{ old('price', $course->price) }}">
        </div>

        <div class="field">
          <label class="label">Optional Discount Price (USD)</label>
          <input class="input" type="number" step="0.01" name="discount_price" id="inputDiscount" value="{{ old('discount_price', $course->discount_price) }}">
        </div>
      </div>
    </div>

    <!-- Section 3: Media & Preview Video -->
    <div class="card" style="margin-bottom:24px;padding:24px">
      <h3 style="font-size:18px;color:var(--wine-900);margin-top:0;margin-bottom:16px;border-bottom:1px solid var(--cream-200);padding-bottom:10px">
        3. Media & Course Preview Video
      </h3>

      <div class="field" style="margin-bottom:16px">
        <label class="label">Course Thumbnail Image</label>
        @if ($course->thumbnail)
          <div style="display:flex;align-items:center;gap:14px;margin-bottom:10px">
            <img src="{{ $course->thumbnail_url }}" alt="Thumbnail" style="width:120px;height:70px;object-fit:cover;border-radius:8px">
            <label style="display:flex;align-items:center;gap:6px;font-size:13px;color:var(--danger);cursor:pointer">
              <input type="checkbox" name="remove_thumbnail" value="1"> Remove current thumbnail
            </label>
          </div>
        @endif
        <input type="file" name="thumbnail_file" class="input" accept="image/*">
        <small class="muted">Replace thumbnail: PNG, JPG, or WEBP up to 5 MB.</small>
      </div>

      <div class="field" style="margin-bottom:16px">
        <label class="label">Preview Video URL (YouTube, Vimeo, or Hosted Video)</label>
        <input class="input" name="preview_video_url" id="previewVideoUrl" value="{{ old('preview_video_url', $course->preview_video_url) }}" oninput="updatePreviewPlayer()">
      </div>

      <div class="field" style="margin-bottom:16px">
        <label class="label">Or Upload Direct Preview Video File</label>
        @if ($course->preview_video_path)
          <div style="margin-bottom:8px">
            <span class="badge badge-success">Custom video uploaded: {{ basename($course->preview_video_path) }}</span>
            <label style="display:inline-flex;align-items:center;gap:6px;font-size:13px;color:var(--danger);margin-left:12px;cursor:pointer">
              <input type="checkbox" name="remove_preview_video" value="1"> Remove preview video
            </label>
          </div>
        @endif
        <input type="file" name="preview_video_file" class="input" accept="video/mp4,video/webm">
      </div>

      <!-- Live Player in Form -->
      <div id="videoPreviewContainer" style="display:none;margin-top:16px;background:var(--wine-950);border-radius:var(--radius);padding:14px;color:#fff">
        <div style="font-size:13px;font-weight:600;margin-bottom:8px;color:var(--mustard-400)">Preview Video Player:</div>
        <div id="playerFrame" style="aspect-ratio:16/9;max-height:280px;background:#000;border-radius:8px;overflow:hidden"></div>
      </div>
    </div>

    <!-- Section 4: Descriptions & Curriculum -->
    <div class="card" style="margin-bottom:24px;padding:24px">
      <h3 style="font-size:18px;color:var(--wine-900);margin-top:0;margin-bottom:16px;border-bottom:1px solid var(--cream-200);padding-bottom:10px">
        4. Curriculum Overview & Learning Details
      </h3>

      <div class="field" style="margin-bottom:16px">
        <label class="label">Short Description</label>
        <textarea class="textarea" name="short_description" rows="2">{{ old('short_description', $course->short_description) }}</textarea>
      </div>

      <div class="field" style="margin-bottom:16px">
        <label class="label">Full Course Description</label>
        <textarea class="textarea" name="description" rows="5">{{ old('description', $course->description) }}</textarea>
      </div>

      <div class="field" style="margin-bottom:16px">
        <label class="label">Learning Objectives (One per line)</label>
        <textarea class="textarea" name="learning_objectives" rows="3">{{ old('learning_objectives', $course->learning_objectives) }}</textarea>
      </div>

      <div class="field" style="margin-bottom:0">
        <label class="label">Prerequisites (One per line)</label>
        <textarea class="textarea" name="prerequisites" rows="2">{{ old('prerequisites', $course->prerequisites) }}</textarea>
      </div>
    </div>

    <!-- Section 5: Publication & Settings -->
    <div class="card" style="margin-bottom:24px;padding:24px">
      <h3 style="font-size:18px;color:var(--wine-900);margin-top:0;margin-bottom:16px;border-bottom:1px solid var(--cream-200);padding-bottom:10px">
        5. Publication Status
      </h3>

      <div class="grid g2 gap-sm" style="gap:16px;align-items:center">
        <div class="field" style="margin:0">
          <label class="label">Status</label>
          <select class="select" name="status">
            <option value="Draft" {{ old('status', $course->status) === 'Draft' ? 'selected' : '' }}>Draft</option>
            <option value="Published" {{ old('status', $course->status) === 'Published' ? 'selected' : '' }}>Published</option>
            <option value="Archived" {{ old('status', $course->status) === 'Archived' ? 'selected' : '' }}>Archived</option>
          </select>
        </div>

        <div style="display:flex;align-items:center;gap:10px;padding-top:18px">
          <input type="checkbox" name="is_featured" id="chkFeatured" value="1" {{ old('is_featured', $course->is_featured) ? 'checked' : '' }} style="width:18px;height:18px">
          <label for="chkFeatured" style="font-weight:600;color:var(--ink-900);cursor:pointer">Feature this course on homepage</label>
        </div>
      </div>
    </div>

    <div style="display:flex;justify-content:flex-end;gap:12px;margin-bottom:48px">
      <a href="{{ route('admin.courses') }}" class="btn btn-ghost">Cancel</a>
      <button type="submit" class="btn btn-primary">
        <i data-lucide="check"></i> Update Course
      </button>
    </div>
  </form>

  @push('scripts')
    <script>
      function togglePricingFields() {
        const isPaid = document.getElementById('typePaid').checked;
        const pricingRow = document.getElementById('pricingRow');
        const inputPrice = document.getElementById('inputPrice');
        const inputDiscount = document.getElementById('inputDiscount');
        if (isPaid) {
          pricingRow.style.display = 'grid';
          if (!inputPrice.value || inputPrice.value === '0' || inputPrice.value === '0.00') {
            inputPrice.value = '89.00';
          }
        } else {
          pricingRow.style.display = 'none';
          inputPrice.value = '0.00';
          inputDiscount.value = '';
        }
      }

      function updatePreviewPlayer() {
        const url = document.getElementById('previewVideoUrl').value.trim();
        const container = document.getElementById('videoPreviewContainer');
        const frame = document.getElementById('playerFrame');
        if (!url) {
          container.style.display = 'none';
          frame.innerHTML = '';
          return;
        }

        let embedUrl = null;
        if (url.includes('youtube.com/watch?v=')) {
          const v = url.split('v=')[1]?.split('&')[0];
          if (v) embedUrl = 'https://www.youtube.com/embed/' + v;
        } else if (url.includes('youtu.be/')) {
          const v = url.split('youtu.be/')[1]?.split('?')[0];
          if (v) embedUrl = 'https://www.youtube.com/embed/' + v;
        } else if (url.includes('vimeo.com/')) {
          const v = url.split('vimeo.com/')[1]?.split('?')[0];
          if (v) embedUrl = 'https://player.vimeo.com/video/' + v;
        }

        if (embedUrl) {
          container.style.display = 'block';
          frame.innerHTML = `<iframe src="${embedUrl}" style="width:100%;height:100%;border:none" allowfullscreen></iframe>`;
        } else {
          container.style.display = 'none';
        }
      }

      document.addEventListener('DOMContentLoaded', () => {
        togglePricingFields();
        updatePreviewPlayer();
      });
    </script>
  @endpush
@endsection
