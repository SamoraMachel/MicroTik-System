<?php

return [

     //Specify the environment mpesa is running, sandbox or production
     'mpesa_env' => env('MPESA_ENV','sandbox'),
    /*-----------------------------------------
    |The App consumer key
    |------------------------------------------
    */
    'consumer_key'   => env('CONSUMER_KEY'),

    /*-----------------------------------------
    |The App consumer Secret
    |------------------------------------------
    */
    'consumer_secret' => env('CONSUMER_SECRET'),

    /*-----------------------------------------
    |The paybill number
    |------------------------------------------
    */
    'paybill'         => env('PAYBILL', null),

    /*-----------------------------------------
    |Lipa Na Mpesa Online Shortcode
    |------------------------------------------
    */
    'lipa_na_mpesa'  => env('TILL_NUMBER', null),

    /*-----------------------------------------
    |Lipa Na Mpesa Online Passkey
    |------------------------------------------
    */
    'lipa_na_mpesa_passkey' => env('PASS_KEY'),

    /*-----------------------------------------
    |Initiator Username.
    |------------------------------------------
    */
    'initiator_username' => env('INITIATOR_USERNAME'),

    /*-----------------------------------------
    |Initiator Password
    |------------------------------------------
    */
    'initiator_password' => env('INITIATOR_PASSWORD'),

    /*-----------------------------------------
    |Test phone Number
    |------------------------------------------
    */
    'test_msisdn ' => env('TEST_MSISDN', null),

    /*-----------------------------------------
    |Lipa na Mpesa Online callback url
    |------------------------------------------
    */
    'lnmocallback' => env('APP_URL').'/'.env('STK_CALLBACK'),

     /*-----------------------------------------
    |C2B  Validation url
    |------------------------------------------
    */
    'c2b_validate_callback' => '',

    /*-----------------------------------------
    |C2B confirmation url
    |------------------------------------------
    */
    'c2b_confirm_callback' => '',

    /*-----------------------------------------
    |B2C timeout url
    |------------------------------------------
    */
    'b2c_timeout' => '',

    /*-----------------------------------------
    |B2C results url
    |------------------------------------------
    */
    'b2c_result' => ''

];
