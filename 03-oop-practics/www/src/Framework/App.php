<?php
declare(strict_types=1);

namespace Framework;


use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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

       public function run(ServerRequestInterface $request): ResponseInterface
       {
           $uri = $request->getUri()->getPath();

           if (!empty($uri) && $uri[-1] === "/") {
               return (new Response())
                      ->withStatus(301)
                      ->withHeader('Location', substr($uri, 0, -1));
           }

           $response = new Response();
           $response->getBody()->write('Bonjour');
           return $response;
       }
}