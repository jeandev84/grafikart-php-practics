<?php
declare(strict_types=1);

namespace Grafikart\Routing;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Routing
 */
class Route
{
    public function __construct(
        protected string $method,
        protected string $path,
        protected mixed  $action,
        protected ?string $name = null
    )
    {
    }


    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }


    /**
     * @return string
    */
    public function getPath(): string
    {
        return $this->path;
    }


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * @return mixed
     */
    public function getAction(): mixed
    {
        return $this->action;
    }
}