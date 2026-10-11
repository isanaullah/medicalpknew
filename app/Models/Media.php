<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'name',
        'file_path',
        'mime_type',
        'file_size',
        'alt_text',
        'title',
        'description',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getUrlAttribute(): string
    {
        if (Str::startsWith($this->file_path, ['http://', 'https://'])) {
            return $this->file_path;
        }

        return Storage::disk('public')->url($this->file_path);
    }

    public function getIsImageAttribute(): bool
    {
        return Str::startsWith($this->mime_type ?? '', 'image/');
    }

    public function isImage(): bool
    {
        return $this->is_image;
    }

    public function getIconNameAttribute(): string
    {
        if ($this->is_image) return 'image';
        if (Str::contains($this->mime_type ?? '', 'pdf')) return 'file-text';
        if (Str::startsWith($this->mime_type ?? '', 'video/')) return 'video';
        return 'file';
    }

    public function getFormattedSizeAttribute(): string
    {
        if (!$this->file_size) {
            return '0 KB';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($this->file_size, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
