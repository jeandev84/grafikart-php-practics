<?php
declare(strict_types=1);

namespace App\Providers;


use Grafikart\Container\Container;
use Grafikart\Container\Provider\ServiceProvider;
use Grafikart\Templating\Renderer;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @ViewServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Providers
 */
class ViewServiceProvider extends ServiceProvider
{

    protected string $viewPath;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
    }

    public function register(Container $container): void
    {
         $container->bind('view', function () {
             return new Renderer($this->viewPath);
         });
    }
}