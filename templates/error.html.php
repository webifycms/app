<?php

/**
 * The file is part of the "webifycms/app", WebifyCMS extension package.
 *
 * @see https://webifycms.com
 *
 * @copyright Copyright (c) 2023 - Present WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

use App\Infrastructure\Service\TemplateRenderer;

/**
 * @var TemplateRenderer $view
 * @var int              $statusCode
 * @var string           $statusText
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $statusCode; ?> - <?= $statusText; ?></title>
    <link rel="stylesheet" href="<?= $view->url('/assets/app.css'); ?>">
</head>
<body>
    <div class="card">
        <div class="code"><?= $statusCode; ?></div>
        <div class="text"><?= $statusText; ?></div>
        <p>Sorry, something went wrong. The page you are looking for might have been moved or no longer exists.</p>
        <a href="<?= $view->url('/'); ?>" class="button">Back to Home</a>
    </div>
</body>
</html>
