<?php
declare(strict_types=1);

namespace Framework\Templating\Renderer;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @RendererInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Templating\Renderer
 */
interface RendererInterface
{

     /**
      * Permet de rajouter un chemin pour changer les vues
      *
      * @param string $namespace
      *
      * @param string|null $path
      *
      * @return void
     */
     public function addPath(string $namespace, ?string $path = null): void;



    /**
     * Permet d' ajout des variables globales a toutes les vues
     *
     * @param string $key
     * @param mixed $value
     * @return void
    */
    public function addGlobal(string $key, mixed $value): void;




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
    public function render(string $view, array $params = []): string;
}