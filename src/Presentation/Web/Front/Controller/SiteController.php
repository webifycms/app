<?php
declare(strict_types=1);

namespace App\Presentation\Web\Front\Controller;

use yii\web\Controller;

/**
 * Class SiteController
 *
 * @package getonecms/app
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
class SiteController extends Controller
{
    
    /**
     * @return array
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }
    
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
