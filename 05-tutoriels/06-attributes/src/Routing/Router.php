<?php
declare(strict_types=1);

namespace Grafikart\Routing;


/**
 * Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package  Grafikart\Routing
 */
class Router
{

    /**
     * @var Route[]
    */
    protected array $routes = [];


    /**
     * @var Route[]
    */
    protected array $namedRoutes = [];





    /**
     * @param Route $route
     * @return Route
    */
    public function add(Route $route): Route
    {
        $this->routes[] = $route;

        if ($name = $route->getName()) {
            $this->namedRoutes[$name] = $route;
        }

        return $route;
    }




    /**
     * @param string $methods
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
    */
    public function map(string $methods, string $path, callable|array $callback, string $name = ''): Route
    {
        $methods = explode('|', $methods);

        return $this->add(new Route($methods, $path, $callback, $name));
    }




    /**
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
    */
    public function get(string $path, callable|array $callback, string $name = ''): Route
    {
        return $this->map('GET', $path, $callback, $name);
    }




    /**
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
    */
    public function post(string $path, callable|array $callback, string $name = ''): Route
    {
        return $this->map('POST', $path, $callback, $name);
    }




    /**
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
     */
    public function put(string $path, callable|array $callback, string $name = ''): Route
    {
        return $this->map('PUT', $path, $callback, $name);
    }





    /**
     * @param string $path
     * @param callable|array $callback
     * @param string $name
     * @return Route
     */
    public function delete(string $path, callable|array $callback, string $name = ''): Route
    {
        return $this->map('DELETE', $path, $callback, $name);
    }


    /**
     * @param string $controller
     * @return void
     * @throws \ReflectionException
     */
    public function registerController(string $controller): void
    {
        $class = new \ReflectionClass($controller);
        #dump($class);
        #dump($class->getAttributes());

        $routeAttributes = $class->getAttributes(\Grafikart\Routing\Attributes\Route::class);
        $prefix = '';
        if (!empty($routeAttributes)) {
             $prefix = $routeAttributes[0]->newInstance()->getPath();
             #$prefix  = '/'. trim($prefix, '/') . '/';
             #dump($prefix);
        }


        foreach ($class->getMethods() as $method) {
            /*
            #dump($method->getAttributes());
            # $routes = $method->getAttributes(\Grafikart\Routing\Attributes\Route::class);
            $routes = $method->getAttributes(
                \Grafikart\Routing\Attributes\Route::class,
                \ReflectionAttribute::IS_INSTANCEOF
            );
            dump($routes);
            */

            $routeAttributes = $method->getAttributes(\Grafikart\Routing\Attributes\Route::class);

            if (empty($routeAttributes)) {
                continue;
            }

            foreach ($routeAttributes as $routeAttribute) {
                 /** @var \Grafikart\Routing\Attributes\Route $route */
                 $route = $routeAttribute->newInstance();
                 /*
                 # dump($prefix . '/'. ltrim('/', $route->getPath()));
                 // $httpMethod = $route->getMethodsAsString();
                 // dump($method->getParameters());
                 $parameters = $method->getParameters();
                 if (count($parameters) === 2) {
                     dd($parameters);
                 }
                 */

                /*
                 $params = [];
                 $args = []; // from request
                 foreach ($method->getParameters() as $parameter) {
                     if ($parameter->getName() === 'request') {
                         #$params[] = new ($parameter->getName());
                         $params[] = match ($parameter->getName()) {
                            'request'  => new ($parameter->getName()),
                            'response' => new ($parameter->getName()),
                             default => $args[$parameter->getName()] ?? null
                         };
                     }
                 }
                */

                 $this->map(
                     $route->getMethods(),
                $prefix . $route->getPath(),
                     [$controller, $method->getName()],
                     $route->getName()
                 )->wheres($route->getRequirements());
            }
        }
    }



    public function registerFromMethods(string $controller): void
    {
        $class = new \ReflectionClass($controller);

        foreach ($class->getMethods() as $method) {
            /*
            #dump($method->getAttributes());
            # $routes = $method->getAttributes(\Grafikart\Routing\Attributes\Route::class);
            $routes = $method->getAttributes(
                \Grafikart\Routing\Attributes\Route::class,
                \ReflectionAttribute::IS_INSTANCEOF
            );
            dump($routes);
            */

            $routeAttributes = $method->getAttributes(\Grafikart\Routing\Attributes\Route::class);

            if (empty($routeAttributes)) {
                continue;
            }

            foreach ($routeAttributes as $routeAttribute) {
                /** @var \Grafikart\Routing\Attributes\Route $route */
                $route = $routeAttribute->newInstance();
                $this->map(
                    $route->getMethods(),
                    $route->getPath(),
                    [$controller, $method->getName()],
                    $route->getName()
                )->wheres($route->getRequirements());
            }
        }
    }


    /**
     * @param array $controllers
     * @return $this
     */
    public function registerControllers(array $controllers): static
    {
        foreach ($controllers as $controller) {
            $this->registerController($controller);
        }

        return $this;
    }


    

    /**
     * @param string $requestMethod
     * @param string $requestPath
     * @return Route|bool
    */
    public function match(string $requestMethod, string $requestPath): Route|bool
    {
         foreach ($this->routes as $route) {
             if ($route->match($requestMethod, $requestPath)) {
                 return $route;
             }
         }

         return false;
    }


    
    /**
     * @param string $name
     * @param array $params
     * @return string
    */
    public function generate(string $name, array $params = []): string
    {
         if (! isset($this->namedRoutes[$name])) {
              return '';
              /* throw new \InvalidArgumentException("Could not resolve named route $name"); */
         }
         
         return $this->namedRoutes[$name]->generate($params);
    }
    
    


    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }




    /**
     * @return array
    */
    public function getNamedRoutes(): array
    {
        return $this->namedRoutes;
    }
}