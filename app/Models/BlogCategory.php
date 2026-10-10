<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'page_title',
        'meta_desc',
        'title',
        'slug',
        'image',
        'description',
        'views_count',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'views_count' => 'integer',
    ];

    public function articles()
    {
        return $this->hasMany(BlogArticle::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && $this->image != 'blog/category/no_img.jpg') {
            return asset('storage/' . $this->image);
        }
        return asset('storage/blog/category/no_img.jpg');
    }
}
