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
        ],
        'key' => [
            'male'   => 1,
            'female' => 2,
            'lgbt'   => 3,
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
];
