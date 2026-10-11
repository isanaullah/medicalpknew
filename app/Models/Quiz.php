<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Str;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'slug',
        'instructions',
        'description',
        'time_limit_minutes',
        'passing_percentage',
        'total_marks',
        'attempt_limit',
        'shuffle_questions',
        'show_results',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($quiz) {
            if (empty($quiz->slug)) {
                $base = Str::slug($quiz->title) ?: 'quiz';
                $slug = $base;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $count++;
                }
                $quiz->slug = $slug;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $field = $field ?? $this->getRouteKeyName();
        $query = $this->where($field, $value);
        if (is_numeric($value)) {
            $query->orWhere('id', $value);
        }
        return $query->firstOrFail();
    }

    protected function casts(): array
    {
        return [
            'time_limit_minutes' => 'integer',
            'passing_percentage' => 'integer',
            'total_marks' => 'integer',
            'attempt_limit' => 'integer',
            'shuffle_questions' => 'boolean',
            'show_results' => 'boolean',
        ];
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('order', 'asc');
    }

    public function recalculateTotalMarks(): void
    {
        $this->total_marks = $this->questions()->sum('marks');
        $this->save();
    }
}
