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

use Webify\Base\Infrastructure\Service\Application\WebApplicationService;
use Webify\Base\Infrastructure\Service\Config\ConfigService;

// should require the composer autoloader on first
use function Webify\Base\Infrastructure\define_environment;
use function Webify\Base\Infrastructure\dependency;
use function Webify\Base\Infrastructure\get_env_variable;
use function Webify\Base\Infrastructure\load_env_variables;

// load composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// load Yii class file
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// load the env variables
load_env_variables(dirname(__DIR__));

// comment out or delete the following line when deployed to production, by default the environment set as production.
define_environment(get_env_variable('APP_ENVIRONMENT'), get_env_variable('APP_DEBUG') === 'true' ? true : false);

// load default configurations
$config = require __DIR__ . '/../config/web.php';

// create application service and bootstrap
(new WebApplicationService(dependency(), new ConfigService($config)))->bootstrap();
