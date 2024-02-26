<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'slug',
        'brand_id',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }
}
