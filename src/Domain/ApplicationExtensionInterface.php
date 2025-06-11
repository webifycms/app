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

namespace App\Domain;

use Webify\Base\Domain\ExtensionInterface;

interface ApplicationExtensionInterface extends ExtensionInterface
{
	/**
	 * The extension name.
	 */
	public const NAME = 'App';

	/**
	 * The extension version.
	 */
	public const VERSION = '0.0.1';

	/**
	 * The extension templates path.
	 */
	public const TEMPLATES_PATH = '@App/templates';

	/**
	 * The extension assets path.
	 */
	public const ASSETS_PATH = '@App/resources/assets';
}
