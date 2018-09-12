<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Helpers/general.php';

$facades  = [
    'Config',
    'Request',
    'Router',
    'Auth',
];
foreach($facades as $facade) {
    require_once  __DIR__ . '/app/Facades/' . $facade . '.php';
}
