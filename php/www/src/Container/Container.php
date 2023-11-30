<?php
declare(strict_types=1);

namespace Grafikart\Container;


use Grafikart\Container\Exceptions\ContainerException;
use Grafikart\Container\Provider\ServiceProvider;

/**
 * Created by PhpStorm at 29.11.2023
 *
 * @Container
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Container
 */
class Container implements \ArrayAccess
{

     protected array $bindings = [];


     protected array $providers = [];



    /**
     * @param string $id
     * @param $value
     * @return $this
     */
     public function bind(string $id, $value): self
     {
         if ($value instanceof \Closure) {
             $value = $value();
         }

         $this->bindings[$id] = $value;

         return $this;
     }




     public function hasProvider(string $name): bool
     {
         return array_key_exists($name, $this->providers);
     }


     public function addProvider(ServiceProvider $provider): self
     {
          $providerName = get_class($provider);
          if (! $this->hasProvider($providerName)) {
              $provider->register($this);
              $this->providers[$providerName] = $provider;
          }

          return $this;
     }



    /**
     * @param string $id
     * @return bool
     */
     public function has(string $id): bool
     {
         return isset($this->bindings[$id]);
     }


    /**
     * @param string $id
     * @return mixed
     * @throws ContainerException
     */
     public function get(string $id): mixed
     {
         try {
             return $this->bindings[$id] ?? null;
         } catch (\Exception $e) {
              throw new ContainerException($e->getMessage());
         }
     }



     public function remove(string $id): bool
     {
          if (! $this->has($id)) {
              return false;
          }

          unset($this->bindings[$id]);
          return $this->has($id);
     }


     protected function resolve(string $id, array $params = []): mixed
     {
           return [$id, $params];
     }

     public function offsetExists(mixed $offset): bool
     {
         return $this->has($offset);
     }


    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }


    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->bind($offset, $value);
    }


    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }
}