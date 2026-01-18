<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'price',
        'size',
        'image_url',
        'description',
        'link',
        'tags'
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
