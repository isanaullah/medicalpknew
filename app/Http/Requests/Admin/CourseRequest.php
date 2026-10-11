<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('Super Admin') ?? false;
    }

    protected function prepareForValidation()
    {
        if ($this->input('type') === 'Free') {
            $this->merge([
                'price' => 0.00,
                'discount_price' => null,
            ]);
        }
    }

    public function rules(): array
    {
        $courseId = $this->route('course')?->id ?? $this->route('course');
        $isPaid = $this->input('type') === 'Paid';

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('courses', 'slug')->ignore($courseId)],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'level' => ['required', 'in:Beginner,Intermediate,Advanced'],
            'language' => ['required', 'string', 'max:100'],
            'instructor_id' => ['nullable', 'exists:users,id'],
            'duration' => ['nullable', 'string', 'max:100'],
            'learning_objectives' => ['nullable', 'string'],
            'prerequisites' => ['nullable', 'string'],
            'type' => ['required', 'in:Free,Paid'],
            'price' => [
                'required',
                'numeric',
                $isPaid ? 'min:0.01' : 'in:0,0.00',
            ],
            'discount_price' => [
                'nullable',
                'numeric',
                'min:0.01',
                $isPaid ? 'lt:price' : 'prohibited',
            ],
            'preview_video_url' => ['nullable', 'url', 'max:500'],
            'preview_video_file' => ['nullable', 'file', 'mimes:mp4,mov,avi,webm', 'max:51200'],
            'status' => ['required', 'in:Draft,Published,Archived'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'price.min' => 'Paid courses must have a price greater than 0.00.',
            'price.in' => 'Free courses must have a price of 0.00.',
            'discount_price.lt' => 'Discount price must be lower than the regular course price.',
            'discount_price.min' => 'Discount price must be a positive amount.',
        ];
    }
}
