<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'name',
        'county',
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
