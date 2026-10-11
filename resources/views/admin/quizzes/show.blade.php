@extends('layouts.admin')

@section('title', 'Quiz Builder: ' . $quiz->title . ' — Verdant Academy')
@section('page-title', 'Quiz Question Builder')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.courses') }}">Courses</a><span class="sep">/</span>
    <a href="{{ route('admin.curriculum', ['course_id' => $quiz->lesson->course->slug]) }}">Curriculum</a><span class="sep">/</span>
    <a href="{{ route('admin.lessons.quizzes.index', $quiz->lesson->slug) }}">Quizzes</a><span class="sep">/</span>
    <span>{{ $quiz->title }}</span>
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

  @if ($errors->any())
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:18px">
      <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="page-head">
    <div>
      <h1>{{ $quiz->title }}</h1>
      <p>
        Lesson: <b style="color:var(--wine-800)">{{ $quiz->lesson->title }}</b> · 
        Course: <b style="color:var(--wine-800)">{{ $quiz->lesson->course->title }}</b>
      </p>
    </div>
    <div style="display:flex;gap:10px">
      <a href="{{ route('admin.lessons.quizzes.index', $quiz->lesson->slug) }}" class="btn btn-outline">
        <i data-lucide="arrow-left"></i> Back to Quizzes
      </a>
      <button class="btn btn-primary" onclick="document.getElementById('modalAddQuestion').style.display='grid'">
        <i data-lucide="plus"></i> Add Question
      </button>
    </div>
  </div>

  <div class="grid" style="grid-template-columns:1fr 340px;gap:24px;align-items:start">
    <div>
      <!-- Questions List -->
      <div class="card" style="margin-bottom:24px;padding:24px">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:1px solid var(--cream-200);padding-bottom:12px">
          <h3 style="margin:0;font-size:18px;color:var(--wine-900)">
            Questions ({{ $quiz->questions->count() }})
          </h3>
          <span class="badge badge-amber" style="font-size:13px">
            Total Marks: <b>{{ $quiz->total_marks }} pts</b>
          </span>
        </div>

        @forelse ($quiz->questions as $index => $q)
          <div style="padding:18px;border:1px solid var(--cream-300);border-radius:var(--radius);margin-bottom:16px;background:var(--cream-50)">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:12px">
              <div style="display:flex;gap:12px">
                <span style="width:28px;height:28px;border-radius:6px;background:var(--wine-800);color:#fff;display:grid;place-items:center;font-size:12px;font-weight:700;flex:none">
                  {{ $index + 1 }}
                </span>
                <div>
                  <div style="font-weight:600;font-size:15px;color:var(--ink-900);line-height:1.4">
                    {{ $q->question_text }}
                  </div>
                  <div class="small muted" style="margin-top:4px">
                    Type: <b style="text-transform:capitalize">{{ str_replace('_', ' ', $q->question_type) }}</b> · 
                    Marks: <b style="color:var(--wine-800)">{{ $q->marks }} pt{{ $q->marks > 1 ? 's' : '' }}</b>
                  </div>
                </div>
              </div>

              <div style="display:flex;gap:6px">
                <button type="button" class="mini-btn danger" title="Delete Question" data-action="delete-row" data-name="Question #{{ $index + 1 }}: {{ addslashes(Str::limit($q->question_text, 35)) }}" data-url="{{ route('admin.quizzes.questions.destroy', $q->id) }}">
                  <i data-lucide="trash-2"></i>
                </button>
              </div>
            </div>

            <!-- Answer Options List -->
            <div style="display:flex;flex-direction:column;gap:8px;padding-left:40px">
              @foreach ($q->options as $opt)
                <div style="display:flex;align-items:center;gap:10px;padding:8px 12px;border-radius:6px;background:{{ $opt->is_correct ? 'var(--success-bg)' : '#fff' }};border:1px solid {{ $opt->is_correct ? '#cce1c4' : 'var(--cream-200)' }}">
                  @if ($opt->is_correct)
                    <i data-lucide="check-circle" style="width:16px;height:16px;color:var(--success);flex:none"></i>
                    <b style="font-size:13.5px;color:var(--success)">{{ $opt->option_text }} (Correct)</b>
                  @else
                    <i data-lucide="circle" style="width:16px;height:16px;color:var(--ink-400);flex:none"></i>
                    <span style="font-size:13.5px;color:var(--ink-700)">{{ $opt->option_text }}</span>
                  @endif
                </div>
              @endforeach

              @if ($q->explanation)
                <div style="margin-top:8px;font-size:12.6px;color:var(--ink-500);background:var(--cream-100);padding:8px 12px;border-radius:6px">
                  <b>Explanation:</b> {{ $q->explanation }}
                </div>
              @endif
            </div>
          </div>
        @empty
          <div style="text-align:center;padding:42px;color:var(--ink-400)">
            <i data-lucide="help-circle" style="width:40px;height:40px;margin-bottom:8px"></i>
            <p style="margin:0">No questions added to this quiz yet.</p>
            <button class="btn btn-outline btn-sm" style="margin-top:12px" onclick="document.getElementById('modalAddQuestion').style.display='grid'">
              <i data-lucide="plus"></i> Add First Question
            </button>
          </div>
        @endforelse
      </div>
    </div>

    <!-- Right Column: Quiz Info & Access Rules -->
    <div>
      <div class="card" style="margin-bottom:20px;padding:22px">
        <h3 style="margin-top:0;margin-bottom:14px;font-size:16px;color:var(--wine-900)">Quiz Summary</h3>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200);font-size:13.5px">
          <span class="muted">Time Limit</span>
          <b>{{ $quiz->time_limit_minutes ? $quiz->time_limit_minutes . ' min' : 'No limit' }}</b>
        </div>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200);font-size:13.5px">
          <span class="muted">Passing Score</span>
          <b>{{ $quiz->passing_percentage }}%</b>
        </div>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200);font-size:13.5px">
          <span class="muted">Total Marks</span>
          <b style="color:var(--wine-800)">{{ $quiz->total_marks }} pts</b>
        </div>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--cream-200);font-size:13.5px">
          <span class="muted">Attempt Limit</span>
          <b>{{ $quiz->attempt_limit }} attempt(s)</b>
        </div>
        <div style="display:flex;justify-content:space-between;padding:8px 0;font-size:13.5px">
          <span class="muted">Status</span>
          <span class="badge {{ $quiz->status === 'Published' ? 'badge-success' : 'badge-amber' }}">{{ $quiz->status }}</span>
        </div>
      </div>

      <div class="card" style="padding:20px;background:linear-gradient(135deg,var(--cream-0),var(--wine-50))">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
          <i data-lucide="lock" style="color:var(--wine-700);width:18px;height:18px"></i>
          <b style="color:var(--wine-900);font-size:14px">Quiz Access Authorization</b>
        </div>
        <p style="font-size:12.6px;color:var(--ink-500);line-height:1.55;margin:0">
          Quiz questions, options, and designated answers are strictly withheld on the backend until students hold an authorized course entitlement.
        </p>
      </div>
    </div>
  </div>

  <!-- Modal: Add Question (Standard Large 900px) -->
  <div class="modal-root" id="modalAddQuestion" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:900px;width:95%;box-shadow:var(--shadow-lg);max-height:90vh;overflow-y:auto">
      <form method="POST" action="{{ route('admin.quizzes.questions.store', $quiz->slug) }}">
        @csrf
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:18px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:18px;color:var(--wine-900)">Add Question</h3>
          <button type="button" class="close" onclick="document.getElementById('modalAddQuestion').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Question Type <span style="color:var(--danger)">*</span></label>
            <select class="select" name="question_type" id="questionTypeSelect" onchange="toggleQuestionType()">
              <option value="multiple_choice">Multiple Choice (Single correct answer)</option>
              <option value="true_false">True / False</option>
            </select>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Question Text <span style="color:var(--danger)">*</span></label>
            <textarea class="textarea" name="question_text" rows="3" required placeholder="Enter the question prompt here..."></textarea>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Marks / Points <span style="color:var(--danger)">*</span></label>
            <input class="input" type="number" min="1" name="marks" value="1" required style="max-width:140px">
          </div>

          <!-- Multiple Choice Options Container -->
          <div id="mcOptionsContainer" style="margin-bottom:16px">
            <label class="label">Answer Options (Select the designated correct answer)</label>
            <div id="optionsList" style="display:flex;flex-direction:column;gap:10px;margin-top:8px">
              <div style="display:flex;align-items:center;gap:10px">
                <input type="radio" name="correct_option" value="0" checked style="width:18px;height:18px">
                <input class="input" name="options[]" required placeholder="Option A">
              </div>
              <div style="display:flex;align-items:center;gap:10px">
                <input type="radio" name="correct_option" value="1" style="width:18px;height:18px">
                <input class="input" name="options[]" required placeholder="Option B">
              </div>
              <div style="display:flex;align-items:center;gap:10px">
                <input type="radio" name="correct_option" value="2" style="width:18px;height:18px">
                <input class="input" name="options[]" placeholder="Option C (optional)">
              </div>
              <div style="display:flex;align-items:center;gap:10px">
                <input type="radio" name="correct_option" value="3" style="width:18px;height:18px">
                <input class="input" name="options[]" placeholder="Option D (optional)">
              </div>
            </div>
          </div>

          <!-- True/False Container (Hidden by default) -->
          <div id="tfOptionsContainer" style="margin-bottom:16px;display:none">
            <label class="label">Designate Correct Answer</label>
            <div style="display:flex;gap:24px;margin-top:10px">
              <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                <input type="radio" name="tf_correct" value="0" checked style="width:18px;height:18px">
                <span style="font-weight:600">True</span>
              </label>
              <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                <input type="radio" name="tf_correct" value="1" style="width:18px;height:18px">
                <span style="font-weight:600">False</span>
              </label>
            </div>
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label">Explanation (Shown after review)</label>
            <textarea class="textarea" name="explanation" rows="2" placeholder="Explain why this answer is correct..."></textarea>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:16px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalAddQuestion').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="plus"></i> Add Question</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function toggleQuestionType() {
        const type = document.getElementById('questionTypeSelect').value;
        const mc = document.getElementById('mcOptionsContainer');
        const tf = document.getElementById('tfOptionsContainer');
        if (type === 'true_false') {
          mc.style.display = 'none';
          tf.style.display = 'block';
        } else {
          mc.style.display = 'block';
          tf.style.display = 'none';
        }
      }
    </script>
  @endpush
@endsection
