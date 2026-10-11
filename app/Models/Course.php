<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'thumbnail',
        'category_id',
        'level',
        'language',
        'instructor_id',
        'duration',
        'learning_objectives',
        'prerequisites',
        'type',
        'price',
        'discount_price',
        'preview_video_url',
        'preview_video_path',
        'preview_video_thumbnail',
        'status',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'is_featured' => 'boolean',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order', 'asc');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot(['status', 'payment_status', 'payment_amount', 'enrolled_at', 'expires_at'])
            ->withTimestamps();
    }

    public function isFree(): bool
    {
        return $this->type === 'Free';
    }

    public function isPaid(): bool
    {
        return $this->type === 'Paid';
    }

    public function getEffectivePriceAttribute(): float
    {
        if ($this->isFree()) {
            return 0.00;
        }

        if ($this->discount_price !== null && (float)$this->discount_price > 0 && (float)$this->discount_price < (float)$this->price) {
            return (float)$this->discount_price;
        }

        return (float)$this->price;
    }

    public function getPreviewVideoSourceAttribute(): ?string
    {
        if (!empty($this->preview_video_url)) {
            return $this->preview_video_url;
        }

        if (!empty($this->preview_video_path)) {
            return Storage::disk('public')->url($this->preview_video_path);
        }

        return null;
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                return $this->thumbnail;
            }
            return Storage::disk('public')->url($this->thumbnail);
        }

        return 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=70';
    }
}
