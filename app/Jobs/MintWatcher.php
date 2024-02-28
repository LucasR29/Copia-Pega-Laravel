<?php

namespace App\Jobs;

use App\Events\MintEvent;
use App\Jobs\Traits\ProviderRequests;
use App\Models\CollectionItem;
use App\Models\WatcherBlockNumber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MintWatcher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ProviderRequests;

    public $timeout = 30;

    protected $collection;

    /**
     * Create a new job instance.
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::debug('Getting logs from Polygon');
        Log::debug($this->collection);

        $collection_track = WatcherBlockNumber::where('collection_id', $this->collection->id)
        ->where('watcher_name', 'mint')
        ->first();

        if(!$collection_track) {
            return;
        }

        $address = $collection_track->address;
        $fromBlock = $collection_track->block_number;

        $logs = $this->getLogs($address, $fromBlock, 'mint');

        foreach($logs['logs'] as $log) {
            $item = new CollectionItem(
                [
                    'collection_id' => $this->collection->id,
                    'token_id' => $log['topics'][2],
                    'description' => $this->collection->description,
                    'image_url' => $this->collection->image_url,
                    'available' => true,
                    'name'=> $this->collection->name,
                ]
            );

            MintEvent::dispatch($item);
        }

        WatcherBlockNumber::where('collection_id', $this->collection->id)
        ->where('watcher_name', 'mint')
        ->update(['block_number' => $logs['toBlock']]);
    }
}
