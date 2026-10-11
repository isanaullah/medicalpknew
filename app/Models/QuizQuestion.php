<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type', // multiple_choice, true_false
        'marks',
        'order',
        'explanation',
    ];

    protected function casts(): array
    {
        return [
            'marks' => 'integer',
            'order' => 'integer',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($question) {
            $question->quiz?->recalculateTotalMarks();
        });

        static::deleted(function ($question) {
            $question->quiz?->recalculateTotalMarks();
        });
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuizQuestionOption::class)->orderBy('order', 'asc');
    }

    public function correctOption()
    {
        return $this->options()->where('is_correct', true)->first();
    }
}
