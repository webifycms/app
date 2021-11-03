<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
?>

<div class="site-error">
    <h1><?= Html::encode($name) ?></h1>
    
    <p class="uk-text-lead">
        <?= nl2br(Html::encode($message)) ?>
    </p>
</div>
