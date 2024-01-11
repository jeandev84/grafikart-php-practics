<?php
declare(strict_types=1);

namespace App\Http\Bag;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @ParameterBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Http\Bag
 */
class ParameterBag
{

      protected array $params = [];


      /**
       * @param array $params
      */
      public function __construct(array $params = [])
      {
          $this->merge($params);
      }





      /**
       * @param string $name
       *
       * @param $value
       *
       * @return $this
      */
      public function set(string $name, $value): self
      {
          $this->params[$name] = $value;

          return $this;
      }






      /**
       * @param string $name
       *
       * @return bool
      */
      public function empty(string $name): bool
      {
          return empty($this->params[$name]);
      }





      /**
       * @return int
      */
      public function count(): int
      {
          return count($this->params);
      }





      /**
       * @param string $key
       *
       * @param $default
       *
       * @return mixed
      */
      public function get(string $key, $default = null): mixed
      {
          return $this->params[$key] ?? $default;
      }





      /**
       * @return array
      */
      public function all(): array
      {
          return $this->params;
      }




      /**
       * @param string $key
       *
       * @return bool
      */
      public function has(string $key): bool
      {
           return isset($this->params[$key]);
      }






      /**
       * @param array $params
       *
       * @return $this
      */
      public function merge(array $params): self
      {
           $this->params = array_merge($this->params, $params);

           return $this;
      }


      /**
       * @param string $key
       * @param int $default
       * @return int
      */
      public function getInt(string $key, int $default = 0): int
      {
          return (int)$this->get($key, $default);
      }




      /**
       * @param string $key
       *
       * @param float $default
       *
       * @return float
      */
      public function getFloat(string $key, float $default = 0.0): float
      {
          return (float)$this->get($key, $default);
      }



      /**
       * @param string $key
       * @param bool $default
       * @return bool
      */
      public function getBoolean(string $key, bool $default = false): bool
      {
           return (bool)$this->get($key, $default);
      }





      /**
       * @param string $key
       * @param string $default
       * @return string
      */
      public function getAlphaNum(string $key, string $default = ''): string
      {
          return (string)$this->get($key, $default);
      }
}