<?php

require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));


// Error Handler
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();


// Routing
$router  = new \Grafikart\Routing\Router(dirname(__DIR__). '/views');
$router->get('/', 'post/index', 'home')
       ->get('/blog/category', 'category/show', 'category')
       ->run();



