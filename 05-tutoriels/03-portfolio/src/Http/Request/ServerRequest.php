<?php
declare(strict_types=1);

namespace Grafikart\Http\Request;

use Grafikart\Http\MessageTrait;
use Grafikart\Http\Request\Exception\UploadedFileException;

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
      protected array $parsedBody = [];



      /**
       * @var array
      */
      protected array $cookieParams = [];



      /**
       * @var UploadedFileInterface[]
      */
      protected array $uploadedFiles = [];


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
    public function getAttributes(): array
    {
        return $this->attributes;
    }


    /**
     * @param string $name
     * @param $default
     * @return mixed
     */
    public function getAttribute(string $name, $default = null): mixed
    {
        return $this->attributes[$name] ?? $default;
    }


     /**
      * @return array
     */
     public function getQueryParams(): array
     {
         return $this->queryParams;
     }




     /**
      * @param array $cookieParams
      * @return $this
     */
     public function withCookieParams(array $cookieParams): static
     {
         $this->cookieParams = $cookieParams;

         return $this;
     }




    /**
     * @return array
    */
    public function getCookieParams(): array
    {
        return $this->cookieParams;
    }




     /**
      * @param UploadedFileInterface[] $uploadedFiles
      * @return $this
     */
     public function withUploadedFiles(array $uploadedFiles): static
     {
          $this->uploadedFiles = $uploadedFiles;

          return $this;
     }






    /**
     * @return UploadedFileInterface[]
    */
    public function getUploadedFiles(): array
    {
        return $this->uploadedFiles;
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
       * @throws UploadedFileException
      */
      public static function fromGlobals(): static
      {
          $request = new self(
              $_SERVER['REQUEST_METHOD'],
              $_SERVER['REQUEST_URI'],
              $_SERVER
          );

          $request->withQueryParams($_GET)
                  ->withParsedBody($_POST)
                  ->withCookieParams($_COOKIE)
                  ->withUploadedFiles(self::normalizeFiles($_FILES))
                  ->withProtocolVersion($_SERVER['SERVER_PROTOCOL']);

          return $request;
      }


     /**
      * @param array $files
      *
      * @return UploadedFileInterface[]
     * @throws UploadedFileException
     */
      public static function normalizeFiles(array $files): array
      {
          $normalized = [];
          foreach (self::transformFiles($files) as $id => $uploadedFiles) {
              foreach ($uploadedFiles as $uploadedFile) {
                   if (is_array($uploadedFile)) {
                       $uploadedFile = UploadedFileFactory::createFromArray($uploadedFile);
                   }
                   if (! $uploadedFile instanceof UploadedFileInterface) {
                       throw new UploadedFileException("Could not normalize uploaded file type : ". gettype($uploadedFile));
                   }
                   if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                       $normalized[$id][] = $uploadedFile;
                   }
              }
          }

          return $normalized;
      }




      /**
       * @param array $files
       * @return array
      */
      public static function transformFiles(array $files): array
      {
          $transformed = [];

          foreach ($files as $name => $fileInfo) {
              if (is_array($fileInfo['name'])) {
                  foreach ($fileInfo as $attribute => $file) {
                      foreach ($file as $index => $value) {
                          $transformed[$name][$index][$attribute] = $value;
                      }
                  }
              } else {
                  $transformed[$name][] = $fileInfo;
              }
          }

          return $transformed;
      }
}