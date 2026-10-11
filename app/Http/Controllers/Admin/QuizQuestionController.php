<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuizQuestionRequest;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('admin.quizzes.questions.create', compact('quiz'));
    }

    public function store(QuizQuestionRequest $request, Quiz $quiz)
    {
        $data = $request->validated();

        $maxOrder = QuizQuestion::where('quiz_id', $quiz->id)->max('order') ?? 0;

        $question = QuizQuestion::create([
            'quiz_id' => $quiz->id,
            'question_text' => $data['question_text'],
            'question_type' => $data['question_type'],
            'marks' => $data['marks'],
            'order' => $data['order'] ?? ($maxOrder + 1),
            'explanation' => $data['explanation'] ?? null,
        ]);

        $correctIndex = (int) $data['correct_option'];

        foreach ($data['options'] as $idx => $optText) {
            QuizQuestionOption::create([
                'quiz_question_id' => $question->id,
                'option_text' => $optText,
                'is_correct' => ($idx === $correctIndex),
                'order' => $idx + 1,
            ]);
        }

        $quiz->recalculateTotalMarks();

        return redirect()->route('admin.quizzes.show', $quiz->slug)
            ->with('success', 'Question added successfully.');
    }

    public function edit(QuizQuestion $question)
    {
        $question->load('options');
        $quiz = $question->quiz;
        return view('admin.quizzes.questions.edit', compact('question', 'quiz'));
    }

    public function update(QuizQuestionRequest $request, QuizQuestion $question)
    {
        $data = $request->validated();
        $quiz = $question->quiz;

        $question->update([
            'question_text' => $data['question_text'],
            'question_type' => $data['question_type'],
            'marks' => $data['marks'],
            'order' => $data['order'] ?? $question->order,
            'explanation' => $data['explanation'] ?? null,
        ]);

        // Re-create options
        $question->options()->delete();
        $correctIndex = (int) $data['correct_option'];

        foreach ($data['options'] as $idx => $optText) {
            QuizQuestionOption::create([
                'quiz_question_id' => $question->id,
                'option_text' => $optText,
                'is_correct' => ($idx === $correctIndex),
                'order' => $idx + 1,
            ]);
        }

        $quiz->recalculateTotalMarks();

        return redirect()->route('admin.quizzes.show', $quiz->slug)
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(QuizQuestion $question)
    {
        $quiz = $question->quiz;
        $question->delete();
        $quiz->recalculateTotalMarks();

        return redirect()->route('admin.quizzes.show', $quiz->slug)
            ->with('success', 'Question deleted successfully.');
    }
}
