<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ChapterNote extends Model
{
    protected $fillable = [
        'course_chapter_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'file_path',
        'file_url',
        'file_size',
        'mime_type',
        'video_url',
        'video_duration',
        'type',
        'order',
        'is_free_preview',
        'views_count',
        'downloads_count',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(CourseChapter::class, 'course_chapter_id');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }
}
