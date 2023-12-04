<?php
namespace Framework\Routing\Resource;

use Framework\Routing\Resource\Contract\Resource;
use Framework\Routing\Resource\Types\ResourceType;
use Framework\Routing\Router;


/**
 * @inheritdoc
*/
class ApiResource extends Resource
{

    /**
     * @inheritDoc
    */
    public function map(Router $router): static
    {
        $router->map('GET|HEAD', $this->path(), $this->action('index'), $this->name('index'));
        $router->get($this->path('/{id}'), $this->action('show'), $this->name('show'));
        $router->post($this->path(), $this->action('store'), $this->name('store'));
        $router->map('PUT|PATCH', $this->path('/{id}'), $this->action('update'), $this->name('update'));
        $router->delete($this->path('/{id}'), $this->action('destroy'), $this->name('destroy'));

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getTypeName(): string
    {
        return ResourceType::API;
    }
}