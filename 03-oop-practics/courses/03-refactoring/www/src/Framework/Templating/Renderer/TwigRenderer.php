<?php
declare(strict_types=1);

namespace Framework\Templating\Renderer;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @TwigRenderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Templating\Renderer
 *
 * Decorator
 */
class TwigRenderer implements RendererInterface
{


    protected Environment $twig;
    protected LoaderInterface $loader;


    public function __construct(Environment $twig)
    {
        $this->twig    = $twig;
        $this->loader  = $twig->getLoader();
    }




    /**
     * @inheritDoc
    */
    public function addPath(string $namespace, ?string $path = null): void
    {
         $this->loader->addPath($path, $namespace);
    }




    /**
     * @inheritDoc
    */
    public function addGlobal(string $key, mixed $value): void
    {
          $this->twig->addGlobal($key, $value);
    }




    /**
     * @inheritDoc
    */
    public function render(string $view, array $params = []): string
    {
         return $this->twig->render($view . ".twig", $params);
    }


    /**
     * @return Environment
    */
    public function getTwig(): Environment
    {
        return $this->twig;
    }
}