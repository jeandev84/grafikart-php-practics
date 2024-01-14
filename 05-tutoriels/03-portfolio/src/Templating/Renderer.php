<?php
declare(strict_types=1);

namespace Grafikart\Templating;

/**
 * Renderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Templating
 */
class Renderer
{

       /**
        * @var string
       */
       protected string $viewPath;



       /**
        * @var string
       */
       protected string $layout = '';



       /**
        * @var string
       */
       protected string $extension = '';



       /**
        * @var array
       */
       protected array $data = [];




       /**
        * @param string $viewPath
       */
       public function __construct(string $viewPath)
       {
           $this->viewPath = $viewPath;
       }





       /**
        * @param array $data
        * @return $this
       */
       public function addGlobals(array $data): static
       {
           $this->data = array_merge($this->data, $data);

           return $this;
       }






       /**
        * @param string $layout
        * @return $this
       */
       public function layout(string $layout): static
       {
           $this->layout = $layout;

           return  $this;
       }





       /**
        * @param string $extension
        * @return $this
       */
       public function extension(string $extension): static
       {
           $this->extension = $extension;

           return $this;
       }



       /**
        * @param string $template
        * @param array $data
        * @return string
       */
       public function render(string $template, array $data = []): string
       {
            $this->addGlobals($data);

            $template = new Template($this->loadPath($template), $this->data);

            if (! $this->layout) {
                return (string)$template;
            }

            $layout   = new Template($this->loadPath($this->layout) , $this->data);
            return  str_replace("{{ content }}", (string)$template, (string)$layout);
       }





       /**
        * @param string $path
        * @return string
       */
       public function loadPath(string $path): string
       {
           $path = $this->viewPath . DIRECTORY_SEPARATOR. $path;

           if ($this->extension) {
               $path .= ".$this->extension";
           }

           return $path;
       }
}