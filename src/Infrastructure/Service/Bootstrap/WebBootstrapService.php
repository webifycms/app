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

namespace App\Infrastructure\Service\Bootstrap;

use Webify\Base\Infrastructure\Service\Bootstrap\BaseWebBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterDependencyBootstrapInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterRoutesBootstrapInterface;

use function Webify\Base\Infrastructure\get_alias;

/**
 * A service class responsible for bootstrapping web-specific components.
 * This class initializes the application dependencies and defines the routes
 * required for the web environment. It extends the `BaseWebBootstrapService`
 * and implements `RegisterDependencyBootstrapInterface` to manage dependencies
 * and `RegisterRoutesBootstrapInterface` to handle route definitions.
 */
final class WebBootstrapService extends BaseWebBootstrapService implements RegisterDependencyBootstrapInterface
{
	public function init(): void
	{
		// TODO: Implement init() method.
	}

	public function dependencies(): array
	{
		return include_once get_alias('@App/config/dependencies.php');
	}
}
