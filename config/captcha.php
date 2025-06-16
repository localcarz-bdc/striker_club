<?php

return [
    'sitekey' => env('RECAPTCHA_KEY'),
    'secret' => env('RECAPTCHA_SECRET'),
    'options' => [
        'timeout' => 3600,
    ],
];
