<?php

const EVENTS = [
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
