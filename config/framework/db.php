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

use function Webify\Base\Infrastructure\get_env_variable;

return [
	'class'       => 'yii\db\Connection',
	'dsn'         => 'mysql:host=' . get_env_variable('DATABASE_HOST') . ';port=' . get_env_variable('DATABASE_PORT') . ';dbname=' . get_env_variable('DATABASE_NAME'),
	'username'    => get_env_variable('DATABASE_USER'),
	'password'    => get_env_variable('DATABASE_PASSWORD'),
	'charset'     => 'utf8',
	'tablePrefix' => 'web_',
	// Schema cache options (for production environment)
	// 'enableSchemaCache' => true,
	// 'schemaCacheDuration' => 60,
	// 'schemaCache' => 'cache',
];
