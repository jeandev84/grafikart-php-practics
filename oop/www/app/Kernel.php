<?php
declare(strict_types=1);

namespace App;

use Exception;
use Grafikart\Container\Container;
use Grafikart\Http\Request;
use Grafikart\Http\Response;
use Grafikart\Routing\Route;
use Grafikart\Templating\Layout;
use Grafikart\Templating\Template;



/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Kernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @namespace App
 */
class Kernel
{


    protected Container $app;


    /**
     * @param Container $app
    */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }



    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        try {
            return $this->dispatchRoute($request);
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }




    /**
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function terminate(Request $request, Response $response)
    {
        $response->sendBody();
    }



    private function dispatchRoute(Request $request): Response
    {
        $path = $request->getPath();

        /** @var Route $route */
        if (! $route = $this->app['router']->match($request->getMethod(), $path)) {
            throw new \Grafikart\Routing\NotfoundException($path);
        }

        $request->withAttributes($route->getParams());
        $target = $route->getAction();

        if (is_callable($target)) {
             return call_user_func_array($target, [$this->app, $request]);
        }

        [$controller, $action] = explode('::', $target);
        return call_user_func_array([new $controller($this->app), $action], [$request]);
    }



    private function exceptionResponse(Exception $e): Response
    {
        $code = $e->getCode();
        $code = ($code !== 404 ? 500 : $code);

        $content = $this->app['view']->render(
            new Template($this->app['root'] ."/views/errors/$code.php", [
                'message' => $e->getMessage(),
                'tracing' => $e->getTraceAsString()]
            ),
        );

        return new Response($content, $code);
    }
}