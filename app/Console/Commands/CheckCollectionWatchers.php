<?php

namespace App\Console\Commands;

use App\Models\Collection;
use App\Models\WatcherBlockNumber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckCollectionWatchers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-collection-watchers';

    protected $watchers_name = [
        'mint'
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $collections = Collection::with('watcher_block_number')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'address' => $item->address,
                'watcher_name' => $item->watcher_block_number->pluck('watcher_name')
            ];
        });

        foreach ($collections as $collection) {
            foreach($this->watchers_name as $watcher_name) {
                if (!$collection['watcher_name']->contains($watcher_name)) {
                    WatcherBlockNumber::create([
                        'watcher_name' => $watcher_name,
                        'collection_id' => $collection['id'],
                        'address' => $collection['address'],
                        'block_number' => '0'
                    ]);
                }
            }
        }
    }
}
