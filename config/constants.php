<?php

return [
    /*
    |-------------------------------------------------
    | Define constant for Decentralization
    |-------------------------------------------------
     */
    'module_access' => [
        1 => 'Super Admin',
        2 => 'Platform',
        3 => 'Merchant',
        4 => 'Common'
    ],

    /*
    |-------------------------------------------------
    | Define constant for Pagination
    |-------------------------------------------------
     */
    'pagination' => [
        'limit' => 20,
        'escort' => 250,
        'tour' => 50,
        'review' => 20,
        'blacklist' => 50,
        'video' => 50,
        'club'  => 18
    ],

    /*
    |-------------------------------------------------
    | Define constant for sex
    |-------------------------------------------------
     */
    'sex' => [
        'label' => [
            1 => 'man',
            2 => 'woman',
            3 => 'trans',
            4 => 'couple',
            5 => 'dou',
        ],
        'key' => [
            'man'    => 1,
            'woman'  => 2,
            'trans'  => 3,
            'couple' => 4,
            'duo'    => 5,
        ],
    ],

    // Type of FAQ
    'faq_type' => [
        'label' => [
            1 => 'escort',
            2 => 'members',
        ],
        'key' => [
            'escort'  => 1,
            'members' => 2,
        ],
    ],
    'pages_content_key' => [
        'about' => 1,
        'policy_conditions' => 2
    ],
    'verified' => [
        'false' => 0,
        'true' => 1,
    ],
    'pornstar' => [
        'yes'   => 1,
        'no'    => 0,
    ],
    'report' => [
        'agency' => 1,
        'escost' => 2,
        'client' => 3,
    ],
    'age' => [
        'min' => 18,
        'max' => 100
    ],
    'rate' => [
        'min' => 20,
        'max' => 15249
    ],

    'account_type' => [
        'model' => [
            1 => \App\Models\Escort::class,
            2 => \App\Models\Agency::class,
            3 => \App\Models\Club::class,
            4 => \App\Models\Member::class,
            5 => \App\Models\Account::class,
        ],
        'key' => [
            'escort' => 1,
            'agency' => 2,
            'club'   => 3,
            'member' => 4,
            'account' => 5
        ]
    ]
];
