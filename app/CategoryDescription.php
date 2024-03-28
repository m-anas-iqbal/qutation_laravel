<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    use HasFactory;

    protected $fillable=[
        'service_area',
        'service_area_values',
        'description',
        'tag_description',
    ];
}
