<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'host', 'port', 'protocol', 'username', 'password', 'active'];

    protected $casts = [
        'active' => 'boolean'
    ];
}
