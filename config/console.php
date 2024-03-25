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
use Webify\User\ConsoleBootstrap;

// import framework configurations
$framework = require __DIR__ . '/framework/console.php';

return [
	'framework' => $framework,
	'bootstrap' => [
		ConsoleBootstrap::class,
	],
];
