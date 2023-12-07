<?php
declare(strict_types=1);

namespace Framework\Templating\Renderer;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @PHPRenderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Templating\Renderer
 */
class PHPRenderer implements RendererInterface
{

      const DEFAULT_NAMESPACE = '__MAIN';


      /**
       * @var array
      */
      protected array $paths = [];



      /**
       * @var array
      */
      protected array $globals = [];




      /**
       * @param string|null $defaultPath
      */
      public function __construct(?string $defaultPath = null)
      {
            if ($defaultPath) {
                $this->addPath($defaultPath);
            }
      }




      /**
       * @inheritdoc
      */
      public function addPath(string $namespace, ?string $path = null): void
      {
           if (is_null($path)) {
               $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
           } else {
               $this->paths[$namespace] = $path;
           }
      }


      /**
       * @inheritdoc
      */
      public function addGlobal(string $key, mixed $value): void
      {
          $this->globals[$key] = $value;
      }




       /**
        * @inheritdoc
       */
      public function render(string $view, array $params = []): string
      {
          if ($this->hasNamespace($view)) {
              $path = $this->replaceNamespace($view) . ".php";
          } else {
              $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
          }

          ob_start();
          $renderer = $this;
          extract($this->globals);
          extract($params);
          require($path);
          return ob_get_clean();
      }



      private function hasNamespace(string $view): bool
      {
           return $view[0] === '@';
      }


      private function getNamespace(string $view): string
      {
          return substr($view, 1, strpos($view, '/') - 1);
      }



      private function replaceNamespace(string $view): string
      {
          $namespace = $this->getNamespace($view);

          return str_replace("@$namespace", $this->paths[$namespace], $view);
      }
}