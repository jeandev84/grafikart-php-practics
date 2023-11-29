<?php
declare(strict_types=1);

namespace App\Providers;


use Grafikart\Container\Container;
use Grafikart\Container\Provider\ServiceProvider;
use Grafikart\Routing\Router;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @RouteServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Providers
 */
class RouteServiceProvider extends ServiceProvider
{

    private string $routePath;

    public function __construct(string $routePath)
    {
        $this->routePath = $routePath;
    }


    public function register(Container $container): void
    {
         $container->bind(Router::class, function () {
             $router  = new \Grafikart\Routing\Router();
             require $this->routePath;
             return $router;
         });
    }
}