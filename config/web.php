<?php

// import framework configurations
$framework = require __DIR__ . '/framework/web.php';

return [
    // 'administrationPath' => 'backend',
    'framework' => $framework,
    'bootstrap' => [
        \OneCMS\Base\Infrastructure\WebBootstrap::class,
        \OneCMS\Admin\WebBootstrap::class,
        \OneCMS\User\WebBootstrap::class,
    ],
];
