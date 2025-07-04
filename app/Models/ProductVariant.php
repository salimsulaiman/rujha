<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'price_per_meter',
        'stock_in_meter'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'variant_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
