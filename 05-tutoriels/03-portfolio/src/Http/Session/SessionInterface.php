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
        * @return mixed
       */
       public function forget($key): mixed;





       /**
        * @return mixed
       */
       public function destroy(): mixed;





       /**
        * @param $type
        * @param string $message
        * @return mixed
       */
       public function addFlash($type, string $message): mixed;





       /**
        * @param $type
        * @return mixed
       */
       public function getFlash($type): mixed;




       /**
        * @return bool
       */
       public function hasFlashes(): bool;





       /**
        * @return void
       */
       public function removeFlashes(): void;





       /**
        * @return array
       */
       public function getFlashes(): array;
}