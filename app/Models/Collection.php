<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *ss
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'image_url',
        'slug',
        'type',
        'chain_id'
    ];
}
