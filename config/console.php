<?php

use yii\console\controllers\MigrateController;

require __DIR__ . '/aliases.php';

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$framework = [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'App\Presentation\Console\Controller',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    'controllerMap' => [
        'migrate' => [
            'class' => MigrateController::class,
            'migrationPath' => null,
            'migrationNamespaces' => [
                'App\Console\Migration',
            ],
        ],
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $framework['bootstrap'][] = 'gii';
    $framework['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return [
    'framework' => $framework,
    'bootstrap' => [
        OneCMS\User\ConsoleBootstrap::class
    ],
];
