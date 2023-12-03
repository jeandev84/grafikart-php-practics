<?php
declare(strict_types=1);

namespace Grafikart\Http\Session;


/**
 * Created by PhpStorm at 02.12.2023
 *
 * @SessionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Http\Session
 */
interface SessionInterface
{
      public function get($key);
      public function set($key, $value);
      public function has($key);
      public function delete($key);
}