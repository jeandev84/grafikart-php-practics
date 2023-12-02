<?php
declare(strict_types=1);

namespace Grafikart\Config;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @Config
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Config
 */
class Config implements \ArrayAccess
{

     protected array $settings = [];

     public function __construct(array $settings)
     {
         #$this->settings = require dirname(__DIR__).'/config/app.php';
         $this->settings = $settings;
     }


    public function offsetExists(mixed $offset): bool
    {
         return isset($this->settings[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->settings[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->settings[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
         unset($this->settings[$offset]);
    }
}