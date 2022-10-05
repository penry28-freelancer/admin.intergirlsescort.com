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
        'blacklist' => 50
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
    ]
];
