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

use Webify\Base\Infrastructure\Service\Register\Dependencies\DependenciesRegisterService as AbstractDependenciesRegisterService;

use function Webify\Base\Infrastructure\get_alias;

final class DependenciesRegisterService extends AbstractDependenciesRegisterService
{
	public function getDependencies(): array
	{
		return include_once get_alias('@App/config/dependencies.php');
	}
}
