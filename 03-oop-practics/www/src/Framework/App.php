<?php
declare(strict_types=1);

namespace Framework;


use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Routing\Router;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @App
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework
*/
class App
{

       /**
        * List of modules
        *
        * @var array
       */
       protected array $modules = [];


       /**
        * @var Router
       */
       protected Router $router;


       /**
        * App constructor
        *
        * @param string[] $modules Liste des modules a charger
       */
       public function __construct(array $modules = [])
       {
           $this->router = new Router();
           foreach ($modules as $module) {
               $this->modules[] = new $module($this->router);
           }
       }





       /**
        * @param ServerRequestInterface $request
        * @return ResponseInterface
       */
       public function run(ServerRequestInterface $request): ResponseInterface
       {
           $uri = $request->getUri()->getPath();

           if (!empty($uri) && $uri[-1] === "/") {
               return (new Response())
                      ->withStatus(301)
                      ->withHeader('Location', substr($uri, 0, -1));
           }

           $route = $this->router->match($request);

           if (! $route) {
               return new Response(404, [], '<h1>Error 404</h1>');
           }

           $params  = $route->getParams();
           $request = array_reduce(array_keys($params), function (ServerRequestInterface $request, $key) use ($params) {
               return $request->withAttribute($key, $params[$key]);
           }, $request);

           $response = call_user_func_array($route->getAction(), [$request]);

           if (is_string($response)) {
               return new Response(200, [], $response);
           } elseif ($response instanceof ResponseInterface) {
               return $response;
           } else {
               throw new \Exception("The response is not a string of an instance of ResponseInterface");
           }
       }
}