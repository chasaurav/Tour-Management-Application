<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'code',
        'title',
        'image',
        'rate',
        'nights',
        'days',
        'minPax',
        'tag',
        'status',
        'hotel',
        'trans',
        'meal',
        'sight',
        'description'
    ];
}
