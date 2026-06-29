<?php

/**
 * The file is part of the "webifycms/app", WebifyCMS extension package.
 *
 * @see https://webifycms.com
 *
 * @copyright Copyright (c) 2023 - Present WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

use App\Infrastructure\Service\{ErrorHandler, TemplateRenderer};
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Webify\Base\Application\Service\ConfigInterface;
use Webify\Base\Infrastructure\Contract\ErrorHandlerInterface;

use function DI\factory;

return [
	ErrorHandlerInterface::class => factory(
		static function (ContainerInterface $container) {
			return new ErrorHandler(
				$container->get(Psr17Factory::class),
				$container->get(TemplateRenderer::class),
			);
		}
	),
	TemplateRenderer::class      => factory(
		static function (ConfigInterface $config): TemplateRenderer {
			return new TemplateRenderer(
				$config->basePath . '/templates',
				$config->baseUrl,
			);
		}
	),
];
