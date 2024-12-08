<?php

return [
    'name' => 'RestrictIP',

    /*
     |--------------------------------------------------------------------------
     | restrict mode
     |--------------------------------------------------------------------------
     |
     | by changing restrict mode, behavior of application will change
     | #blacklist : block all IPs but those are in the white_ip array
     | #whitelist : all IPs are allowed but those are in the black_ip array
     | blocked Ips are redirected to
     |
     */
    'restrict_mode'=>'blacklist',

    'redirect'=>null,

    /*
      |--------------------------------------------------------------------------
      | White list
      |--------------------------------------------------------------------------
      |
      | this list are IPs which can access the app and send and get data
      | to allow every on except black list leave this empty
      |
      |
      */

    "white_ip"=>[
         //'127.0.0.1', #example
        //  ['127.0.0.1','127.0.1.3'], #example
        //  '172.16.176.129'
    ],

    /*
    |--------------------------------------------------------------------------
    | Black list
    |--------------------------------------------------------------------------
    |
    | this list are IPs which can con not access the app and send and get data
    | to allow every one leave this empty
    |
    |
    */


    "black_ip"=>[
        // '127.0.0.1', #example
        //   ['127.0.0.1','127.0.1.3'], #example
        //  '172.16.176.129'
    ],
];
