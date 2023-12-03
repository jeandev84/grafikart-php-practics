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

    protected array $registry  = [];
    protected array $factories = [];
    protected array $instances = [];

    public function bind($id, callable $resolver): self
    {
        $this->registry[$id] = $resolver;

        return $this;
    }


    public function factory($id, callable $resolver): self
    {
         $this->factories[$id] = $resolver;

         return $this;
    }



    public function instance($instance): self
    {
           $reflection = new \ReflectionClass($instance);

           $this->instances[$reflection->getName()] = $instance;

           return $this;
    }




    public function get($id): mixed
    {
        if (isset($this->factories[$id])) {
            return call_user_func($this->factories[$id]);
        }

        if (! isset($this->instances[$id])) {
            if (isset($this->registry[$id])) {
                $this->instances[$id] = call_user_func($this->registry[$id]);
            } else {

                $reflection = new \ReflectionClass($id);

                if($reflection->isInstantiable()) {
                     $parameters  = [];
                     if($constructor = $reflection->getConstructor()) {
                         foreach ($constructor->getParameters() as $parameter) {
                             if ($parameter->getClass()) {
                                  $parameters[] = $this->get($parameter->getClass()->getName());
                             } else {
                                  $parameters[] = $parameter->getDefaultValue();
                             }
                         }
                         $this->instances[$id] = $reflection->newInstanceArgs($parameters);
                     } else {
                         $this->instances[$id] = $reflection->newInstance();
                     }

                } else {
                    throw new \Exception($id . " is not instantiable class.");
                }
            }
        }

        return $this->instances[$id];
    }
}