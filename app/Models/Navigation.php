<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'route', 'icon', 'order', 'parent_id', 'hide'
    ];

    protected $casts = [
        'hide' => 'boolean'
    ];

    public function parent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function children() 
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    } 

    public static function tree() 
    {
        return static::with(implode('.', array_fill(0, 3, 'children')))
            ->where('parent_id', '=', NULL)
            ->where('hide', false)
            ->orderBy('order')
            ->get();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function canAccess($userId): bool
    {
        return (bool) $this->users()->where('user_id', $userId)->count() > 0;
    }
}
