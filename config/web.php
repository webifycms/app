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

// import framework configurations
$framework = require __DIR__ . '/framework/web.php';

return [
	// 'administrationPath' => 'backend',
	'framework' => $framework,
	'bootstrap' => [
		\Webify\Base\Infrastructure\WebBootstrap::class,
		\Webify\Admin\Infrastructure\WebBootstrap::class,
		\Webify\User\WebBootstrap::class,
	],
];
