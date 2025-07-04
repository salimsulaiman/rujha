<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [
        'variant_id',
        'size_label',
        'estimated_meter',
        'available'
    ];
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
