<?php
declare(strict_types=1);

namespace Grafikart\Http\Cookie;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @CookieJar
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Cookie
 */
class CookieJar
{

     protected array $cookies = [];


     public function __construct(array $cookies = [])
     {
         $this->cookies = $cookies;
     }


     public function add(array $cookies): self
     {
         $this->cookies = array_merge($this->cookies, $cookies);

         return $this;
     }



     public function has(string $name): bool
     {
         return isset($this->cookies[$name]);
     }



     public function get(string $name): mixed
     {
         return $this->cookies[$name] ?? '';
     }




     public function all(): array
     {
         return $this->cookies;
     }
}