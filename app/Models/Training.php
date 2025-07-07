<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'start_date',
        'end_date',
        'thumbnail',
        'excerpt',
        'status',
        'price'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
