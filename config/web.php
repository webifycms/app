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

use App\Infrastructure\ApplicationExtension;
use Webify\Admin\Infrastructure\AdminExtension;
use Webify\Base\Domain\Service\Application\ApplicationServiceInterface;
use Webify\Base\Infrastructure\BaseExtension;
use Webify\User\Infrastructure\UserExtension;

use function Webify\Base\Infrastructure\get_env_variable;

// import framework configurations
$framework = require __DIR__ . '/framework/web.php';

return [
	'administrationPath'  => ApplicationServiceInterface::DEFAULT_ADMINISTRATION_PATH,
	'framework'           => $framework,
	'extensions'          => [
		BaseExtension::class,
		AdminExtension::class,
		UserExtension::class,
		ApplicationExtension::class,
	],
	'vite' => [
		'dev_server_url' => get_env_variable('VITE_DEV_SERVER_URL', 'http://loclahost:5173'),
	],
];
