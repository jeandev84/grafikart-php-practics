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
class Container
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
          if (! array_key_exists($providerName, $this->providers)) {
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


     protected function resolve(string $id, array $params = []): mixed
     {
           return [$id, $params];
     }
}