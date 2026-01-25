<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'size',
        'category',
        'image_url',
        'item_url',
        'is_public',
        'user_id',
    ];


    protected $casts = [
        'tags' => 'array',
        'price' => 'decimal:2',
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'item_room')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
