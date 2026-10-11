@extends('layouts.admin')

@section('title', 'Lessons & Curriculum — Verdant Academy')
@section('page-title', 'Lessons & Curriculum')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.courses') }}">Courses</a><span class="sep">/</span>
    <span>Curriculum Builder</span>
  </nav>

  @if (session('success'))
    <div style="padding:14px 18px;background:var(--success-bg);color:var(--success);border-radius:var(--radius);border:1px solid #cce1c4;margin-bottom:18px;display:flex;align-items:center;gap:10px">
      <i data-lucide="check-circle" style="width:18px;height:18px"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if (session('error'))
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:18px;display:flex;align-items:center;gap:10px">
      <i data-lucide="alert-circle" style="width:18px;height:18px"></i>
      <span>{{ session('error') }}</span>
    </div>
  @endif

  <div class="page-head" style="align-items:flex-end">
    <div>
      <h1>Lessons & Curriculum Builder</h1>
      <p>Organize lessons, PDF study notes, and quizzes for your courses.</p>
    </div>
    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap">
      <form method="GET" action="{{ route('admin.curriculum') }}" style="display:flex;align-items:center;gap:8px">
        <label for="courseSelector" style="font-size:13.5px;font-weight:600;color:var(--ink-700)">Select Course:</label>
        <select id="courseSelector" name="course_id" class="select" style="min-width:240px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
          @foreach ($courses as $c)
            <option value="{{ $c->slug }}" {{ $course && $course->id === $c->id ? 'selected' : '' }}>
              {{ $c->title }} ({{ $c->type }})
            </option>
          @endforeach
        </select>
      </form>

      @if ($course)
        <button class="btn btn-primary" onclick="openAddLessonModal({{ $course->id }})">
          <i data-lucide="plus"></i> Add Lesson
        </button>
      @endif
    </div>
  </div>

  @if (!$course)
    <div class="card" style="padding:48px;text-align:center">
      <i data-lucide="book-open" style="width:48px;height:48px;margin-bottom:12px;color:var(--ink-400)"></i>
      <h3 style="color:var(--wine-900)">No courses created yet</h3>
      <p class="muted">Create your first course to begin building curriculum lessons.</p>
      <a href="{{ route('admin.courses.create') }}" class="btn btn-primary" style="margin-top:14px">Create a Course</a>
    </div>
  @else
    <div class="grid" style="grid-template-columns:1fr 340px;gap:24px;align-items:start" id="curr-grid">
      <div>
        <div class="card" style="margin-bottom:24px;overflow:hidden">
          <div style="padding:18px 24px;background:var(--cream-50);border-bottom:1px solid var(--cream-300);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
            <div>
              <div style="font-size:16px;font-weight:700;color:var(--wine-900)">{{ $course->title }}</div>
              <div class="small muted" style="margin-top:3px">
                {{ $course->lessons->count() }} total lessons · {{ $course->type }} Course (${{ number_format($course->price, 2) }})
              </div>
            </div>
            <div>
              <span class="badge {{ $course->isPaid() ? 'badge-wine' : 'badge-forest' }}">{{ $course->type }}</span>
            </div>
          </div>

          <div>
            @forelse ($course->lessons as $lesson)
              <div style="display:flex;align-items:center;gap:14px;padding:16px 24px;border-bottom:1px solid var(--cream-200);background:#fff">
                <span style="width:28px;height:28px;border-radius:6px;background:var(--cream-200);color:var(--ink-700);display:grid;place-items:center;font-size:12px;font-weight:700;flex:none">
                  {{ $lesson->order ?: $loop->iteration }}
                </span>

                <div style="flex:1;min-width:0">
                  <div style="font-size:14.5px;color:var(--ink-900);font-weight:600">
                    {{ $lesson->title }}
                  </div>
                  <div class="small muted" style="margin-top:3px">
                    {{ $lesson->duration ?: 'Written lesson' }} · 
                    <a href="{{ route('admin.lessons.notes.index', $lesson->slug) }}" style="color:var(--wine-700);font-weight:600">
                      {{ $lesson->notes->count() }} PDF notes
                    </a> · 
                    <a href="{{ route('admin.lessons.quizzes.index', $lesson->slug) }}" style="color:var(--wine-700);font-weight:600">
                      {{ $lesson->quizzes->count() }} quizzes
                    </a>
                  </div>
                </div>

                @if ($lesson->is_free_preview)
                  <span class="badge badge-forest" style="font-size:11px">Free preview</span>
                @endif

                <span class="badge {{ $lesson->status === 'Published' ? 'badge-success' : 'badge-amber' }}" style="font-size:11px">
                  {{ $lesson->status }}
                </span>

                <div style="display:flex;gap:6px">
                  <a href="{{ route('admin.lessons.notes.index', $lesson->slug) }}" class="mini-btn" title="Manage PDF Notes">
                    <i data-lucide="file-text"></i>
                  </a>
                  <a href="{{ route('admin.lessons.quizzes.index', $lesson->slug) }}" class="mini-btn" title="Manage Quizzes">
                    <i data-lucide="help-circle"></i>
                  </a>
                  <button type="button" class="mini-btn" title="Edit Lesson" onclick="openEditLessonModal('{{ $lesson->slug }}', '{{ addslashes($lesson->title) }}', '{{ addslashes($lesson->slug) }}', '{{ addslashes($lesson->duration ?? '') }}', '{{ addslashes($lesson->video_url ?? '') }}', '{{ addslashes($lesson->description ?? '') }}', '{{ addslashes($lesson->content ?? '') }}', {{ $lesson->is_free_preview ? 'true' : 'false' }}, '{{ $lesson->status }}')">
                    <i data-lucide="pencil"></i>
                  </button>
                  <button type="button" class="mini-btn danger" title="Delete Lesson" data-action="delete-row" data-name="{{ $lesson->title }}" data-url="{{ route('admin.lessons.destroy', $lesson->slug) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </div>
            @empty
              <div style="padding:42px;text-align:center;color:var(--ink-400)">
                <i data-lucide="layers" style="width:36px;height:36px;margin-bottom:8px"></i>
                <p style="margin:0">No lessons added to this course yet.</p>
                <button class="btn btn-outline btn-sm" style="margin-top:12px" onclick="openAddLessonModal({{ $course->id }})">
                  <i data-lucide="plus"></i> Add First Lesson
                </button>
              </div>
            @endforelse
          </div>
        </div>
      </div>

      <!-- Right Column: Course Info -->
      <div>
        <div class="card" style="padding:22px;margin-bottom:24px">
          <h3 style="margin-top:0;margin-bottom:14px;font-size:16px;color:var(--wine-900)">Curriculum Overview</h3>
          <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200);font-size:13.5px">
            <span class="muted">Access Type</span>
            <b style="color:var(--wine-800)">{{ $course->type }}</b>
          </div>
          <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200);font-size:13.5px">
            <span class="muted">Total Lessons</span>
            <b>{{ $course->lessons->count() }}</b>
          </div>
          <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200);font-size:13.5px">
            <span class="muted">Free Previews</span>
            <b>{{ $course->lessons->where('is_free_preview', true)->count() }}</b>
          </div>
          <div style="display:flex;justify-content:space-between;padding:8px 0;font-size:13.5px">
            <span class="muted">Published Status</span>
            <b>{{ $course->status }}</b>
          </div>

          <div style="margin-top:18px;display:flex;flex-direction:column;gap:8px">
            <a href="{{ route('admin.courses.show', $course->slug) }}" class="btn btn-outline btn-sm" style="justify-content:center">
              <i data-lucide="eye"></i> View Course Details
            </a>
            <a href="{{ route('admin.courses.edit', $course->slug) }}" class="btn btn-outline btn-sm" style="justify-content:center">
              <i data-lucide="settings"></i> Edit Pricing & Preview Video
            </a>
          </div>
        </div>

        <div class="card" style="padding:20px;background:linear-gradient(135deg,var(--cream-0),var(--wine-50))">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
            <i data-lucide="shield-check" style="color:var(--wine-700);width:18px;height:18px"></i>
            <b style="color:var(--wine-900);font-size:14px">Content Protection</b>
          </div>
          <p style="font-size:12.6px;color:var(--ink-500);line-height:1.55;margin:0">
            For paid courses, all lessons, downloadable PDF notes, and quizzes remain strictly locked to visitors and unenrolled students. Only the course preview video can be played without purchasing.
          </p>
        </div>
      </div>
    </div>
  @endif

  <!-- Modal: Add Lesson (Standard Large 900px) -->
  <div class="modal-root" id="modalAddLesson" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:900px;width:95%;box-shadow:var(--shadow-lg);max-height:90vh;overflow-y:auto">
      <form method="POST" action="{{ route('admin.lessons.store') }}">
        @csrf
        <input type="hidden" name="course_id" id="addLessonCourseId" value="{{ $course?->id }}">

        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Add New Lesson</h3>
          <button type="button" class="close" onclick="document.getElementById('modalAddLesson').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Lesson Title <span style="color:var(--danger)">*</span></label>
            <input class="input" name="title" required placeholder="e.g. How the Web Actually Works">
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Duration</label>
              <input class="input" name="duration" placeholder="e.g. 15:30">
            </div>
            <div class="field">
              <label class="label">Status</label>
              <select class="select" name="status">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
              </select>
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Full Lesson Video URL (Optional)</label>
            <input class="input" name="video_url" placeholder="https://www.youtube.com/watch?v=... (or leave blank for written lesson)">
            <small class="muted">Written lessons can exist without a video.</small>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Lesson Short Description</label>
            <textarea class="textarea" name="description" rows="2" placeholder="Brief lesson outline"></textarea>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Lesson Written Content / Notes</label>
            <textarea class="textarea" name="content" rows="4" placeholder="Detailed lesson guide, instructions, or transcript"></textarea>
          </div>

          <div style="display:flex;align-items:center;gap:10px;padding-top:6px">
            <input type="checkbox" name="is_free_preview" id="chkFreePreviewAdd" value="1" style="width:18px;height:18px">
            <label for="chkFreePreviewAdd" style="font-weight:600;color:var(--ink-900);cursor:pointer">Free Preview Lesson (allow watching before buying)</label>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalAddLesson').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="plus"></i> Add Lesson</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Edit Lesson (Standard Large 900px) -->
  <div class="modal-root" id="modalEditLesson" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:900px;width:95%;box-shadow:var(--shadow-lg);max-height:90vh;overflow-y:auto">
      <form id="formEditLesson" method="POST" action="">
        @csrf
        @method('PUT')
        <input type="hidden" name="course_id" id="editLessonCourseId" value="{{ $course?->id }}">

        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Edit Lesson</h3>
          <button type="button" class="close" onclick="document.getElementById('modalEditLesson').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Lesson Title <span style="color:var(--danger)">*</span></label>
            <input class="input" id="editLessonTitle" name="title" required>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Duration</label>
              <input class="input" id="editLessonDuration" name="duration">
            </div>
            <div class="field">
              <label class="label">Status</label>
              <select class="select" id="editLessonStatus" name="status">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
              </select>
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Full Lesson Video URL (Optional)</label>
            <input class="input" id="editLessonVideoUrl" name="video_url">
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Lesson Description</label>
            <textarea class="textarea" id="editLessonDesc" name="description" rows="2"></textarea>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Lesson Written Content</label>
            <textarea class="textarea" id="editLessonContent" name="content" rows="4"></textarea>
          </div>

          <div style="display:flex;align-items:center;gap:10px;padding-top:6px">
            <input type="checkbox" name="is_free_preview" id="editLessonFreePreview" value="1" style="width:18px;height:18px">
            <label for="editLessonFreePreview" style="font-weight:600;color:var(--ink-900);cursor:pointer">Free Preview Lesson</label>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalEditLesson').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update Lesson</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function openAddLessonModal(courseId) {
        document.getElementById('addLessonCourseId').value = courseId;
        document.getElementById('modalAddLesson').style.display = 'grid';
        if (window.lucide) { lucide.createIcons(); }
      }

      function openEditLessonModal(slug, title, displaySlug, duration, videoUrl, desc, content, isFree, status) {
        const form = document.getElementById('formEditLesson');
        form.action = `/admin/lessons/${slug}`;
        document.getElementById('editLessonTitle').value = title;
        document.getElementById('editLessonDuration').value = duration;
        document.getElementById('editLessonVideoUrl').value = videoUrl;
        document.getElementById('editLessonDesc').value = desc;
        document.getElementById('editLessonContent').value = content;
        document.getElementById('editLessonFreePreview').checked = isFree;
        document.getElementById('editLessonStatus').value = status;
        document.getElementById('modalEditLesson').style.display = 'grid';
        if (window.lucide) { lucide.createIcons(); }
      }
    </script>
  @endpush
@endsection
