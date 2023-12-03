<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use function Http\Response\send;

require __DIR__.'/../vendor/autoload.php';


$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$response = new \GuzzleHttp\Psr7\Response();

$dispatcher = new \Grafikart\Http\Middleware\Dispatcher();
$dispatcher->pipe(new \Psr7Middlewares\Middleware\Whoops());
$dispatcher->pipe(new \App\Middleware\PoweredByMiddleware());
$dispatcher->pipe(new \App\Middleware\TrailingSlashMiddleware());
$dispatcher->pipe(new \Psr7Middlewares\Middleware\FormatNegotiator());
$dispatcher->pipe(new \App\Middleware\GoogleAnalyticMiddleware());
#$dispatcher->pipe(new \App\Middleware\QuoteMiddleware());
$dispatcher->pipe(new \App\Middleware\AppMiddleware());


dd($dispatcher->handle($request));

send($dispatcher->handle($request));
