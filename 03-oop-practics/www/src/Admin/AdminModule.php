<?php
declare(strict_types=1);

namespace App\Admin;


use App\Admin\Actions\DashboardAction;
use App\Admin\Extensions\AdminTwigExtension;
use Framework\Module;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Templating\Renderer\TwigRenderer;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @AdminModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Admin
 */
class AdminModule extends Module
{


     const DEFINITIONS = __DIR__.'/config.php';
     const MIGRATIONS = __DIR__.'/db/migrations';
     const SEEDS =  __DIR__.'/db/seeds';




     public function __construct(
         RendererInterface  $renderer,
         Router             $router,
         AdminTwigExtension $adminTwigExtension,
         string             $prefix
     )
     {
         $renderer->addPath('admin', __DIR__.'/views');
         $router->get($prefix, DashboardAction::class, 'admin');

         if ($renderer instanceof TwigRenderer) {
             $renderer->getTwig()->addExtension($adminTwigExtension);
         }
     }

}