<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'company_id'
    ];

    public function campaign(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
