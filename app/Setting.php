<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_description',
        'logo',
        'favicon',
        'email',
        'phone',
        'site_meta_tags',
        'site_meta_description',
        'user_schema',
        'single_schema',
        'home_h1',
        'home_h2',
        'home_h3',

        'country_meta_title',
        'state_meta_title',
        'county_meta_title',
        'city_meta_title',
        'town_meta_title',

        'country_meta',
        'state_meta',
        'county_meta',
        'city_meta',
        'town_meta',
        'copyright',
        'pushover',
        'permissions_area',
        'h1_variable',
        'mail_subject',
        'google_ads_tag'
    ];

}
