<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait ProviderRequests
{
    public $url = 'https://polygon-mumbai.infura.io/v3/3ed770669de449cdb904f374c46f1a1d';

    private $events = $events;

    public function getLogs($fromBlock, $toBlock)
    {
        $this->blockNumber = $this->getBlockNumber();
        $blockRange = 100000;
        $fromBlock = 0;
        $toBlock = $fromBlock + $blockRange;

        Log::debug('Getting logs from Polygon');

        $params = [
            'jsonrpc' => '2.0',
            'method' => 'eth_getLogs',
            'params' => [[
                'address' => '0x45fBfA3Cbb6E401364Ee7BB6bB5470ACc2a32f02',
                'fromBlock' => '0x' . dechex($fromBlock),
                'toBlock' => '0x' . dechex($toBlock),
                'events' => [
                    $this->events['mint'],
                ],
            ]],
            'id' => 1
            ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post($this->url, $params);

        Log::debug('Response: ' . $response);
        Log::debug(json_encode($params));

        // foreach ($collections as $collection) {

        // }
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

        return $response['result'];
    }
}


$events = [
    'mint' => [
        'name' => 'Mint',
        'inputs' => [
            [
                'type' => 'address',
                'indexed' => true,
                'name' => '_receiver'
            ],
            [
                'type' => 'uint256',
                'indexed' => true,
                'name' => '_tokenId'
            ],
            [
                'type' => 'address',
                'indexed' => true,
                'name' => '_minter'
            ]
        ],
    ]
];
