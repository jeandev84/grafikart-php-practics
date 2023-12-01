<?php
declare(strict_types=1);

namespace Grafikart\Templating;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Template
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Templating
 */
class Template
{

     protected string $path;
     protected array $parameters = [];


     public function __construct(
         string $path,
         array $parameters = []
     )
     {
         $this->path = $path;
         $this->parameters = $parameters;
     }



     /**
      * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }



    /**
     * @return array
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }



    public function __toString(): string
    {
         extract($this->parameters, EXTR_SKIP);
         ob_start();
         require $this->path;
         return ob_get_clean();
    }
}