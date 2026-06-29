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
use Psr\Http\Message\{ResponseFactoryInterface, ResponseInterface, ServerRequestInterface, StreamFactoryInterface};

/**
 * Home controller, just an example controller. It renders the home page.
 */
final readonly class Home
{
	/**
	 * The constructor.
	 */
	public function __construct(
		private ResponseFactoryInterface $responseFactory,
		private StreamFactoryInterface $streamFactory,
		private TemplateRenderer $templateRenderer,
	) {}

	/**
	 * Handles the HTTP request/response lifecycle of the home page.
	 */
	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		$body     = $this->templateRenderer->render('home.html.php');
		$response = $this->responseFactory->createResponse(200);

		return $response
			->withBody($this->streamFactory->createStream($body))
			->withHeader('Content-Type', 'text/html; charset=utf-8')
		;
	}
}
