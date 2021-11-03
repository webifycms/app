<?php

// set aliases
use OneBasic\Theme;

require __DIR__ . '/aliases.php';

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$framework = [
    'id' => 'web',
    'name' => 'OneCMS',
    'basePath' => '@App',
    'viewPath' => '@App/templates',
    'controllerNamespace' => 'App\\Controller',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hZz4eOt7zrFCbvJ8RcX9CkbnSO7_cjs2',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'baseUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '/',
            'rules' => [],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'forceCopy' => YII_DEBUG
        ],
        'view' => [
            'theme' => Theme::class
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $framework['bootstrap'][] = 'debug';
    $framework['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $framework['bootstrap'][] = 'gii';
    $framework['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return [
    'administrationPath' => 'backend',
    'framework' => $framework,
    'bootstrap' => [
        \OneCMS\Base\Bootstrap::class,
        \OneCMS\Admin\Bootstrap::class,
        \OneCMS\User\Bootstrap::class,
    ],
];
