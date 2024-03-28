<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'state',
        'name',
        'city',
        'town',
        'postcode',
        'half_postcode',
        'latitude',
        'longitude',
        'wik_url',
        'slug'
    ];
}
