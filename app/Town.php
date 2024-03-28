<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'state',
        'county',
        'city',
        'name',
        'postcode',
        'half_postcode',
        'latitude',
        'longitude',
        'wik_url',
        'country_url',
        'state_url',
        'county_url',
        'city_url',
        'postcode_url',
        'slug'
    ];
}
