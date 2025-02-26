<?php

/**
 * The file is part of the "webifycms/app", WebifyCMS application.
 *
 * @see https://webifycms.com/
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

use yii\console\controllers\MigrateController;

require __DIR__ . '/aliases.php';

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';
$config = [
	'id'                  => 'console',
	'basePath'            => dirname(__DIR__),
	'bootstrap'           => ['log'],
	'controllerNamespace' => 'App\Infrastructure\Presentation\Console\Controller',
	'components'          => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'log' => [
			'targets' => [
				[
					'class'  => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' => $db,
	],
	'params'        => $params,
	'controllerMap' => [
		'migrate' => [
			'class'               => MigrateController::class,
			'migrationPath'       => null,
			'migrationNamespaces' => [
				'App\Console\Migration',
			],
		],
		'fixture' => [
			'class' => 'yii\faker\FixtureController',
		],
	],
];

if ('dev' === APP_ENVIRONMENT) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][]      = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		'allowedIPs' => ['*'],
	];
}

return $config;
