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
    public function forget($key): bool
    {
        unset($_SESSION[$key]);

        return $this->has($key);
    }





    /**
     * @inheritDoc
    */
    public function addFlash($type, string $message): static
    {
        $_SESSION[$this->flashKey][$type] = $message;

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function removeFlashes(): void
    {
        unset($_SESSION[$this->flashKey]);
    }


    /**
     * @inheritdoc
    */
    public function removeFlash($type): void
    {
        unset($_SESSION[$this->flashKey][$type]);
    }



    /**
     * @inheritDoc
    */
    public function getFlash($type): string
    {
        $flash = $_SESSION[$this->flashKey][$type] ?? '';

        # $this->removeFlashes();
        $this->removeFlash($type);

        return $flash;
    }




    /**
     * @inheritdoc
    */
    public function hasFlashes(): bool
    {
        return ! empty($_SESSION[$this->flashKey]);
    }





    /**
     * @return array
    */
    public function getFlashes(): array
    {
        $flashes = $_SESSION[$this->flashKey] ?? [];

        foreach (array_keys($flashes) as $type) {
            $this->removeFlash($type);
        }

        return $flashes;
    }


    /**
     * @inheritDoc
    */
    public function destroy(): bool
    {
        session_destroy();
        $_SESSION = [];
        return true;
    }
}