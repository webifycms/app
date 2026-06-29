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

namespace App\Infrastructure\Presentation\Http\Controller;

use App\Infrastructure\Service\TemplateRenderer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};

/**
 * Error controller, it renders the error page.
 */
final readonly class Error
{
	/**
	 * The constructor.
	 */
	public function __construct(
		private Psr17Factory $factory,
		private TemplateRenderer $templateRenderer,
	) {}

	/**
	 * Renders the error page.
	 */
	public function __invoke(ServerRequestInterface $request, int $statusCode, string $statusText): ResponseInterface
	{
		$body = $this->templateRenderer->render(
			'error.html.php',
			[
				'statusCode' => $statusCode,
				'statusText' => $statusText,
			],
		);
		$response = $this->factory->createResponse($statusCode);

		return $response
			->withBody($this->factory->createStream($body))
			->withHeader('Content-Type', 'text/html; charset=utf-8')
		;
	}
}
