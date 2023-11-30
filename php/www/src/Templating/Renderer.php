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
         $content  = $this->createTemplate($path, $data)->buffer();
         $template = $this->createTemplate($this->layout, $data);
         return str_replace("{{ content }}", $content, $template->__toString());
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
         dd($content);
         $content  = $this->createTemplate($path, $data)->buffer();
         dd($content);
        $template = $this->createTemplate($this->layout, $data);
        return str_replace("{{ content }}", $content, $template->__toString());
    }
    */
}