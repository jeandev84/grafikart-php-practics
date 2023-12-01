<?php
use Grafikart\Container\Container;
use Grafikart\Templating\Layout;

$app = Container::instance();

$app['root'] = dirname(__DIR__);
$app['router'] = function ($app) {
    return (require $app['root'] .'/routes/web.php');
};
$app['view'] = function ($app) {
    return new Layout($app['root'] ."/views/layouts/default.php");
};

return $app;