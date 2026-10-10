<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'city',
        'state',
        'country',
        'zip_code',
        'subtotal',
        'discount',
        'tax',
        'shipping_charge',
        'total',
        'payment_method',
        'payment_status',
        'order_status',
        'payment_proof',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'shipping_charge' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function getStatusBadgeAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            'refunded' => 'secondary',
        ];
        return $colors[$this->order_status] ?? 'secondary';
    }

    public function getPaymentStatusBadgeAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'paid' => 'success',
            'failed' => 'danger',
            'refunded' => 'secondary',
        ];
        return $colors[$this->payment_status] ?? 'secondary';
    }

    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof) {
            return asset('storage/payment_proofs/' . $this->payment_proof);
        }
        return null;
    }

    public function processEnrollment()
    {
        if ($this->order_status !== 'completed') {
            return false;
        }

        $user = $this->user;
        if (!$user) {
            return false;
        }

        foreach ($this->items as $item) {
            $existingEnrollment = Enrollment::where('user_id', $user->id)
                ->where('course_id', $item->course_id)
                ->first();

            if (!$existingEnrollment && $item->course_id) {
                Enrollment::create([
                    'user_id' => $user->id,
                    'course_id' => $item->course_id,
                    'order_id' => $this->id,
                    'enrollment_number' => Enrollment::generateEnrollmentNumber(),
                    'status' => 'active',
                    'progress' => 0,
                    'enrolled_at' => now(),
                    'expires_at' => now()->addYear(),
                ]);
            }
        }

        return true;
    }
}
