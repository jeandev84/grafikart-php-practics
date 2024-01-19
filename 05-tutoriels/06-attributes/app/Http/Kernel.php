<?php
declare(strict_types=1);

namespace App\Http;

use App\Http\Middlewares\CsrfTokenMiddleware;
use App\Http\Middlewares\MethodOverrideMiddleware;
use App\Http\Middlewares\RouteDispatchedMiddleware;
use Exception;
use Grafikart\Container\Container;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Kernel\HttpKernelInterface;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use Grafikart\Http\TerminableInterface;
use Grafikart\Routing\Exception\RouteNotfoundException;
use Grafikart\Routing\Router;
use Grafikart\Security\Token\Csrf\CsrfTokenInterface;
use Grafikart\Templating\Renderer;
use Throwable;


/**
 * Kernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http
 */
class Kernel implements HttpKernelInterface, TerminableInterface
{
    /**
     * @var Container
    */
    protected Container $app;


    /**
     * @var array
    */
    private array $middlewarePriority = [
        MethodOverrideMiddleware::class,
        RouteDispatchedMiddleware::class
    ];


    /**
     * @var Router
    */
    protected Router $router;


    /**
     * @param Container $app
    */
    public function __construct(Container $app)
    {
         $this->app    = $app;
         $this->router = $app[Router::class];
    }



    /**
     * @inheritDoc
    */
    public function handle(ServerRequest $request): Response
    {
        try {
           $response = $this->dispatchRoute($request);
        } catch (Throwable $e) {
           $response = $this->exceptionResponse($e);
        }
        return $response;
    }



    /**
     * @inheritDoc
    */
    public function terminate(ServerRequest $request, Response $response): void
    {
        $response->withProtocolVersion($request->getProtocolVersion());
        echo $response->getBody();
    }





    /**
     * @param ServerRequest $request
     * @return Response
     * @throws Exception
    */
    private function dispatchRoute(ServerRequest $request): Response
    {
        $queueHandler = $this->app[RequestHandlerInterface::class];

        return (new Pipeline($this->app, $queueHandler))
               ->middlewares($this->middlewarePriority)
               ->then($request);
    }






    /**
     * @param Throwable $e
     * @return Response
    */
    private function exceptionResponse(Throwable $e): Response
    {
        $body = $this->app[Renderer::class]->render("errors/500.phtml", [
            'exception' => $e
        ]);

        return new Response($body);
    }
}