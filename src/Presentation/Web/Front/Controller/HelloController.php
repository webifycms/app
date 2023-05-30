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

namespace App\Presentation\Web\Front\Controller;

use yii\web\Controller;

/**
 * This controller is provided as an example for you to learn how to create controller actions.
 */
final class HelloController extends Controller
{
	/**
	 * {@inheritDoc}
	 *
	 * @return array<string, array<string, string>>
	 */
	public function actions(): array
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
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
