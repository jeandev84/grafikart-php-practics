<?php
declare(strict_types=1);

namespace Framework\Session;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @ArraySession
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Session
 */
class ArraySession implements SessionInterface
{


    protected array $session = [];



    /**
     * @inheritDoc
    */
    public function get(string $key, $default = null): mixed
    {
        return $this->session[$key] ?? $default;
    }




    /**
     * @inheritDoc
     */
    public function set(string $key, $value): void
    {
        $this->session[$key] = $value;
    }






    /**
     * @inheritDoc
     */
    public function delete(string $key): void
    {
        unset($this->session[$key]);
    }





    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->session);
    }
}