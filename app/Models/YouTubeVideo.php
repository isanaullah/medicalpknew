<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class YouTubeVideo extends Model
{
    use HasFactory, SoftDeletes;
 protected $table = 'youtube_videos';
    protected $fillable = [
        'title',
        'slug',
        'video_url',
        'video_id',
        'subject',
        'thumbnail',
        'views',
        'order',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the embed URL for the video
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->video_id) {
            return 'https://www.youtube.com/embed/' . $this->video_id . '?rel=0&modestbranding=1&iv_load_policy=3';
        }

        // Extract video ID from URL
        $videoId = $this->extractVideoId($this->video_url);
        if ($videoId) {
            return 'https://www.youtube.com/embed/' . $videoId . '?rel=0&modestbranding=1&iv_load_policy=3';
        }

        return $this->video_url;
    }

    /**
     * Extract YouTube video ID from URL
     */
    public function extractVideoId($url)
    {
        $patterns = [
            '/youtube\.com\/watch\?v=([^&]+)/',
            '/youtu\.be\/([^?]+)/',
            '/youtube\.com\/embed\/([^?]+)/',
            '/m\.youtube\.com\/watch\?v=([^&]+)/'
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return explode('?', $matches[1])[0];
            }
        }
        return null;
    }

    /**
     * Get subject color gradient
     */
    public function getGradientAttribute()
    {
        $gradients = [
            'Chemistry' => 'from-[#1e3a8a] to-[#2563eb]',
            'Biology' => 'from-[#065f46] to-[#0d9488]',
            'Physics' => 'from-[#7c2d12] to-[#dc2626]',
            'English' => 'from-[#831843] to-[#be185d]',
            'MDCAT' => 'from-[#0891B2] to-[#2563EB]',
            'NUMS' => 'from-[#059669] to-[#0891B2]',
            'ECAT' => 'from-[#D97706] to-[#EA580C]',
            'Logical Reasoning' => 'from-[#7C3AED] to-[#6D28D9]',
        ];

        return $gradients[$this->subject] ?? 'from-[#2563EB] to-[#4338CA]';
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/youtube/' . $this->thumbnail);
        }

        // Get YouTube thumbnail
        if ($this->video_id) {
            return 'https://img.youtube.com/vi/' . $this->video_id . '/hqdefault.jpg';
        }

        return null;
    }
}
