<?php

/* @var $content string */
?>

<?php view()->beginPage() ?>
    <!doctype html>
    <html lang="<?= app()->get('language') ?>">
        <head>
            <meta charset="<?= app()->get('charset') ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1">
    
            <title><?= app()->get('name') ?></title>
            
            <?php view()->registerCsrfMetaTags() ?>
            <?php view()->head() ?>
        </head>
    
        <body>
        <?php view()->beginBody() ?>
    
        <main class="main-content">
            <?= $content ?>
        </main>
        
        <?php view()->endBody() ?>
        </body>
    </html>
<?php view()->endPage() ?>