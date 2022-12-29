<?php

declare(strict_types=1);

namespace App\Presentation\Web\Front\Controller;

use yii\web\Controller;

/**
 * Class SiteController.
 */
class SiteController extends Controller
{
	/**
	 * @return array<mixed>
	 */
	public function actions(): array
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	public function actionIndex(): string
	{
		return $this->render('index');
	}
}
