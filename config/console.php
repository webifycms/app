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

use Webify\User\Infrastructure\UserExtension;

// import framework configurations
$framework = require __DIR__ . '/framework/console.php';

return [
	'framework'  => $framework,
	'extensions' => [
		UserExtension::class,
	],
];
