<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id',
    ];

    // Relasi: Cart milik satu customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi: Cart memiliki banyak item
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
