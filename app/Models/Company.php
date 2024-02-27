<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    public function brand(): HasMany
    {
        return $this->hasMany(Brand::class);
    }
}
