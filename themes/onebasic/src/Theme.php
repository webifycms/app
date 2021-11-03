<?php
declare(strict_types=1);

namespace OneBasic;


use OneCMS\Base\Infrastructure\Framework\Theme\Theme as BaseTheme;

/**
 * Class Theme
 *
 * @package OneBasic
 * @version 0.0.1
 */
class Theme extends BaseTheme
{
    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->setBasePath('@App/themes/onebasic');
        $this->setBaseUrl('@App/themes/onebasic');
        
        $this->pathMap = [
            '@App/templates' => '@App/themes/onebasic/templates'
        ];
        
        parent::init();
    }
}