<?php

/*
|--------------------------------------------------------------------------
| File which returns array of constants containing the plivo SMS GateWay
| integration credentials.
|--------------------------------------------------------------------------
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Plivo API Manager AUTH_ID
    |--------------------------------------------------------------------------
    |
    | Specify the key used to identify the vendor
    |
    */

    'PLIVO_AUTH_ID' => env('PLIVO_AUTH_ID'),

    /*
    |--------------------------------------------------------------------------
    | Plivo API Manager AUTH_TOKEN
    |--------------------------------------------------------------------------
    |
    | Specify the secret to authorize the application call
    |
    */

    'PLIVO_AUTH_TOKEN' => env('PLIVO_AUTH_TOKEN'),

];

// end of file plivo.php
