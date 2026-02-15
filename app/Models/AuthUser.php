<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AuthUser extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email', 'password', 'name',
    ];

    protected $table = 'auth_users';
}
