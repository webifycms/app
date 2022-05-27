<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => get_env_variable('DATABASE_DSN') . ';dbname=' . get_env_variable('DATABASE_NAME'),
    'username' => get_env_variable('DATABASE_USERNAME'),
    'password' => get_env_variable('DATABASE_PASSWORD'),
    'charset' => 'utf8',
    'tablePrefix' => 'one_',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
