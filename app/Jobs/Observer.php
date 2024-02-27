<?php

namespace App\Jobs;

use App\Models\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use ProviderRequests;

extension_loaded('bcmath') or die('bcmath extension not available');

class Observer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ProviderRequests;

    private $url = 'https://polygon-mumbai.infura.io/v3/3ed770669de449cdb904f374c46f1a1d';

    public $timeout = 30;

    public $blockNumber = $this->getBlockNumber();

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $collections = Collection::all();
        $blockRange = 100000;

        foreach ($collections as $collection) {
            $this->getLogs($collection->fromBlock, $collection->toBlock);
        }
    }
}
