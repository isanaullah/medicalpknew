<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Course extends Model
{
    protected $fillable = [
        'course_category_id',
        'title',
        'slug',
        'image',
        'short_description',
        'description',
        'price',
        'discount_price',
        'duration_minutes',
        'level',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function chapters(): HasMany
    {
        // ✅ Order chapters by 'order' field first, then by ID
        return $this->hasMany(CourseChapter::class)
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'asc');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function getAverageRatingAttribute()
    {
        return $this->approvedReviews()->avg('rating') ?? 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->approvedReviews()->count();
    }
}
