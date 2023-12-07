<?php
declare(strict_types=1);

namespace Framework\Session;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @SessionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Session
 */
interface SessionInterface
{

     /**
      * @param string $key
      * @param $default
      * @return mixed
     */
     public function get(string $key, $default = null): mixed;




     /**
      * @param string $key
      *
      * @param $value
      *
      * @return void
     */
     public function set(string $key, $value): void;





     /**
      * @param string $key
      *
      * @return void
     */
     public function delete(string $key): void;





     /**
      * @param string $key
      *
      * @return bool
     */
     public function has(string $key): bool;
}