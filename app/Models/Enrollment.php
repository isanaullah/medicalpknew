<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'order_id',
        'enrollment_number',
        'status',
        'progress',
        'enrolled_at',
        'completed_at',
        'expires_at',
    ];

    protected $casts = [
        'progress' => 'integer',
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getStatusBadgeAttribute()
    {
        $colors = [
            'active' => 'success',
            'completed' => 'primary',
            'cancelled' => 'danger',
            'expired' => 'warning',
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    public function getProgressPercentageAttribute()
    {
        return $this->progress . '%';
    }

    public function getEnrollmentDateAttribute()
    {
        return $this->enrolled_at ? $this->enrolled_at->format('M d, Y') : 'N/A';
    }
}
