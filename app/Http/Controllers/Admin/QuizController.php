<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuizRequest;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Lesson $lesson)
    {
        $quizzes = $lesson->quizzes()->withCount('questions')->latest()->get();
        return view('admin.quizzes.index', compact('lesson', 'quizzes'));
    }

    public function create(Lesson $lesson)
    {
        return view('admin.quizzes.create', compact('lesson'));
    }

    public function store(QuizRequest $request)
    {
        $data = $request->validated();
        $data['shuffle_questions'] = $request->boolean('shuffle_questions');
        $data['show_results'] = $request->boolean('show_results');

        $quiz = Quiz::create($data);

        return redirect()->route('admin.quizzes.show', $quiz->slug)
            ->with('success', "Quiz '{$quiz->title}' created. You can now add questions.");
    }

    public function show(Quiz $quiz)
    {
        $quiz->load(['lesson.course', 'questions.options']);
        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $lesson = $quiz->lesson;
        return view('admin.quizzes.edit', compact('quiz', 'lesson'));
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $data = $request->validated();
        $data['shuffle_questions'] = $request->boolean('shuffle_questions');
        $data['show_results'] = $request->boolean('show_results');

        $quiz->update($data);

        return redirect()->route('admin.quizzes.show', $quiz->slug)
            ->with('success', "Quiz '{$quiz->title}' updated successfully.");
    }

    public function destroy(Quiz $quiz)
    {
        $lessonSlug = $quiz->lesson->slug;
        $quiz->delete();

        return redirect()->route('admin.lessons.quizzes.index', $lessonSlug)
            ->with('success', 'Quiz deleted successfully.');
    }
}
