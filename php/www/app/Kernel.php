<?php
declare(strict_types=1);

namespace App;

use App\Providers\RouteServiceProvider;
use App\Providers\WhoopsServiceProvider;
use Grafikart\Container\Container;
use Grafikart\Http\Contract\Terminable;
use Grafikart\Http\HttpKernel;
use Grafikart\Http\Request\Request;
use Grafikart\Http\Response\Response;


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


    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->loadProviders();
    }



    public function loadProviders(): void
    {
        $this->container->addProvider(new WhoopsServiceProvider())
                        ->addProvider(new RouteServiceProvider($this->routePath()));
    }




    public function handle(Request $request): Response
    {
        try {

        } catch (\Exception $exception) {

        }

        return new Response('');
    }



    public function terminate(Request $request, Response $response)
    {

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