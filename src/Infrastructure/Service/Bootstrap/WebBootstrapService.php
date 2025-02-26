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
use Webify\Base\Infrastructure\Service\Application\WebApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\BaseWebBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterAdminRoutesBootstrapInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterDependenciesBootstrapInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterRoutesBootstrapInterface;
use yii\i18n\PhpMessageSource;

use function Webify\Base\Infrastructure\get_alias;

/**
 * A service class responsible for bootstrapping web-specific components.
 * This class initializes the application dependencies and defines the routes
 * required for the web environment.
 */
final class WebBootstrapService extends BaseWebBootstrapService implements RegisterDependenciesBootstrapInterface, RegisterRoutesBootstrapInterface, RegisterAdminRoutesBootstrapInterface
{
	public function dependencies(): array
	{
		return include_once get_alias('@App/config/dependencies.php');
	}

	/**
	 * @param WebApplicationServiceInterface $appService
	 */
	public function bootstrap(ApplicationServiceInterface|WebApplicationServiceInterface $appService): void
	{
		$appService->getApplication()->i18n->translations['app*'] = [
			'class'          => PhpMessageSource::class,
			'sourceLanguage' => 'en-US',
			'basePath'       => '@App/resources/translations',
		];
	}

	public function adminRoutes(): array
	{
		return require get_alias('@App/config/routes/web/admin.php');
	}

	public function routes(): array
	{
		return require get_alias('@App/config/routes/web/web.php');
	}
}
