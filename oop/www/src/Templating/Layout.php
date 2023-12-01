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


     /**
      * @param string $path
     */
     public function __construct(protected string $path)
     {
     }




     public function setPath(string $path): self
     {
         $this->path = $path;

         return $this;
     }




     /**
      * @param Template $template
      *
      * @return string
     */
     public function render(Template $template): string
     {
         $layout = file_get_contents($this->path);

         return str_replace("{{ content }}", $template->__toString(), $layout);
     }
}