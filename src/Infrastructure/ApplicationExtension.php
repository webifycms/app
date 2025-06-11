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

namespace App\Infrastructure;

use App\Domain\ApplicationExtensionInterface;
use App\Infrastructure\Service\Register\AdministrationRoutesRegisterService;
use App\Infrastructure\Service\Register\DependenciesRegisterService;
use App\Infrastructure\Service\Register\RoutesRegisterService;
use App\Infrastructure\Service\Register\TranslationsRegisterService;
use Webify\Base\Domain\Exception\TranslatableRuntimeException;
use Webify\Base\Domain\Service\Application\ApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Application\WebApplicationServiceInterface;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\web\AssetManager;

use function Webify\Base\Infrastructure\dependency;
use function Webify\Base\Infrastructure\get_alias;

final class ApplicationExtension implements ApplicationExtensionInterface
{
	/**
	 * @var null|string the extension templates path
	 */
	private ?string $assetsPath = null;

	/**
	 * @var null|string the extension assets published url
	 */
	private ?string $assetsUrl = null;

	public function initialize(ApplicationServiceInterface $appService): void
	{
		if ($appService instanceof WebApplicationServiceInterface) {
			$this->publishAssets($appService->getApplication()->getAssetManager());
		}
	}

	public function getId(): string
	{
		return strtolower(self::NAME);
	}

	public function getInterface(): string
	{
		return ApplicationExtensionInterface::class;
	}

	public function getVersion(): string
	{
		return self::VERSION;
	}

	public function getTemplatesPath(): ?string
	{
		return get_alias(self::TEMPLATES_PATH);
	}

	public function getAssetsPath(): ?string
	{
		return $this->assetsPath;
	}

	public function getAssetsPublishedUrl(): ?string
	{
		return $this->assetsUrl;
	}

	public function getRegisterServices(): array
	{
		return [
			DependenciesRegisterService::class,
			AdministrationRoutesRegisterService::class,
			RoutesRegisterService::class,
			TranslationsRegisterService::class,
		];
	}

	public static function getInstance(): ApplicationExtensionInterface
	{
		// @phpstan-ignore-next-line
		return dependency()
			->getContainer()
			->get(WebApplicationServiceInterface::class)
			->getExtension(ApplicationExtensionInterface::class)
		;
	}

	/**
	 * Publishes assets to a public directory using the given asset manager.
	 *
	 * @param AssetManager $assetManager the asset manager responsible for publishing assets
	 *
	 * @throws TranslatableRuntimeException if the assets cannot be published
	 */
	private function publishAssets(AssetManager $assetManager): void
	{
		try {
			$published        = $assetManager->publish(self::ASSETS_PATH);
			$this->assetsPath = $published[0];
			$this->assetsUrl  = $published[1];
		} catch (InvalidArgumentException|InvalidConfigException $exception) {
			throw new TranslatableRuntimeException(
				'assets_publish_failed.',
				['directory' => self::ASSETS_PATH],
				$exception->getCode(),
				$exception
			);
		}
	}
}
