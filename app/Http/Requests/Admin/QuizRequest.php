<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('Super Admin') ?? false;
    }

    public function rules(): array
    {
        return [
            'lesson_id' => ['required', 'exists:lessons,id'],
            'title' => ['required', 'string', 'max:255'],
            'instructions' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'time_limit_minutes' => ['nullable', 'integer', 'min:0'],
            'passing_percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'attempt_limit' => ['required', 'integer', 'min:1'],
            'shuffle_questions' => ['nullable', 'boolean'],
            'show_results' => ['nullable', 'boolean'],
            'status' => ['required', 'in:Draft,Published'],
        ];
    }
}
