<?php
declare(strict_types=1);

namespace Grafikart\Http\Cookie;


use Grafikart\Http\Session\SessionInterface;

/**
 * Created by PhpStorm at 02.12.2023
 *
 * @Cookie
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Cookie
 */
class Cookie implements SessionInterface
{

    public function get($key)
    {
        return isset($_COOKIE[$key]) ? unserialize($_COOKIE[$key]) : null;
    }

    public function set($key, $value)
    {
        setcookie($key, serialize($value));
    }

    public function has($key)
    {
        return isset($_COOKIE[$key]);
    }

    public function delete($key)
    {
         if ($this->has($key)) {
             unset($_COOKIE[$key]);
             setcookie($key, '', time() - 3600);
         }
    }
}