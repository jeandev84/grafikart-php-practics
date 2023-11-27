<?php

require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));


// Error Handler
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();


// HTTP Request
$request = \Grafikart\Http\Request\Request::createFromGlobals();

// Routing
$router  = new \Grafikart\Routing\Router(dirname(__DIR__). '/views');
$router->get('/', 'post/index', 'home')
       ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
       ->get('/blog/category', 'category/show', 'category')
       ->run();



