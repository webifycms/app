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

namespace App\Infrastructure\Service\Register;

use Webify\Base\Infrastructure\Service\Register\Routes\RoutesRegisterService as AbstractRoutesRegisterService;

use function Webify\Base\Infrastructure\get_alias;

final class RoutesRegisterService extends AbstractRoutesRegisterService
{
	public function getRoutes(): array
	{
		return require get_alias('@App/config/routes/web/web.php');
	}
}
