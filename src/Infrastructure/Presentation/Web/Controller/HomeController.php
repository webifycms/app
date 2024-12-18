<?php
/**
 * The file is part of the "webifycms/app", WebifyCMS application.
 *
 * @see https://webifycms.com/
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace App\Infrastructure\Presentation\Web\Controller;

use Webify\Base\Infrastructure\Presentation\Web\Controller\BaseWebController;
use yii\web\ErrorAction;

/**
 * This controller is provided as an example for you to learn how to create controller actions.
 */
final class HomeController extends BaseWebController
{
	/**
	 * @return array<string, array<string, string>>
	 */
	public function actions(): array
	{
		return [
			'error' => [
				'class' => ErrorAction::class,
			],
		];
	}

	/**
	 * The default action of the controller.
	 */
	public function actionIndex(): string
	{
		return $this->render('index');
	}
}
