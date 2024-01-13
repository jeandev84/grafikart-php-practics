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
        * @param string $viewPath
       */
       public function __construct(string $viewPath)
       {
           $this->viewPath = $viewPath;
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
        * @param string $template
        * @param array $data
        * @return string
       */
       public function render(string $template, array $data): string
       {
            $template = new Template($this->viewPath . DIRECTORY_SEPARATOR. $template, $data);

            if ($this->layout) {
                $layout   = new Template($this->viewPath. DIRECTORY_SEPARATOR . $this->layout, $data);
                return  str_replace("{{ content }}", (string)$template, (string)$layout);
            }

            return (string)$template;
       }
}