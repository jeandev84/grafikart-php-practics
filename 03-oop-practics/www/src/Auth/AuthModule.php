<?php
declare(strict_types=1);

namespace App\Auth;


use App\Auth\Actions\LoginAction;
use App\Auth\Actions\LoginAttemptAction;
use App\Auth\Actions\LogoutAction;
use Framework\Module;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @AuthModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth
*/
class AuthModule extends Module
{

      const DEFINITIONS = __DIR__.'/config.php';
      const MIGRATIONS = __DIR__.'/db/migrations';
      const SEEDS =  __DIR__.'/db/seeds';


      /**
       * @var ContainerInterface
      */
      protected ContainerInterface $container;


      /**
        * @param ContainerInterface $container
        * @param Router $router
        * @param RendererInterface $renderer
        * @throws ContainerExceptionInterface
        * @throws NotFoundExceptionInterface
      */
      public function __construct(ContainerInterface $container, Router $router, RendererInterface $renderer)
      {
          $renderer->addPath('auth', __DIR__.'/views');
          $router->get($container->get('auth.login'), LoginAction::class, 'auth.login');
          $router->post($container->get('auth.login'), LoginAttemptAction::class, '');
          $router->post('/logout', LogoutAction::class, 'auth.logout');
      }
}