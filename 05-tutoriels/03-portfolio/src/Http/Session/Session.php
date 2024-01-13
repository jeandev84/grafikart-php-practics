<?php
declare(strict_types=1);

namespace Grafikart\Http\Session;

/**
 * Session
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Session
 */
class Session implements SessionInterface
{

    /**
     * @var string
    */
    private string $flashKey = 'session.flash';


    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
             session_start();
        }
    }



    /**
     * @inheritDoc
    */
    public function set($key, $value): static
    {
        $_SESSION[$key] = $value;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function has($key): bool
    {
        return isset($_SESSION[$key]);
    }





    /**
     * @inheritDoc
    */
    public function get($key, $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }




    /**
     * @inheritDoc
    */
    public function addFlash($key, string $message): static
    {
        $_SESSION[$this->flashKey][$key] = $message;

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getFlash($key): string
    {
        return $_SESSION[$this->flashKey][$key] ?? '';
    }
}