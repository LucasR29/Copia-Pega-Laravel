<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollectionItem extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'token_id',
        'description',
        'image_url',
        'collection_id',
        'available',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
