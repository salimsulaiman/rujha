<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $fillable = [
        'product_variant_id',
        'image'
    ];
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
