<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'phone',
        'address'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
