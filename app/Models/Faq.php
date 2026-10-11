<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'slug',
        'question',
        'answer',
        'order',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($faq) {
            if (empty($faq->slug)) {
                $base = Str::slug(Str::limit($faq->question, 40, '')) ?: 'faq';
                $slug = $base;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $count++;
                }
                $faq->slug = $slug;
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
            'order' => 'integer',
        ];
    }
}
