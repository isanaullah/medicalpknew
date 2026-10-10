<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Binafy\LaravelCart\Cartable;

class Product extends Model implements Cartable
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'status',
    ];

    /**
     * Get the price of the product for cart
     */
    public function getPrice(): int
    {
        return $this->price; // Return price in paisa/cent (multiply by 100 if needed)
    }
}
