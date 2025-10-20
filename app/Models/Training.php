<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $casts = [
        'date_from' => 'datetime:Y-M-d',
        'date_to' => 'datetime:Y-m-d',
    ];
}
