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
       protected string $viewPath;

       public function __construct(string $viewPath)
       {
           $this->viewPath = $viewPath;
       }



       /**
        * @param string $template
        * @param array $data
        * @return string
       */
       public function render(string $template, array $data): string
       {
            $template = new Template($this->viewPath . DIRECTORY_SEPARATOR. $template, $data);

            return (string)$template;
       }
}