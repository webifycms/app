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

use yii\helpers\Html;

use function Webify\Base\Infrastructure\app;
use function Webify\Base\Infrastructure\view;

?>

<?php view()->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?php echo app()->language; ?>" class="h-100">
<head>
    <title><?php echo Html::encode(view()->title); ?></title>
    <?php view()->head(); ?>
</head>
<body class="d-flex flex-column h-100">
<?php view()->beginBody(); ?>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php echo $content; ?>
    </div>
</main>

<?php view()->endBody(); ?>
</body>
</html>
<?php view()->endPage(); ?>
