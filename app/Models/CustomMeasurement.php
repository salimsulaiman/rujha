<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomMeasurement extends Model
{
    protected $fillable = [
        'order_item_id',
        'chest',
        'waist',
        'hip',
        'body_length',
        'sleve_length'
    ];
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
