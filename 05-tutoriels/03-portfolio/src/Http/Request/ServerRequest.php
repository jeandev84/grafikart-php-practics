<?php
declare(strict_types=1);

namespace Grafikart\Http\Request;

use Grafikart\Http\MessageTrait;

/**
 * ServerRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Request
*/
class ServerRequest
{

      use MessageTrait;


      /**
       * @var string
      */
      protected string $method;


      /**
       * @var string
      */
      protected string $uri;



      /**
       * @var array
      */
      protected array $serverParams = [];



     /**
      * @var array
     */
      protected array $queryParams = [];



      /**
       * @var array
      */
      protected array $attributes = [];


      /**
       * @var array
      */
      protected array $parsedBody;



      /**
       * @param string $method
       * @param string $uri
       * @param array $serverParams
      */
      public function __construct(string $method, string $uri, array $serverParams = [])
      {
          $this->method = strtoupper($method);
          $this->uri    = $uri;
          $this->serverParams = $serverParams;
      }




      /**
       * @param string $method
       * @return $this
      */
      public function withMethod(string $method): static
      {
          $this->method = $method;

          return $this;
      }






      /**
       * @param array $queryParams
       * @return $this
      */
      public function withQueryParams(array $queryParams): static
      {
          $this->queryParams = $queryParams;

          return $this;
      }


      /**
       * @param array $attributes
       * @return $this
      */
      public function withAttributes(array $attributes): static
      {
          $this->attributes = $attributes;

          return $this;
      }





     /**
      * @return array
     */
     public function getQueryParams(): array
     {
         return $this->queryParams;
     }






      /**
       * @return string
      */
      public function getMethod(): string
      {
          return $this->method;
      }


      /**
       * @param string $method
       * @return bool
      */
      public function isMethod(string $method): bool
      {
          return $this->method === strtoupper($method);
      }




      /**
       * @return string
      */
      public function getPath(): string
      {
          return parse_url($this->uri, PHP_URL_PATH);
      }





      /**
       * @return array
      */
      public function getParsedBody(): array
      {
         return $this->parsedBody;
      }




      /**
       * @param array $parsedBody
       *
       * @return $this
      */
      public function withParsedBody(array $parsedBody): static
      {
         $this->parsedBody = $parsedBody;

         return $this;
      }




      /**
       * @return static
      */
      public static function fromGlobals(): static
      {
          $request = new self(
              $_SERVER['REQUEST_METHOD'],
              $_SERVER['REQUEST_URI']
          );

          $request->withQueryParams($_GET)
                  ->withParsedBody($_POST)
                  ->withProtocolVersion($_SERVER['SERVER_PROTOCOL']);

          return $request;
      }
}