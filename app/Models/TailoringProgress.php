<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TailoringProgress extends Model
{
    protected $fillable = [
        'order_item_id',
        'status',
        'note',
        'updated_by'
    ];
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
