<?php
declare(strict_types=1);

namespace App\Shop;

use Framework\Module;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;


/**
 * Created by PhpStorm at 10.12.2023
 *
 * @ShopModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Shop
*/
class ShopModule extends Module
{
      const MIGRATIONS = __DIR__.'/db/migrations';
      const SEEDS      =    __DIR__.'/db/seeds';


      public function __construct(ContainerInterface $container)
      {
          $container->get(RendererInterface::class)->addPath('shop', __DIR__.'/views');
          $router = $container->get(Router::class);
          $router->crud($container->get('admin.prefix'). '/products', '', 'shop.admin.products');
      }
}