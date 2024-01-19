<?php
declare(strict_types=1);

namespace App\Service\Shopping\Contract;


/**
 * CartServiceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Service\Shopping\Contract
 */
interface CartServiceInterface
{

     /**
      * Add item to the cart
      *
      * @param int $id
      * @return mixed
     */
     public function add(int $id): mixed;




     /**
      * Returns cart
      *
      * @return array
     */
     public function cart(): array;




     // public function increase(): mixed;


     // public function decrease(): mixed;
}