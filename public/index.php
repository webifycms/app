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

// should require the composer autoloader on first
use function Webify\Base\Infrastructure\app;
use function Webify\Base\Infrastructure\configure;
use function Webify\Base\Infrastructure\enable_dev_env;
use function Webify\Base\Infrastructure\load_env_variables;

require __DIR__ . '/../vendor/autoload.php';

// comment out or delete the following line when deployed to production
enable_dev_env();

// load Yii class file
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// load the env variables
load_env_variables(dirname(__DIR__));

// load default configurations
$config = require __DIR__ . '/../config/web.php';

// configure
configure($config);
// run the application
app()->run();
