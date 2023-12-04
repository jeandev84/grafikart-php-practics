<?php
declare(strict_types=1);

namespace Grafikart\Cache;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @Cache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Cache
 */
class Cache implements CacheInterface
{
     public function get($key): mixed
     {
          return false;
     }


     public function has($key): bool
     {
         return false;
     }


     public function set($key, $value, $ttl = 3600): void
     {

     }
}