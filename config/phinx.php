<?php
require __DIR__.'/../launch.php';

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/../db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/../db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'default',
        'default' => [
            'adapter' => $_ENV['DB_ADAPTER'],
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASS'],
            'port' => $_ENV['DB_PORT'],
            'charset' => $_ENV['CHARSET'],
        ],
    ],
    'version_order' => 'creation'
];
