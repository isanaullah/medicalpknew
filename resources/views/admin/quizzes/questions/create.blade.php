@extends('layouts.admin')

@section('title', 'Add Question: ' . $quiz->title . ' — Verdant Academy')
@section('page-title', 'Add Quiz Question')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.courses') }}">Courses</a><span class="sep">/</span>
    <a href="{{ route('admin.curriculum', ['course_id' => $quiz->lesson->course->slug]) }}">Curriculum</a><span class="sep">/</span>
    <a href="{{ route('admin.quizzes.show', $quiz->slug) }}">{{ $quiz->title }}</a><span class="sep">/</span>
    <span>Add Question</span>
  </nav>

  <div class="page-head">
    <div>
      <h1>Add Question to {{ $quiz->title }}</h1>
      <p>Configure multiple choice or true/false question with designated answer options.</p>
    </div>
    <div>
      <a href="{{ route('admin.quizzes.show', $quiz->slug) }}" class="btn btn-outline">
        <i data-lucide="arrow-left"></i> Back to Quiz
      </a>
    </div>
  </div>

  <div class="card" style="max-width:900px;margin:0 auto;padding:28px">
    <form method="POST" action="{{ route('admin.quizzes.questions.store', $quiz->slug) }}">
      @csrf

      <div class="field" style="margin-bottom:18px">
        <label class="label">Question Type <span style="color:var(--danger)">*</span></label>
        <select class="select" name="question_type" id="questionTypeSelect" onchange="toggleQuestionType()">
          <option value="multiple_choice">Multiple Choice (Single correct answer)</option>
          <option value="true_false">True / False</option>
        </select>
      </div>

      <div class="field" style="margin-bottom:18px">
        <label class="label">Question Text <span style="color:var(--danger)">*</span></label>
        <textarea class="textarea" name="question_text" rows="3" required placeholder="Enter the question prompt here..."></textarea>
      </div>

      <div class="field" style="margin-bottom:18px">
        <label class="label">Marks / Points <span style="color:var(--danger)">*</span></label>
        <input class="input" type="number" min="1" name="marks" value="1" required style="max-width:140px">
      </div>

      <div id="mcOptionsContainer" style="margin-bottom:18px">
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

      <div id="tfOptionsContainer" style="margin-bottom:18px;display:none">
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

      <div class="field" style="margin-bottom:24px">
        <label class="label">Explanation (Shown upon review)</label>
        <textarea class="textarea" name="explanation" rows="2" placeholder="Explain why this answer is correct..."></textarea>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:12px;border-top:1px solid var(--cream-200);padding-top:18px">
        <a href="{{ route('admin.quizzes.show', $quiz->slug) }}" class="btn btn-ghost">Cancel</a>
        <button type="submit" class="btn btn-primary"><i data-lucide="plus"></i> Save Question</button>
      </div>
    </form>
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
