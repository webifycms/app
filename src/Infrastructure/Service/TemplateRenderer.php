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

namespace App\Infrastructure\Service;

/**
 * Template renderer is a service that renders templates.
 */
final readonly class TemplateRenderer
{
	/**
	 * The constructor.
	 *
	 * @param string $templatesPath the absolute path to the templates directory
	 * @param string $baseUrl       the base URL for resolving relative paths (empty for relative)
	 */
	public function __construct(
		private string $templatesPath,
		private string $baseUrl = '',
	) {}

	/**
	 * Renders a template.
	 *
	 * @param string               $template the template name
	 * @param array<string, mixed> $data     the data to be passed to the template
	 *
	 * @return string the rendered template
	 */
	public function render(string $template, array $data = []): string
	{
		$data['view'] = $this;
		extract($data, EXTR_SKIP);
		ob_start();

		include $this->templatesPath . '/' . $template;

		return (string) ob_get_clean();
	}

	/**
	 * Resolves a relative path against the configured base URL.
	 *
	 * @param string $path the path to resolve (should start with /)
	 *
	 * @return string the fully qualified URL or relative path when no base URL is set
	 */
	public function url(string $path): string
	{
		if ('' === $this->baseUrl) {
			return $path;
		}

		return rtrim($this->baseUrl, '/') . '/' . ltrim($path, '/');
	}
}
