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

use yii\di\Container;

use function Webify\Base\Infrastructure\dependency;

/**
 * @var Container $container
 */
$container = dependency()->getContainer();

return [
	'definitions' => [],
	'singletons'  => [],
];
