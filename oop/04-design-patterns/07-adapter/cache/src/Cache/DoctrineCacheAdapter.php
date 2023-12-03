<?php
declare(strict_types=1);

namespace Grafikart\Cache;


use Doctrine\Common\Cache\Cache;

/**
 * Created by PhpStorm at 03.12.2023
 *
 * @DoctrineCacheAdapter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Cache
 */
class DoctrineCacheAdapter implements CacheInterface
{

    protected Cache $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }



    public function get($key): mixed
    {
        return $this->cache->fetch($key);
    }

    public function has($key): bool
    {
       return $this->cache->contains($key);
    }


    public function set($key, $value, $ttl = 3600): void
    {
         $this->cache->save($key, $value, $ttl);
    }
}