<?php
declare(strict_types=1);

namespace App;

use App\Middleware\RefreshQueryParams;
use App\Middleware\SessionMiddleware;
use App\Providers\RouteServiceProvider;
use App\Providers\ViewServiceProvider;
use App\Providers\WhoopsServiceProvider;
use Grafikart\Container\Container;
use Grafikart\Http\Contract\Terminable;
use Grafikart\Http\HttpKernel;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\Response;
use Grafikart\Pipeline;
use Grafikart\Routing\RouteNotfoundException;
use Grafikart\Routing\Router;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Kernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App
 */
class Kernel extends HttpKernel implements Terminable
{

    protected Container $container;

    protected array $middlewares = [
        SessionMiddleware::class,
        RefreshQueryParams::class
    ];


    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->loadProviders();
    }



    public function loadProviders(): void
    {
        $this->container->addProvider(new WhoopsServiceProvider())
                        ->addProvider(new RouteServiceProvider($this->routePath()))
                        ->addProvider(new ViewServiceProvider($this->viewPath()));
    }




    public function handle(Request $request): Response
    {
        try {
            $response = $this->dispatchRoute($request);
        } catch (\Exception $exception) {
            $response = $this->exceptionResponse($exception);
        }

        return $response;
    }




    public function terminate(Request $request, Response $response)
    {
          echo $response;
    }




    /**
     * @throws RouteNotfoundException
    */
    protected function dispatchRoute(Request $request): Response
    {
         $this->container->bind(Request::class, $request);

         return (new Pipeline($this->container, $this->container['router']))
                ->middlewares($this->middlewares)
                ->handle($request);
    }


    protected function exceptionResponse(\Exception $e): Response
    {
        dd($e);
        dump($e);
        $code = $e->getCode() ?? 500;
        $content = $this->container['view']->render("errors/$code");
        return new Response($content, $code);
    }


    public function getProjectDir(): string
    {
         return dirname(__DIR__);
    }


    private function viewPath(): string
    {
         return $this->getProjectDir() . '/views';
    }


    private function routePath(): string
    {
        return $this->getProjectDir() . "/routes/web.php";
    }



    public function process(): void
    {

       $request = \Grafikart\Http\Request\Request::createFromGlobals();

       # Middlewares
        if ($request->queries->equalTo('page', '1')) {
            // Reecrire l' url sans le parametre ?page
            # Example if URL : http://localhost:8000/blog/tutoriels?page=1&param2=2
            # will be redirect to http://localhost:8000/blog/tutoriels?param2=2
            $request->queries->remove('page');
            $uri = $request->uri($request->queries->all());
            http_response_code(301);
            header('Location: '. $uri);
            exit();
        }

        // HTTP Request
        $request = \Grafikart\Http\Request\Request::createFromGlobals();
        $router = require $this->routePath();
        $router->run();
    }
}


/*
// Kernel
$kernel = new \App\Kernel();
$response = $kernel->handle(
    $request = \Grafikart\Http\Request\Request::createFromGlobals()
);

$response->send();
*/