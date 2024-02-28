<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class MintListener extends BaseListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Log::debug('Mint Event' . json_encode($event));
    }
}
