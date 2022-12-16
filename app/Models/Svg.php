<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Svg extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'tags', 'scripts'];

    protected $casts = [
        'tags' => 'array'
    ];
}
