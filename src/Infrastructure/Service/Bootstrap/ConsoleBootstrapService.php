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

use Webify\Base\Infrastructure\Service\Bootstrap\BaseConsoleBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterDependencyBootstrapInterface;

use function Webify\Base\Infrastructure\get_alias;

/**
 * ConsoleBootstrapService is responsible for bootstrapping console-specific functionality.
 *
 * It extends the BaseConsoleBootstrapService and implements the RegisterDependencyBootstrapInterface,
 * ensuring that required dependencies are registered and initialized before the console application runs.
 */
final class ConsoleBootstrapService extends BaseConsoleBootstrapService implements RegisterDependencyBootstrapInterface
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
