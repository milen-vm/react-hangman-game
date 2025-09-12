<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'experience_technology');
    }
}
