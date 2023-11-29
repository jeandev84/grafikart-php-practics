<?php
declare(strict_types=1);

namespace App\Providers;


use Grafikart\Container\Container;
use Grafikart\Container\Provider\ServiceProvider;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @WhoopsServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Providers
 */
class WhoopsServiceProvider extends ServiceProvider
{

    public function register(Container $container): void
    {
          $container->bind('whoops', function () {
              $whoops = new \Whoops\Run();
              $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
              $whoops->register();
          });
    }
}