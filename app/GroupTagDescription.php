<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTagDescription extends Model
{
    use HasFactory;

    protected $fillable=[
        'service_category_id',
        'group_id',
        'description'
    ];
}
