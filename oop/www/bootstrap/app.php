<?php
use Grafikart\Container\Container;
use Grafikart\Templating\Layout;

$app = Container::instance();

$app['root'] = dirname(__DIR__);
$app->singleton('database', function ($app) {
   $config = require $app['root'] . "/config/database.php";
   return new \Grafikart\Database\Connection\PdoConnection(
       $config['dsn'],
       $config['username'],
       $config['password'],
       $config['options']
   );
});
$app['router'] = function ($app) {
    return (require $app['root'] .'/routes/web.php');
};
$app['view'] = function ($app) {
    return new Layout($app['root'] ."/views/layouts/default.php");
};


return $app;