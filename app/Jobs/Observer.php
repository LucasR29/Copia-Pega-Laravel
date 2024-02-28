<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Jobs\Traits\ProviderRequests;

class Observer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ProviderRequests;

    public $timeout = 30;

    public $blockNumber;

    protected $collection;

    /**
     * Create a new job instance.
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
        $this->blockNumber = $this->getBlockNumber();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::debug('Getting logs from Polygon');
        Log::debug($this->collection);

        $address = $this->collection->address;
        $fromBlock = $this->collection->fromBlock;
        $toBlock = $this->collection->toBlock;

        $blockRange = 100000;

        $this->getLogs($address, $fromBlock, 'mint');
    }
}
