<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_business_id',
        'user_id',
        'name',
        'email',
        'phone',
        'postcode',
        'description',
        'job_status'
    ];
}
