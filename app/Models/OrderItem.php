<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'size_id',
        'custom_size_note',
        'quantity',
        'requested_meter',
        'subtotal_price',
        'notes'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function progress()
    {
        return $this->hasOne(TailoringProgress::class);
    }

    public function measurement()
    {
        return $this->hasOne(CustomMeasurement::class);
    }
}
