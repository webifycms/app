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

namespace App\Infrastructure\Presentation\Http\Controller;

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
		private StreamFactoryInterface $streamFactory
	) {}

	/**
	 * Handles the HTTP request/response lifecycle of the home page.
	 */
	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		$response = $this->responseFactory->createResponse(200);
		$body     = $this->streamFactory->createStream("Hello, world! Let's simply transform to web.");

		return $response
			->withBody($body)
			->withHeader('Content-Type', 'text/plain')
		;
	}
}
