<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'state',
        'county',
        'name',
        'town',
        'postcode',
        'half_postcode',
        'latitude',
        'longitude',
        'wik_url',
        'slug'
    ];
}
