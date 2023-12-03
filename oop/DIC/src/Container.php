<?php
declare(strict_types=1);

namespace Grafikart;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Container
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 */
class Container
{

    protected array $services  = [];
    protected array $instances = [];

    public function set($id, callable $resolver): self
    {
        $this->services[$id] = $resolver;

        return $this;
    }


    public function get($id): mixed
    {
        if (! isset($this->instances[$id])) {
            $this->instances[$id] = call_user_func($this->services[$id]);
        }

        return $this->instances[$id];
    }
}