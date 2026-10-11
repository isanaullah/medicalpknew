@extends('layouts.admin')

@section('title', 'Quizzes: ' . $lesson->title . ' — Verdant Academy')
@section('page-title', 'Lesson Quizzes')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.courses') }}">Courses</a><span class="sep">/</span>
    <a href="{{ route('admin.curriculum', ['course_id' => $lesson->course->slug]) }}">Curriculum</a><span class="sep">/</span>
    <span>{{ $lesson->title }} Quizzes</span>
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

  <div class="page-head">
    <div>
      <h1>Lesson Quizzes: {{ $lesson->title }}</h1>
      <p>Course: <b style="color:var(--wine-800)">{{ $lesson->course->title }}</b> · {{ $quizzes->count() }} quizzes configured</p>
    </div>
    <div style="display:flex;gap:10px">
      <a href="{{ route('admin.curriculum', ['course_id' => $lesson->course->slug]) }}" class="btn btn-outline">
        <i data-lucide="arrow-left"></i> Back to Curriculum
      </a>
      <button class="btn btn-primary" onclick="document.getElementById('modalAddQuiz').style.display='grid'">
        <i data-lucide="plus"></i> Create Quiz
      </button>
    </div>
  </div>

  <div class="table-wrap">
    <div class="table-scroll">
      <table class="tbl">
        <thead>
          <tr>
            <th>Quiz Title</th>
            <th>Questions</th>
            <th>Total Marks</th>
            <th>Time Limit</th>
            <th>Pass %</th>
            <th>Status</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($quizzes as $quiz)
            <tr>
              <td>
                <div class="cell-main">
                  <div class="stat-icon" style="width:38px;height:38px;border-radius:8px;background:var(--wine-50);color:var(--wine-700);border:1px solid var(--wine-200)">
                    <i data-lucide="help-circle"></i>
                  </div>
                  <div>
                    <div class="t">
                      <a href="{{ route('admin.quizzes.show', $quiz->slug) }}" style="text-decoration:none;color:inherit;font-weight:600">
                        {{ $quiz->title }}
                      </a>
                    </div>
                    <div class="s">/{{ $quiz->slug }}</div>
                  </div>
                </div>
              </td>
              <td><b>{{ $quiz->questions_count }}</b> questions</td>
              <td><b>{{ $quiz->total_marks }}</b> pts</td>
              <td>{{ $quiz->time_limit_minutes ? $quiz->time_limit_minutes . ' mins' : 'No limit' }}</td>
              <td>{{ $quiz->passing_percentage }}%</td>
              <td>
                <span class="badge {{ $quiz->status === 'Published' ? 'badge-success' : 'badge-amber' }}">
                  {{ $quiz->status }}
                </span>
              </td>
              <td>
                <div class="row-actions">
                  <a href="{{ route('admin.quizzes.show', $quiz->slug) }}" class="mini-btn" title="Open Quiz Builder & Questions">
                    <i data-lucide="layers"></i>
                  </a>
                  <button type="button" class="mini-btn" title="Edit Quiz Settings" onclick="openEditQuizModal('{{ $quiz->slug }}', '{{ addslashes($quiz->title) }}', '{{ addslashes($quiz->slug) }}', '{{ addslashes($quiz->instructions ?? '') }}', '{{ addslashes($quiz->description ?? '') }}', {{ $quiz->time_limit_minutes }}, {{ $quiz->passing_percentage }}, {{ $quiz->attempt_limit }}, {{ $quiz->shuffle_questions ? 'true' : 'false' }}, {{ $quiz->show_results ? 'true' : 'false' }}, '{{ $quiz->status }}')">
                    <i data-lucide="pencil"></i>
                  </button>
                  <button type="button" class="mini-btn danger" title="Delete Quiz" data-action="delete-row" data-name="{{ $quiz->title }}" data-url="{{ route('admin.quizzes.destroy', $quiz->slug) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align:center;padding:36px;color:var(--ink-400)">
                <i data-lucide="help-circle" style="width:36px;height:36px;margin-bottom:8px"></i>
                <p style="margin:0">No quizzes configured for this lesson yet.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal: Add Quiz (Standard 850px) -->
  <div class="modal-root" id="modalAddQuiz" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:850px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form method="POST" action="{{ route('admin.quizzes.store') }}">
        @csrf
        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Create New Quiz</h3>
          <button type="button" class="close" onclick="document.getElementById('modalAddQuiz').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Quiz Title <span style="color:var(--danger)">*</span></label>
            <input class="input" name="title" required placeholder="e.g. Chapter Knowledge Check">
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Slug (optional)</label>
            <input class="input" name="slug" placeholder="e.g. chapter-knowledge-check (leave blank to auto-generate)">
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Time Limit (Minutes)</label>
              <input class="input" type="number" min="0" name="time_limit_minutes" value="15" placeholder="0 = no limit">
            </div>
            <div class="field">
              <label class="label">Passing Percentage (%) <span style="color:var(--danger)">*</span></label>
              <input class="input" type="number" min="1" max="100" name="passing_percentage" required value="70">
            </div>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Attempt Limit</label>
              <input class="input" type="number" min="1" name="attempt_limit" value="2">
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
            <label class="label">Instructions for Students</label>
            <textarea class="textarea" name="instructions" rows="2" placeholder="e.g. Select the single best answer for each question."></textarea>
          </div>

          <div style="display:flex;gap:20px;padding-top:4px">
            <label style="display:flex;align-items:center;gap:8px;font-size:13.5px;cursor:pointer">
              <input type="checkbox" name="shuffle_questions" value="1"> Shuffle Questions
            </label>
            <label style="display:flex;align-items:center;gap:8px;font-size:13.5px;cursor:pointer">
              <input type="checkbox" name="show_results" value="1" checked> Show Results Upon Completion
            </label>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalAddQuiz').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="plus"></i> Create Quiz</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Edit Quiz Settings (Standard 850px) -->
  <div class="modal-root" id="modalEditQuiz" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:850px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form id="formEditQuiz" method="POST" action="">
        @csrf
        @method('PUT')
        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Edit Quiz Settings</h3>
          <button type="button" class="close" onclick="document.getElementById('modalEditQuiz').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Quiz Title <span style="color:var(--danger)">*</span></label>
            <input class="input" id="editQuizTitle" name="title" required>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Slug</label>
            <input class="input" id="editQuizSlug" name="slug">
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Time Limit (Minutes)</label>
              <input class="input" type="number" min="0" id="editQuizTime" name="time_limit_minutes">
            </div>
            <div class="field">
              <label class="label">Passing Percentage (%) <span style="color:var(--danger)">*</span></label>
              <input class="input" type="number" min="1" max="100" id="editQuizPass" name="passing_percentage" required>
            </div>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Attempt Limit</label>
              <input class="input" type="number" min="1" id="editQuizAttempt" name="attempt_limit">
            </div>
            <div class="field">
              <label class="label">Status</label>
              <select class="select" id="editQuizStatus" name="status">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
              </select>
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Instructions</label>
            <textarea class="textarea" id="editQuizInstructions" name="instructions" rows="2"></textarea>
          </div>

          <div style="display:flex;gap:20px;padding-top:4px">
            <label style="display:flex;align-items:center;gap:8px;font-size:13.5px;cursor:pointer">
              <input type="checkbox" id="editQuizShuffle" name="shuffle_questions" value="1"> Shuffle Questions
            </label>
            <label style="display:flex;align-items:center;gap:8px;font-size:13.5px;cursor:pointer">
              <input type="checkbox" id="editQuizShowResults" name="show_results" value="1"> Show Results
            </label>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalEditQuiz').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update Quiz</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function openEditQuizModal(slug, title, displaySlug, instr, desc, time, pass, attempt, shuffle, showResults, status) {
        const form = document.getElementById('formEditQuiz');
        form.action = `/admin/quizzes/${slug}`;
        document.getElementById('editQuizTitle').value = title;
        document.getElementById('editQuizSlug').value = displaySlug;
        document.getElementById('editQuizInstructions').value = instr;
        document.getElementById('editQuizTime').value = time;
        document.getElementById('editQuizPass').value = pass;
        document.getElementById('editQuizAttempt').value = attempt;
        document.getElementById('editQuizShuffle').checked = shuffle;
        document.getElementById('editQuizShowResults').checked = showResults;
        document.getElementById('editQuizStatus').value = status;
        document.getElementById('modalEditQuiz').style.display = 'grid';
        if (window.lucide) { lucide.createIcons(); }
      }
    </script>
  @endpush
@endsection
