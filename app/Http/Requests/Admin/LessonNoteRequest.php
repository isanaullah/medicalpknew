<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LessonNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('Super Admin') ?? false;
    }

    public function rules(): array
    {
        $isCreate = $this->isMethod('post');

        return [
            'lesson_id' => ['required', 'exists:lessons,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'pdf_file' => [$isCreate ? 'required' : 'nullable', 'file', 'mimes:pdf', 'max:20480'],
            'order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:Active,Inactive'],
        ];
    }
}
