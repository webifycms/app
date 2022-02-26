<?php

declare(strict_types=1);

namespace OneTen;

use yii\web\AssetBundle;

/**
 * Class Asset
 *
 * @package OneTen
 * @version 0.0.1
 */
class Asset extends AssetBundle
{
    public $sourcePath = '@Themes/oneten/dist';
    public $css = [
        'css/app.css'
    ];
    public $js = [
        'js/app.js'
    ];
}
