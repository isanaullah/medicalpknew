@extends('layouts.admin')

@section('title', 'Edit Question — Verdant Academy')
@section('page-title', 'Edit Quiz Question')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.courses') }}">Courses</a><span class="sep">/</span>
    <a href="{{ route('admin.curriculum', ['course_id' => $quiz->lesson->course->slug]) }}">Curriculum</a><span class="sep">/</span>
    <a href="{{ route('admin.quizzes.show', $quiz->slug) }}">{{ $quiz->title }}</a><span class="sep">/</span>
    <span>Edit Question</span>
  </nav>

  <div class="page-head">
    <div>
      <h1>Edit Question</h1>
      <p>Quiz: <b style="color:var(--wine-800)">{{ $quiz->title }}</b></p>
    </div>
    <div>
      <a href="{{ route('admin.quizzes.show', $quiz->slug) }}" class="btn btn-outline">
        <i data-lucide="arrow-left"></i> Back to Quiz
      </a>
    </div>
  </div>

  <div class="card" style="max-width:900px;margin:0 auto;padding:28px">
    <form method="POST" action="{{ route('admin.quizzes.questions.update', $question->id) }}">
      @csrf
      @method('PUT')

      <div class="field" style="margin-bottom:18px">
        <label class="label">Question Type <span style="color:var(--danger)">*</span></label>
        <select class="select" name="question_type" id="questionTypeSelect">
          <option value="multiple_choice" {{ $question->question_type === 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
          <option value="true_false" {{ $question->question_type === 'true_false' ? 'selected' : '' }}>True / False</option>
        </select>
      </div>

      <div class="field" style="margin-bottom:18px">
        <label class="label">Question Text <span style="color:var(--danger)">*</span></label>
        <textarea class="textarea" name="question_text" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
      </div>

      <div class="field" style="margin-bottom:18px">
        <label class="label">Marks / Points <span style="color:var(--danger)">*</span></label>
        <input class="input" type="number" min="1" name="marks" value="{{ old('marks', $question->marks) }}" required style="max-width:140px">
      </div>

      <div id="mcOptionsContainer" style="margin-bottom:18px">
        <label class="label">Answer Options (Select correct answer)</label>
        <div id="optionsList" style="display:flex;flex-direction:column;gap:10px;margin-top:8px">
          @foreach ($question->options as $idx => $opt)
            <div style="display:flex;align-items:center;gap:10px">
              <input type="radio" name="correct_option" value="{{ $idx }}" {{ $opt->is_correct ? 'checked' : '' }} style="width:18px;height:18px">
              <input class="input" name="options[]" required value="{{ $opt->option_text }}">
            </div>
          @endforeach
        </div>
      </div>

      <div class="field" style="margin-bottom:24px">
        <label class="label">Explanation</label>
        <textarea class="textarea" name="explanation" rows="2">{{ old('explanation', $question->explanation) }}</textarea>
      </div>

      <div style="display:flex;justify-content:flex-end;gap:12px;border-top:1px solid var(--cream-200);padding-top:18px">
        <a href="{{ route('admin.quizzes.show', $quiz->slug) }}" class="btn btn-ghost">Cancel</a>
        <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update Question</button>
      </div>
    </form>
  </div>
@endsection
