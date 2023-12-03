<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function Http\Response\send;

require __DIR__.'/../vendor/autoload.php';

$trailingSlash = function (ServerRequestInterface $request, ResponseInterface $response, callable $next) {

    $url = (string)$request->getUri();

    if (!empty($url) && $url[-1] === '/') {
       $response = new \GuzzleHttp\Psr7\Response();
       return $response->withHeader('Location', substr($url, 0, -1))
                        ->withStatus(301);
   }

   return $next($request, $response);
};


$quoteMiddleware = function (ServerRequestInterface $request, ResponseInterface $response, callable $next) {
    $response->getBody()->write('"');
    $response = $next($request, $response);
    $response->getBody()->write('"');
    return $response;
};

$app = function (ServerRequestInterface $request, ResponseInterface $response, callable $next) {

    $url = $request->getUri()->getPath();

    if ($url === '/blog') {
        $response->getBody()->write('Je suis sur le blog');
    } elseif ($url === '/contact') {
        $response->getBody()->write('Me contacter');
    } else {
        $response->getBody()->write('Not found');
        $response = $response->withStatus(404);
    }

    return $response;
};

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$response = new \GuzzleHttp\Psr7\Response();

$dispatcher = new \Grafikart\Http\Middleware\Dispatcher();
$dispatcher->pipe($trailingSlash);
$dispatcher->pipe($quoteMiddleware);
$dispatcher->pipe($app);


send($dispatcher->process($request, $response));
