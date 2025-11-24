<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'workers';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'age',
        'description',
        'is_married'
    ];
}
