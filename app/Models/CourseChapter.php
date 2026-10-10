<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseChapter extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'description',
        'order',
        'video_url',
        'duration_minutes',
        'is_free_preview',
        'status',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function notes(): HasMany
    {
        // ✅ Order notes by 'order' or 'id' (lowest to highest)
        return $this->hasMany(ChapterNote::class)
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'asc');
    }

    // ✅ Add default scope for chapters
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }
}
