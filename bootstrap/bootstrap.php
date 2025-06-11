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
use function Webify\Base\Infrastructure\load_env_variables;

const ENV_PRODUCTION  = 'prod';
const ENV_DEVELOPMENT = 'dev';

// load composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// load the env variables
load_env_variables(dirname(__DIR__));

// define debug && environment
define('APP_DEBUG', (bool) get_env_variable('APP_DEBUG', false));
define('APP_ENVIRONMENT', get_env_variable('APP_ENVIRONMENT', ENV_PRODUCTION));
// define Yii constants
defined('YII_DEBUG') or define('YII_DEBUG', APP_DEBUG);
defined('YII_ENV') or define('YII_ENV', APP_ENVIRONMENT);

// load the Yii class file
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
