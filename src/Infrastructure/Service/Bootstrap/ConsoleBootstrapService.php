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

use Webify\Base\Domain\Service\Application\ApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Application\ConsoleApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\BaseConsoleBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterControllerMapBootstrapInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterDependenciesBootstrapInterface;
use yii\i18n\PhpMessageSource;

use function Webify\Base\Infrastructure\get_alias;

/**
 * ConsoleBootstrapService is responsible for bootstrapping console-specific functionality.
 *
 * It extends the BaseConsoleBootstrapService and implements the RegisterDependencyBootstrapInterface,
 * ensuring that required dependencies are registered and initialized before the console application runs.
 */
final class ConsoleBootstrapService extends BaseConsoleBootstrapService implements RegisterDependenciesBootstrapInterface, RegisterControllerMapBootstrapInterface
{
	public function dependencies(): array
	{
		return include_once get_alias('@App/config/dependencies.php');
	}

	/**
	 * @param ConsoleApplicationServiceInterface $appService
	 */
	public function bootstrap(ApplicationServiceInterface|ConsoleApplicationServiceInterface $appService): void
	{
		$appService->getApplication()->i18n->translations['app*'] = [
			'class'          => PhpMessageSource::class,
			'sourceLanguage' => 'en-US',
			'basePath'       => '@App/resources/translations',
		];
	}

	public function controllerMap(): array
	{
		return [];
	}
}
