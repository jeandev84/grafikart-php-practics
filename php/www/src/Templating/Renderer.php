<?php
declare(strict_types=1);

namespace Grafikart\Templating;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Renderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Templating
 */
class Renderer
{

     protected string $viewPath;

     protected string $layout = 'layouts/default';

     public function __construct(string $viewPath)
     {
         $this->viewPath = $viewPath;
     }



     public function layout(string $layout): self
     {
         $this->layout = $layout;

         return $this;
     }


     public function render(string $path, array $data = []): string
     {
         ## TODO refactoring
         extract($data);
         ob_start();
         require $this->loadTemplate($path);
         $content  = ob_get_clean();
         if ($this->layout) {
             require $this->loadTemplate($this->layout);
             return str_replace("{{ content }}", $content, ob_get_clean());
         }
         return $content;
     }



     private function loadTemplate(string $path): string
     {
         return sprintf('%s.php', $this->viewPath . DIRECTORY_SEPARATOR. $path);
     }



     public function createTemplate(string $path, array $data = []): Template
     {
         $path  = sprintf('%s.php', $this->viewPath . DIRECTORY_SEPARATOR. $path);

         return new Template($path, $data);
     }



    /*
    public function renderExample(string $path, array $data = []): string
    {
        // TODO refactoring implements
         $content = file_get_contents($this->viewPath. DIRECTORY_SEPARATOR. $path);
         $content  = $this->createTemplate($path, $data)->buffer();
         dd($content);
        $template = $this->createTemplate($this->layout, $data);
        return str_replace("{{ content }}", $content, $template->__toString());
    }
    */



    public function render3(string $path, array $data = []): string
    {
        extract($data);
        ob_start();
        require $this->loadTemplate($path);
        $content  = ob_get_clean();
        if ($this->layout) {
            require $this->loadTemplate($this->layout);
        }
        return ob_get_clean();
    }
}