<?php
declare(strict_types=1);

namespace Grafikart\Cache;


/**
 * Created by PhpStorm at 03.12.2023
 *
 * @CacheInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Cache
 */
interface CacheInterface
{
      public function get($key): mixed;

      public function has($key): bool;


      public  function set($key, $value, $ttl = 3600);
}