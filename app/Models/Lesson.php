<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'description',
        'content',
        'video_url',
        'thumbnail',
        'order',
        'duration',
        'status',
        'is_free_preview',
    ];

    protected function casts(): array
    {
        return [
            'is_free_preview' => 'boolean',
            'order' => 'integer',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($lesson) {
            if (empty($lesson->slug)) {
                $lesson->slug = Str::slug($lesson->title);
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

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(LessonNote::class)->orderBy('order', 'asc');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
