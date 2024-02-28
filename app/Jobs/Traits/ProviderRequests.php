<?php

namespace App\Jobs\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait ProviderRequests
{
    public $url = 'https://polygon-mumbai.infura.io/v3/3ed770669de449cdb904f374c46f1a1d';

    public function getLogs($address, $fromBlock, $event)
    {
        Log::debug('Getting logs from Polygon');

        $this->blockNumber = $this->getBlockNumber();
        $blockRange = 10_000_000;
        $toBlock = $fromBlock + $blockRange > $this->blockNumber ? $this->blockNumber : $fromBlock + $blockRange;

        Log::error($toBlock);

        $params = [
            'jsonrpc' => '2.0',
            'method' => 'eth_getLogs',
            'params' => [[
                'address' => $address,
                'fromBlock' => '0x' . dechex($fromBlock),
                'toBlock' => '0x' . dechex($toBlock),
                'events' => [
                   EVENTS[$event],
                ],
            ]],
            'id' => 1
            ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post($this->url, $params);

        return ['logs' => $response['result'], 'toBlock' => $toBlock];
    }

    public function getBlockNumber()
    {
        $params = [
            'jsonrpc' => '2.0',
            'method' => 'eth_blockNumber',
            'params' => [],
            'id' => 1
            ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post($this->url, $params);

        $blockNumber = hexdec(substr($response['result'], 2));

        return $blockNumber;
    }
}
