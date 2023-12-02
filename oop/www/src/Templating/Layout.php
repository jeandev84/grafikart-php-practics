<?php
declare(strict_types=1);

namespace Grafikart\Templating;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Layout
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Templating
 */
class Layout
{



     protected string $path;


     /**
      * @param string $path
     */
     public function __construct(string $path)
     {
         $this->path = $path;
     }




     public function setPath(string $path): self
     {
         $this->path = $path;

         return $this;
     }




     /**
      * @param Template $template
      *
      * @param array $parameters
      *
      * @return string
     */
     public function render(Template $template, array $parameters = []): string
     {
         extract($parameters, EXTR_SKIP);
         $content = $template->__toString();
         ob_start();
         require $this->path;
         return str_replace("{{ content }}", $content, ob_get_clean());
     }
}