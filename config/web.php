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

use Webify\Admin\Infrastructure\Service\Bootstrap\WebBootstrapService as AdminWebBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\WebBootstrapService as BaseWebBootstrapService;
use Webify\User\Infrastructure\Service\Bootstrap\WebBootstrapService as UserWebBootstrapService;

// import framework configurations
$framework = require __DIR__ . '/framework/web.php';

return [
	// 'administrationPath' => 'backend',
	'framework' => $framework,
	'bootstrap' => [
		BaseWebBootstrapService::class,
		AdminWebBootstrapService::class,
		UserWebBootstrapService::class,
	],
];
