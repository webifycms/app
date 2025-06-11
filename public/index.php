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

use Webify\Base\Infrastructure\Service\Application\WebApplicationService;
use Webify\Base\Infrastructure\Service\Config\ConfigService;

use function Webify\Base\Infrastructure\dependency;

// load bootstrap file
require __DIR__ . '/../bootstrap/bootstrap.php';

// load default configurations
$config = require __DIR__ . '/../config/web.php';

// initialize application
(new WebApplicationService(dependency(), new ConfigService($config)))->run();
