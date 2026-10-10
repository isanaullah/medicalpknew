<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'course_id',
        'item_type',
        'item_name',
        'item_slug',
        'item_image',
        'quantity',
        'price',
        'discount',
        'total',
        'notes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getItemImageUrlAttribute()
    {
        if ($this->item_image) {
            return asset('storage/' . $this->item_image);
        }
        return asset('images/default-course.jpg');
    }
}
