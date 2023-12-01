<?php
declare(strict_types=1);

namespace Grafikart\Http;


use Grafikart\Http\Bag\InputBag;
use Grafikart\Http\Bag\ServerBag;

/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Request
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http
 */
class Request
{
     public InputBag $queries;
     public InputBag $requests;
     public ServerBag $server;


     public function __construct()
     {
         $this->queries  = new InputBag();
         $this->requests = new InputBag();
         $this->server   = new ServerBag();
     }



     public function withQueryParams(array $queries): self
     {
          $this->queries->merge($queries);

          return $this;
     }




    /**
     * @return array
    */
    public function getQueries(): array
    {
        return $this->queries->all();
    }



    public function getParsedBody(): array
    {
         return $this->requests->all();
    }



    public function withParsedBody(array $parsedBody): self
    {
         $this->requests->merge($parsedBody);

         return $this;
    }





    /**
     * @param array $serverParams
     *
     * @return $this
    */
    public function withServerParams(array $serverParams): self
    {
         $this->server->merge($serverParams);

         return $this;
    }


    /**
     * @return array
    */
    public function getServerParams(): array
    {
        return $this->server->all();
    }



    public function getMethod(): string
    {
        return $this->server->getMethod();
    }



    public function getRequestUri(): string
    {
        return $this->server->getRequestUri();
    }




    /**
     * @return self
    */
    public static function createFromGlobals(): self
    {
        $request = new static();
        $request->withQueryParams($_GET)
                ->withParsedBody($_POST)
                ->withServerParams($_SERVER);

        return $request;
    }
}