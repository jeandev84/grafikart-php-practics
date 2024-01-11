<?php
declare(strict_types=1);

namespace Grafikart\Http\Session;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @Session
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Session
 *
 * @see cartalyst/sentry
 */
class Session implements SessionInterface, \Countable, \ArrayAccess
{

    public function __construct()
    {
         session_start();
    }


    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function has($key)
    {
         return isset($_SESSION[$key]);
    }

    public function delete($key)
    {
         unset($_SESSION[$key]);
    }

    public function count(): int
    {
        return count($_SESSION);
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
         $this->set($offset, $value);
    }



    public function offsetUnset(mixed $offset): void
    {
         $this->delete($offset);
    }
}