<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
        );
    }
}
