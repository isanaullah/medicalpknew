<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_page_id',
        'section_key',
        'title',
        'subtitle',
        'description',
        'body',
        'config',
        'image',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'config' => 'array',
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(WebsitePage::class, 'website_page_id');
    }

    /**
     * Helper to safely retrieve nested config data
     */
    public function config(string $key, $default = null)
    {
        return data_get($this->config, $key, $default);
    }
}
