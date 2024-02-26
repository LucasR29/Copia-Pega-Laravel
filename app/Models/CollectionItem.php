<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'token_id',
        'description',
        'image_url',
        'collection_id',
        'total_items',
        'claimed_items',
        'available',
        'benefits'
    ];
}
