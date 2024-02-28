<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collection extends BaseModel
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
        'chain_id',
        'campaign_id'
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function collection_item(): HasMany
    {
        return $this->hasMany(CollectionItem::class);
    }

    public function watcher_block_number(): HasMany
    {
        return $this->hasMany(WatcherBlockNumber::class);
    }
}
