<?php
declare(strict_types=1);

namespace Grafikart\Http\Request;


use Grafikart\Http\Bag\FileBag;
use Grafikart\Http\Bag\InputBag;
use Grafikart\Http\Bag\ParameterBag;
use Grafikart\Http\Bag\ServerBag;
use Grafikart\Http\Cookie\CookieJar;

/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Request
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Request
 */
class Request
{

      public InputBag $queries;
      public InputBag $request;
      public ParameterBag $attributes;
      public FileBag $files;
      public ServerBag $server;
      public CookieJar $cookies;
      protected ?Uri $uri = null;



      public function __construct()
      {
           $this->queries    = new InputBag();
           $this->request    = new InputBag();
           $this->attributes = new ParameterBag();
           $this->server     = new ServerBag();
           $this->files      = new FileBag();
           $this->cookies    = new CookieJar(); //TODO code reviews
      }




      public function withQueryParams(array $queries): self
      {
           $this->queries->merge($queries);

           return $this;
      }




      /**
       * @return array
      */
      public function getQueryParams(): array
      {
          return $this->queries->all();
      }




      public function withParsedBody(array $body): self
      {
           $this->request->merge($body);

           return $this;
      }




      /**
       * @return array
      */
      public function getParsedBody(): array
      {
          return $this->request->all();
      }




      public function withUploadedFiles(array $uploadedFiles): self
      {
           $this->files->merge($uploadedFiles);

           return $this;
      }



      public function getUploadedFiles(): array
      {
          return $this->files->all();
      }




      public function withAttributes(array $attributes): self
      {
          $this->attributes->merge($attributes);

          return $this;
      }



      /**
       * @return array
      */
      public function getAttributes(): array
      {
          return $this->attributes->all();
      }




      public function withServerParams(array $server): self
      {
          $this->server->merge($server);

          return $this;
      }




      public function getServerParams(): array
      {
           return $this->server->all();
      }




      public function withCookieParams(array $cookies): self
      {
           $this->cookies->add($cookies);

           return $this;
      }




      /**
       * @return array
      */
      public function getCookieParams(): array
      {
          return $this->cookies->all();
      }



      public function withUri(Uri $uri): self
      {
           $this->uri = $uri;

           return $this;
      }




      public function getUri(): Uri
      {
           if ($this->uri) { return $this->uri; }

           return new Uri($this->server->generateUrl());
      }




      public function getMethod()
      {
          return $this->server->get('REQUEST_METHOD', 'GET');
      }



      public function isMethod(string $method): bool
      {
          return  $this->getMethod() === strtoupper($method);
      }

      public function getRequestUri(): string
      {
          return $this->server->get('REQUEST_URI');
      }



      public function getPath(): string
      {
          $path = parse_url($this->getRequestUri(), PHP_URL_PATH);

          return urldecode($path);
      }



      public function getParsedBodyWithFiles(): array
      {
           return array_merge($this->request->all(), $this->files->all());
      }



      public function uri(array $queries = []): string
      {
          $path = $this->getPath();
          $qs   = http_build_query($queries);
          if(!empty($qs)) { $path = $path . "?". $qs;}

          return $path;
      }


      public static function createFromGlobals(): self
      {
          $request = new static();
          $request->withQueryParams($_GET)
                  ->withParsedBody($_POST)
                  ->withUploadedFiles($_FILES)
                  ->withServerParams($_SERVER)
                  ->withCookieParams($_COOKIE);

          return $request;
      }
}