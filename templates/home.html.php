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
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebifyCMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $view->url('/assets/app.css'); ?>">
</head>
<body>
    <div class="card">
        <a href="https://webifycms.com" class="logo" target="_blank">
            <img src="<?= $view->url('/assets/logo.png'); ?>" alt="WebifyCMS Logo" width="300px" height="auto">
        </a>
        <h1>Hello, World!</h1>
        <p class="lead">Thank you for trying WebifyCMS!</p>
        <p>We are thrilled to have you here. WebifyCMS is crafted with care to help you build beautiful,
            modern web experiences — simply and joyfully.</p>
        <p>
            <a href="https://webifycms.com/docs/guide" class="button" target="_blank">Explore the Guide</a>
        </p>
        <div class="footer">
            <?= sprintf('© %s WebifyCMS. All rights reserved.', date('Y')); ?>
        </div>
    </div>
</body>
</html>
