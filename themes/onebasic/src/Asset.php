<?php
declare(strict_types=1);

namespace OneBasic;


use yii\web\AssetBundle;

/**
 * Class Asset
 *
 * @package OneBasic
 */
class Asset extends AssetBundle
{
    
    public $sourcePath = '@App/themes/onebasic/dist';
    public $css = [
        'css/app.css'
    ];
    public $js = [
        'js/app.js'
    ];
}