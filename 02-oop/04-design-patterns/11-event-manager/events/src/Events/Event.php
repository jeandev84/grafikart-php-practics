<?php
declare(strict_types=1);

namespace Grafikart\Events;


use Grafikart\Psr\EventInterface;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @Event
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Events
 */
class Event implements EventInterface
{


    /**
     * @var string
     */
    protected string $name = '';


    /**
     * @var mixed
     */
    protected mixed $target;


    /**
     * @var array
     */
    protected array $params = [];


    /**
     * @var bool
     */
    protected bool $propagationStopped = false;


    public function getName()
    {
        return $this->name;
    }



    public function getTarget(): mixed
    {
        return $this->target;
    }


    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam($name): mixed
    {
        return $this->params[$name] ?? null;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }


    public function setTarget($target)
    {
        $this->target = $target;
    }



    public function setParams(array $params): void
    {
        $this->params = $params;
    }



    public function stopPropagation($flag): void
    {
        $this->propagationStopped = $flag;
    }



    public function isPropagationStopped(): bool
    {
         return $this->propagationStopped;
    }
}