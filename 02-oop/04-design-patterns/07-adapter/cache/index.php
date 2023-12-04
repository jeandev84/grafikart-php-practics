<?php

require __DIR__.'/vendor/autoload.php';

/* $cache = new \Grafikart\Cache\Cache(); */

$cache = new \Doctrine\Common\Cache\FilesystemCache(__DIR__.'/cache');
$adapter = new \Grafikart\Cache\DoctrineCacheAdapter($cache);
$controller = new \App\Controller\GreatController();
echo $controller->sayHello($adapter);