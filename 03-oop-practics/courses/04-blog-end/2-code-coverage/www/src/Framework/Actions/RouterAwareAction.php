<?php
declare(strict_types=1);

namespace Framework\Actions;


use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @RouterAwareAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Actions
*/
trait RouterAwareAction
{

     /**
      * Renvoie une reponse de redirection
      *
      * @param string $path
      * @param array $parameters
      * @return ResponseInterface
     */
     public function redirect(string $path, array $parameters = []): ResponseInterface
     {
         $redirectUri = $this->router->generateUri($path, $parameters);
         return (new Response())
             ->withStatus(301)
             ->withHeader('Location', $redirectUri);
     }
}