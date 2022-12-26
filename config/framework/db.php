<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . get_env_variable('DATABASE_HOST') . ';port=' . get_env_variable('DATABASE_PORT') . ';dbname=' . get_env_variable('DATABASE_NAME'),
    'username' => get_env_variable('DATABASE_USER'),
    'password' => get_env_variable('DATABASE_PASSWORD'),
    'charset' => 'utf8',
    'tablePrefix' => 'one_',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
