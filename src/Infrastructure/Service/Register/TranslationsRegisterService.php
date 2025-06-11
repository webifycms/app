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

use Webify\Base\Infrastructure\Service\Register\Translations\TranslationsRegisterService as AbstractTranslationsRegisterService;
use yii\i18n\PhpMessageSource;

final class TranslationsRegisterService extends AbstractTranslationsRegisterService
{
	public function getCategory(): string
	{
		return 'app';
	}

	public function getConfigurations(): array
	{
		return [
			'class'          => PhpMessageSource::class,
			'sourceLanguage' => 'en-US',
			'basePath'       => '@App/resources/translations',
		];
	}
}
