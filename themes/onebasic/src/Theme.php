<?php

declare(strict_types=1);

namespace OneTen;

use OneCMS\Base\Infrastructure\Framework\Theme\Theme as BaseTheme;

/**
 * Class Theme
 *
 * @package OneTen
 * @version 0.0.1
 */
class Theme extends BaseTheme
{
    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->setBasePath('@Themes/oneten');
        $this->setBaseUrl('@Themes/oneten');

        $this->pathMap = [
            '@App/templates' => '@Themes/oneten/templates'
        ];

        parent::init();
    }
}
