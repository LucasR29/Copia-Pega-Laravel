<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatcherBlockNumber extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'watcher_name',
        'collection_id',
        'address',
        'block_number',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
