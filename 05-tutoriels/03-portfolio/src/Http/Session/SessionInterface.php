<?php
declare(strict_types=1);

namespace Grafikart\Http\Session;


/**
 * SessionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Http\Session
 */
interface SessionInterface
{

       /**
        * @param $key
        * @param $value
        * @return mixed
       */
       public function set($key, $value): mixed;





       /**
        * @param $key
        * @return bool
       */
       public function has($key): bool;





       /**
        * @param $key
        * @param $default
        * @return mixed
       */
       public function get($key, $default = null): mixed;




       /**
        * @param $key
        * @param string $message
        * @return mixed
       */
       public function addFlash($key, string $message): mixed;





       /**
        * @param $key
        * @return mixed
       */
       public function getFlash($key): mixed;
}