<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Campaign extends BaseModel
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

    public function collections(): HasOne
    {
        return $this->hasOne(Collection::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
