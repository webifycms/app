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

use Webify\Green\Theme;

use function Webify\Base\Infrastructure\get_env_variable;
use function Webify\Base\Infrastructure\in_debug;

require __DIR__ . '/aliases.php';

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';
$config = [
	'id'                     => 'web',
	'name'                   => get_env_variable('APPLICATION_NAME'),
	'basePath'               => '@App',
	'viewPath'               => '@App/templates',
	'sourceLanguage'         => 'en-US',
	'controllerNamespace'    => 'App\Presentation\Web\Front\Controller',
	'bootstrap'              => ['log'],
	'defaultRoute'           => 'hello',
	'aliases'                => [
		'@bower'   => '@vendor/bower-asset',
		'@npm'     => '@vendor/npm-asset',
		'@Green'   => '@Themes/theme-green/src',
	],
	'components' => [
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'IOQIlinyOL8PfVLM5J37OgTZ6thnfWF7',
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		//        'user' => [
		//            'identityClass' => 'app\models\User',
		//            'enableAutoLogin' => true,
		//        ],
		'errorHandler' => [
			'errorAction' => 'hello/error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
		],
		'log' => [
			'traceLevel' => in_debug() ? 3 : 0,
			'targets'    => [
				[
					'class'  => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db'         => $db,
		'urlManager' => [
			'baseUrl'         => '/',
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'suffix'          => '/',
			'rules'           => [],
		],
		'assetManager' => [
			'appendTimestamp' => true,
			'linkAssets'      => true,
			'forceCopy'       => YII_DEBUG,
		],
		'view' => [
			'theme' => Theme::class,
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

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][]      = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		// 'allowedIPs' => ['127.0.0.1', '::1'],
	];
	// $config['bootstrap'][]    = 'gii';
	// $config['modules']['gii'] = [
	// 	'class' => 'yii\gii\Module',
	// 	// uncomment the following to add your IP if you are not connecting from localhost.
	// 	// 'allowedIPs' => ['172.19.96.1', '127.0.0.1', '::1'],
	// ];
}

return $config;
