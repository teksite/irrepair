<?php
return [
    'admin_prefix' => 'tkadmin',
    'panel_prefix' => 'panel',
    'auth_prefix' => 'auth',

    'start_date' => '2020-02-02 00:00', //Carbon date format

    'sitemap' => 'index', //index, single, auto
    'otp_duration' => 15, //minutes
    'otp_length' => 5,

    'user_social_items' => [
        'phone',
        'address',
        'whatsapp',
        'linkedin',
        'telegram',
        'instagram',
        'wikipedia',
        'facebook',
        'twitter',
        'skype',
        'about me'
    ],

    'comment_email_notification' => [
        'sina.zangiband@gmail.com'
    ],
    'comment_edit_until' => 120 , //min
    'comment_delete_until' => 120, //min


    'captcha'=>env('ENABLE_CAPTCHA' ,true),
    'form_ajax'=>env('ENABLE_FORM_AJAX' ,true),

    'shop'=>[
        'cart_title'=>'default'
    ]
];
