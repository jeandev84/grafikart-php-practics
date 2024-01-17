<?php
declare(strict_types=1);

namespace App\Service\Shopping;

use App\Service\Shopping\Contract\CartServiceInterface;
use Grafikart\Http\Session\SessionInterface;

/**
 * CartService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Service\Shopping
*/
class CartService implements CartServiceInterface
{

      /**
       * @var string
      */
      protected string $cartKey = 'session.cart';


      /**
       * @var SessionInterface
      */
      protected SessionInterface $session;


      /**
       * @param SessionInterface $session
      */
      public function __construct(SessionInterface $session)
      {
          $this->session = $session;
      }



     /**
      * @inheritDoc
     */
     public function add(int $id): static
     {
         $cart = $this->cart();

         if (isset($cart[$id])) {
             $cart[$id]++;
         } else {
             $cart[$id] = 1;
         }

         $this->session->set($this->cartKey, $cart);

         return $this;
     }


     /**
      * @inheritDoc
     */
     public function cart(): array
     {
         return $this->session->get($this->cartKey, []);
     }
}