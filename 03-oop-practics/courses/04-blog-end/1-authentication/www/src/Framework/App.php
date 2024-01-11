<?php
declare(strict_types=1);

namespace Framework;


use DI\ContainerBuilder;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\Common\Cache\FilesystemCache;
use Framework\Middleware\RoutePrefixedMiddleware;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Routing\Router;
use Psr\Http\Server\RequestHandlerInterface;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @App
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework
*/
class App implements RequestHandlerInterface
{

       /**
        * @var ContainerInterface|null
       */
       protected ?ContainerInterface $container = null;


       /**
        * List of modules
        *
        * @var string[]
       */
       protected array $modules = [];




       /**
        * List of Middlewares
        *
        * @var array
       */
       protected array $middlewares = [];



       /**
        * @var int
       */
       protected int $index = 0;



       /**
        * global configuration path modules
        *
        * @var string
       */
       protected string $definition;




       /**
        * @param string $definition
       */
       public function __construct(string $definition)
       {
           $this->definition = $definition;
       }




       /**
        * Rajoute un module
        *
        * @param string $module
        *
        * @return $this
       */
       public function addModule(string $module): self
       {
           $this->modules[] = $module;

           return $this;
       }


       /**
        * Rajoute un middleware ( en un mot rajoute un comportement )
        *
        * @param string $routePrefix
        * @param string|null $middleware
        *
        * @return $this
       */
       public function pipe(string $routePrefix, ?string $middleware = null): self
       {
           if (is_null($middleware)) {
               $this->middlewares[] = $routePrefix;
           } else {
               $this->middlewares[] = new RoutePrefixedMiddleware(
                   $this->getContainer(),
                   $routePrefix,
                   $middleware
               );
           }


           return $this;
       }





       /**
        * @param ServerRequestInterface $request
        *
        * @return ResponseInterface
        *
        * @throws ContainerExceptionInterface
        *
        * @throws NotFoundExceptionInterface
       */
       public function handle(ServerRequestInterface $request): ResponseInterface
       {
            $middleware = $this->getMiddleware();

            if (is_null($middleware)) {
                throw new \Exception("Aucun middleware n' a intercepter cette requette");
            } elseif (is_callable($middleware)) {
                return call_user_func_array($middleware, [$request, [$this, 'handle']]);
            } elseif ($middleware instanceof MiddlewareInterface) {
                 return $middleware->process($request, $this);
            }
       }




       /**
        * @param ServerRequestInterface $request
        * @return ResponseInterface
        * @throws ContainerExceptionInterface
        * @throws NotFoundExceptionInterface
       */
       public function run(ServerRequestInterface $request): ResponseInterface
       {
           # Initialize modules
           foreach ($this->modules as $module) {
               $this->getContainer()->get($module);
           }

           return $this->handle($request);
       }




       /**
        * @return ContainerInterface
       */
       public function getContainer(): ContainerInterface
       {
           if (is_null($this->container)) {
               $builder = new ContainerBuilder();
               $env     = getenv('ENV') ?: 'production';
               if ($env === 'production') {
                   # $builder->setDefinitionCache(new ApcuCache());
                   $builder->setDefinitionCache(new FilesystemCache('tmp/di'));
                   $builder->writeProxiesToFile(true, 'tmp/proxies');
               }
               $builder->addDefinitions($this->definition);
               foreach ($this->modules as $module) {
                   if ($module::DEFINITIONS) {
                       $builder->addDefinitions($module::DEFINITIONS);
                   }
               }
               $this->container = $builder->build();
           }

           return $this->container;
       }


      /**
       * @return array
      */
      public function getModules(): array
      {
          return $this->modules;
      }


     /**
      * @return array
     */
     public function getMiddlewares(): array
     {
          return $this->middlewares;
     }


       /**
        * @return callable|null
        * @throws ContainerExceptionInterface
        * @throws NotFoundExceptionInterface
       */
       private function getMiddleware(): ?object
       {
           $container = $this->getContainer();
           if (array_key_exists($this->index, $this->middlewares)) {
               $middleware = $this->middlewares[$this->index];
               if (is_string($this->middlewares[$this->index])) {
                   $middleware =  $container->get($this->middlewares[$this->index]);
               }
               $this->index++;
               return $middleware;
           }

           return null;
       }
}