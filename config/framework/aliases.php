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

Yii::setAlias('@App', dirname(__DIR__, 2));
Yii::setAlias('@Extensions', dirname(__DIR__, 2) . '/extensions');
Yii::setAlias('@Themes', dirname(__DIR__, 2) . '/themes');
