<?php

return [

    'ADMIN_ONLY'    => env('APP_ADMIN_ONLY', true),

    'SSL'           => env('APP_SSL', true),

    'MULTISAS'      => env('APP_MULTISAS', true),

    'VERSION'       => env('APP_VERSION', '1.0.0'),

    'MAIL_DEV'      => env('APP_MAIL_DEV', 'dev@domain.com'),

    'MAIL_REPLY'    => env('MAIL_REPLY', 'no-reply@domain.com'),

    'GCM_SENDER_ID' => env('GCM_SENDER_ID', null),

    'CACHE_TIME'    => env('CACHE_TIME', 15),

];
