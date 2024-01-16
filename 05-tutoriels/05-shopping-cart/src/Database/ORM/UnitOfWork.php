<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM;

/**
 * UnitOfWork
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM
 */
class UnitOfWork
{
     protected array $identityMap = [];


     public function __construct()
     {
     }



     public function persist($object): void
     {

     }



     public function remove($object): void
     {

     }
}