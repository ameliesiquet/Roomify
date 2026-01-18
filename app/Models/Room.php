<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'budget',
        'spent',
        'colors',
        'notes',
        'todo_list',
        'is_example',
    ];

    protected $casts = [
        'colors' => 'array',
        'todo_list' => 'array',
        'is_example' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

}
