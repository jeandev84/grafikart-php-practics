<?php
declare(strict_types=1);

namespace App;


use App\Admin\AdminModule;
use App\Auth\AuthModule;
use App\Blog\BlogModule;
use Framework\App;
use Framework\Middleware\CsrfMiddleware;
use Framework\Middleware\MethodMiddleware;
use Framework\Middleware\NotFoundMiddleware;
use Framework\Middleware\RouteDispatcherMiddleware;
use Framework\Middleware\RouterMiddleware;
use Framework\Middleware\TrailingSlashMiddleware;
use Middlewares\Whoops;
use Psr\Http\Message\ServerRequestInterface;
use function Http\Response\send;


/**
 * Created by PhpStorm at 08.12.2023
 *
 * @Kernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App
 */
class Kernel
{

      /**
       * @var array
      */
      protected array $modules = [
          AdminModule::class,
          BlogModule::class,
          AuthModule::class
      ];



      /**
       * @var array
      */
      protected array $middlewares = [
          Whoops::class,
          TrailingSlashMiddleware::class,
          MethodMiddleware::class,
          CsrfMiddleware::class,
          RouterMiddleware::class,
          RouteDispatcherMiddleware::class,
          NotFoundMiddleware::class
      ];



      /**
       * @var App
      */
      protected App $app;


      public function __construct(App $app)
      {
          $this->app = $app;
          $this->registerModules($this->app);
          $this->registerMiddlewares($this->app);
      }


      /**
       * @param ServerRequestInterface $request
       *
       * @return void
       *
       * @throws \Psr\Container\ContainerExceptionInterface
       *
       * @throws \Psr\Container\NotFoundExceptionInterface
      */
      public function send(ServerRequestInterface $request): void
      {
          if (php_sapi_name() !== "cli") {
              $response = $this->app->run($request);
              send($response);
          }
      }



      /**
       * @param App $app
       *
       * @return void
      */
      private function registerModules(App $app): void
      {
           foreach ($this->modules as $module) {
               $app->addModule($module);
           }
      }




      /**
       * @param App $app
       * @return void
      */
      private function registerMiddlewares(App $app): void
      {
          foreach ($this->middlewares as $middleware) {
              $app->pipe($middleware);
          }
      }
}