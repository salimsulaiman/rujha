<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'size_id',
        'quantity',
        'requested_meter',
        'custom_size_note',
        'custom_size_hash',
        'notes',
    ];

    protected static function booted()
    {
        static::saving(function ($item) {
            $item->custom_size_hash = $item->custom_size_note
                ? hash('sha256', Str::limit($item->custom_size_note, 1000)) // limit untuk jaga performa
                : null;
        });
    }

    // Relasi ke cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke varian produk
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    // Relasi ke ukuran produk
    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }
}
