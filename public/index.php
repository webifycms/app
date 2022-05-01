<?php
// should require the composer autoloader on first
require __DIR__ . '/../vendor/autoload.php';

// comment out or delete the following line when deployed to production
enable_dev_env();

// load Yii class file
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// load the env variables
load_env_variables(dirname(__DIR__));

// load default configurations
$config = require __DIR__ . '/../config/web.php';

// configure
configure($config);
// start the application
app()->start();
