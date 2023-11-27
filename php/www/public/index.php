<?php

require '../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));


// Error Handler
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

// Middlewares
$request = \Grafikart\Http\Request\Request::createFromGlobals();

if ($request->queries->equalTo('page', '1')) {
    // Reecrire l' url sans le parametre ?page
    # Example if URL : http://localhost:8000/blog/tutoriels?page=1&param=2
    # will be redirect to http://localhost:8000/blog/tutoriels?param=2
    $uri = $request->buildURI(['page']);
    #header('Location: '. $uri);
    #http_response_code(301);
    exit();
}


// HTTP Request
$request = \Grafikart\Http\Request\Request::createFromGlobals();

// Routing
$router  = new \Grafikart\Routing\Router(dirname(__DIR__). '/views');
$router->get('/', 'post/index', 'home')
       ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
       ->get('/blog/category', 'category/show', 'category')
       ->run();



