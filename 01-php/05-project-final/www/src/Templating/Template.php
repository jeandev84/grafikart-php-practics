<?php
declare(strict_types=1);

namespace Grafikart\Templating;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Template
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Templating
 */
class Template implements TemplateInterface
{

      /**
       * @var string
      */
      protected string $path;


      /**
       * @var array
      */
      protected array $parameters = [];



      public function __construct(string $path, array $parameters = [])
      {
           $this->path = $path;
           $this->parameters = $parameters;
      }



      public function getPath(): string
      {
          return $this->path;
      }

      public function getParameters(): array
      {
          return $this->parameters;
      }

      public function __toString(): string
      {
          extract($this->parameters, EXTR_SKIP);
          return file_get_contents($this->path);
      }


      public function buffer(): string
      {
          extract($this->parameters, EXTR_SKIP);
          ob_start();
          require $this->path;
          return ob_get_clean();
      }
}