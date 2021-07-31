<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'type_identification',
        'identification',
        'phone',
        'email',
        'sex',
        'city_id',
        'birthday',
        'address'
    ];
}
