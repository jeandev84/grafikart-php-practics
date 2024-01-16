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
}