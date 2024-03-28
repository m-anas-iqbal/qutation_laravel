<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSchema extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'text'
    ];

}
