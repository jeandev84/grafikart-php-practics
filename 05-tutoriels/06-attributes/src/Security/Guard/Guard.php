<?php
declare(strict_types=1);

namespace Grafikart\Security\Guard;

/**
 * Guard
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Guard
*/
class Guard implements GuardInterface
{
     public function denyAccessUnless(string|array $roles)
     {
          dump($roles);
          die('Access interdit');
     }
}