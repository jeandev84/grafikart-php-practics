<?php
declare(strict_types=1);

namespace Framework\Templating;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @Renderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Templating
 */
class Renderer
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
       * Permet de rajouter un chemin pour changer les vues
       *
       * @param string $namespace
       *
       * @param string|null $path
       *
       * @return void
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
       * Permet d' ajout des variables globales a toutes les vues
       *
       * @param string $key
       * @param mixed $value
       * @return void
      */
      public function addGlobal(string $key, mixed $value): void
      {
          $this->globals[$key] = $value;
      }




       /**
        * Permet de rendre une vue
        *
        * Le chemin peut etre precise avec le namespace rajoutes via addPath()
        *
        * $this->render('@blog/view')
        * $this->render('view')
        *
        * @param string $view
        * @param array $params
        * @return string
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