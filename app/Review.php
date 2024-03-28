<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'company_name',
        'title',
        'description',
        'name',
        'email',
        'phone',
        'value',
        'recommend',
    ];
}
