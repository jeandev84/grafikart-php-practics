<?php
declare(strict_types=1);

namespace Grafikart\Container;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @App
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Container
 */
class Container implements \ArrayAccess
{

      protected array $bindings = [];
      protected static $instance;


      public function __construct(array $bindings = [])
      {
          $this->bindings($bindings);
      }



      /**
       * @param array $bindings
       *
       * @return $this
      */
      public function bindings(array $bindings): self
      {
           foreach ($bindings as $id => $value) {
               $this->bind($id, $value);
           }

           return $this;
      }




      public function bind(string $id, $value): self
      {
          $this->bindings[$id] = $value;

          return $this;
      }


      public function has(string $id): bool
      {
          return isset($this->bindings[$id]);
      }



      public function get(string $id): mixed
      {
          if (! $this->has($id)) { return $id; }

          $value = $this->bindings[$id];

          if (is_callable($value)) {
              $value = call_user_func($value, $this);
          }

          return $value;
      }




      public function remove(string $id): bool
      {
           if ($this->has($id)) {
               unset($this->bindings[$id]);
           }

           return $this->has($id);
      }




     public static function instance(): self
     {
         if (! self::$instance) {
            self::$instance = new self();
         }

         return self::$instance;
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


    public function __set(string $name, $value): void
    {
        $this->bind($name, $value);
    }

    public function __get(string $name)
    {
         return $this->get($name);
    }
}