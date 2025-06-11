<?php

/**
 * The file is part of the "webifycms/app", WebifyCMS extension package.
 *
 * @see https://webifycms.com
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

use Webify\Base\Infrastructure\Component\View\WebViewComponent;
use Webify\Green\Theme;

use function Webify\Base\Infrastructure\get_env_variable;

require __DIR__ . '/aliases.php';

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';
$config = [
	'id'                  => get_env_variable('APP_ID'),
	'name'                => get_env_variable('APP_NAME'),
	'basePath'            => '@App',
	'viewPath'            => '@App/templates',
	'sourceLanguage'      => 'en-US',
	'controllerNamespace' => 'App\Infrastructure\Presentation\Web\Controller',
	'bootstrap'           => ['log'],
	// TODO: The Site extension should handle the default route
	'defaultRoute' => 'home',
	'components'   => [
		'request' => [
			'cookieValidationKey' => get_env_variable('APP_COOKIE_VALIDATION_KEY'),
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'errorHandler' => [
			// TODO: The Site extension should handle the error action route
			'errorAction' => 'home/error',
		],
		'log' => [
			'traceLevel' => APP_DEBUG ? 3 : 0,
			'targets'    => [
				[
					'class'   => 'yii\log\FileTarget',
					'levels'  => ['error', 'warning'],
					'logVars' => ['_GET', '_POST'],
					'except'  => [
						'yii\web\HttpException:404',
					],
				],
			],
		],
		'db'         => $db,
		'urlManager' => [
			'baseUrl'         => '/',
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'suffix'          => '/',
		],
		'assetManager' => [
			'basePath'        => '@webroot/assets',
			'baseUrl'         => '@web/assets',
			'appendTimestamp' => true,
		],
		'view' => [
			'class' => WebViewComponent::class,
			'theme' => [
				'class'   => Theme::class,
				'pathMap' => [
					'@App/templates' => '@Theme/templates',
				],
			],
		],
		'i18n' => [
			'translations' => [
				'app*' => [
					'class'    => 'yii\i18n\PhpMessageSource',
					'basePath' => '@App/resources/translations',
				],
			],
		],
	],
	'params' => $params,
];

if (ENV_DEVELOPMENT === APP_ENVIRONMENT) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][]      = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		'allowedIPs' => ['*'],
	];
}

return $config;
