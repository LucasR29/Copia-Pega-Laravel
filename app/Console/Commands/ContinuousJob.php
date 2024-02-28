<?php

namespace App\Console\Commands;

use App\Jobs\MintWatcher;
use App\Jobs\Observer;
use App\Models\Collection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ContinuousJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'continuous:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Continuous Job';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $collections = Collection::all();

        Log::debug($collections);

        foreach ($collections as $collection) {
            MintWatcher::dispatch($collection);
        }
    }
}

