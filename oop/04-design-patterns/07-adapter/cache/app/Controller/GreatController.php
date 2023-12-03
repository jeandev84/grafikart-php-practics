<?php
declare(strict_types=1);

namespace App\Controller;


use Grafikart\Cache\CacheInterface;

/**
 * Created by PhpStorm at 03.12.2023
 *
 * @GreatController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Controller
*/
class GreatController
{
     public function sayHello(CacheInterface $cache): string
     {
         if ($cache->has('hello')) {
             return $cache->get('hello');
         } else {
             sleep(4);
             $content = "Hello";
             $cache->set('hello', $content);
             return $content;
         }
     }
}