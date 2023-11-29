<?php
declare(strict_types=1);

namespace Grafikart\Http\Session;


/**
 * Created by PhpStorm at 29.11.2023
 *
 * @Session
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Session
 */
class Session
{

    protected string $flashKey = 'session.flash';


    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }



    public function has(string $name): bool
    {
        return isset($_SESSION[$name]);
    }



    public function get(string $name, $default = null): mixed
    {
         return $_SESSION[$name] ?? $default;
    }



    public function remove(string $name): bool
    {
         unset($_SESSION[$name]);

         return $this->has($name);
    }



    public function addFlash(string $key, string $message): self
    {
         $_SESSION[$this->flashKey][$key][] = $message;

         return $this;
    }



    public function hasFlash(string $key): bool
    {
         return isset($_SESSION[$this->flashKey][$key]);
    }



    /**
     * @param string $key
     *
     * @return array
    */
    public function getFlash(string $key): array
    {
        return $_SESSION[$this->flashKey][$key] ?? [];
    }




    public function removeFlash(string $key): bool
    {
         unset($_SESSION[$this->flashKey][$key]);

         return $this->hasFlash($key);
    }




    public function getFlashes(): array
    {
        return $this->get($this->flashKey, []);
    }
}