<?php

// import framework configurations
$framework = require __DIR__ . '/framework/console.php';

return [
    'framework' => $framework,
    'bootstrap' => [
        OneCMS\User\ConsoleBootstrap::class
    ],
];