<?php
require __DIR__.'/public/index.php';


$migrations = [];
$seeds = [];
foreach ($modules as $module) {
    if ($module::MIGRATIONS) {
        $migrations[] = $module::MIGRATIONS;
    }
    if ($module::SEEDS) {
        $seeds[] = $module::SEEDS;
    }
}


return
[
    'paths' => [
        'migrations' => $migrations,
        'seeds' =>  $seeds
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host'    => $app->getContainer()->get('database.host'),
            'name'    => $app->getContainer()->get('database.name'),
            'user'    => $app->getContainer()->get('database.username'),
            'pass'    => $app->getContainer()->get('database.password')
        ]
    ],
    'version_order' => 'creation'
];
