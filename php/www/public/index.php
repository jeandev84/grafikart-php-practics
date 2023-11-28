<?php

require __DIR__.'/../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));


# Error Handler
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register();

# HTTP Request
$request = \Grafikart\Http\Request\Request::createFromGlobals();


# Middlewares
if ($request->queries->equalTo('page', '1')) {
    // Reecrire l' url sans le parametre ?page
    # Example if URL : http://localhost:8000/blog/tutoriels?page=1&param2=2
    # will be redirect to http://localhost:8000/blog/tutoriels?param2=2
    $request->queries->remove('page');
    $uri = $request->uri($request->queries->all());
    http_response_code(301);
    header('Location: '. $uri);
    exit();
}


// HTTP Request
$request = \Grafikart\Http\Request\Request::createFromGlobals();

// Routing
$router  = new \Grafikart\Routing\Router(dirname(__DIR__). '/views');
$router->get('/', 'post/index', 'home')
       ->get('/blog/category/[*:slug]-[i:id]', 'category/show', 'category')
       ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
       ->get('/admin', 'admin/post/index', 'admin.posts')
       ->map('GET|POST', '/admin/post/[i:id]', 'admin/post/edit', 'admin.post')
       ->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin.post.delete')
       ->map('GET|POST', '/admin/post/new', 'admin/post/new', 'admin.post.new')
       ->run();



