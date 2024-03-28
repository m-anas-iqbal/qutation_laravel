<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = [
    	'recipient_mail',
    	'recipient_name'
    ];
}
