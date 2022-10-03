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
        'limit' => 20
    ],

    /*
    |-------------------------------------------------
    | Define constant for sex
    |-------------------------------------------------
     */
    'sex' => [
        'label' => [
            1 => 'Nam',
            2 => 'Nữ',
            3 => 'LGBT',
            4 => 'couple',
            5 => 'dou',
        ],
        'key' => [
            'male'    => 1,
            'female'  => 2,
            'lgbt'    => 3,
            'couple'  => 4,
            'duo'     => 5,
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
    ]
];
