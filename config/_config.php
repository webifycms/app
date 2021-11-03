<?php

// should load the default configurations
use OneBasic\Theme;
use OneCMS\User\Infrastructure\Presentation\Admin\Module as UserModule;
use OneCMS\Admin\Infrastructure\Presentation\Admin\Module as AdminModule;

$default = require __DIR__ . '/../vendor/getonecms/base/config/web.php';
$admin = require __DIR__ . '/../vendor/getonecms/admin/config/config.php';
$user = require __DIR__ . '/../vendor/getonecms/user/config/config.php';

return array_merge_recursive($default, $admin, $user, [
    'aliases' => [
        '@App' => dirname(__DIR__),
    ],
    'app' => [
        'components' => [

        ],
        'modules' => [
            'administration' => [
                'class' => AdminModule::class,
                'modules' => [
                    'user' => ['class' => UserModule::class]
                ]
            ]
        ]
    ]
]);
