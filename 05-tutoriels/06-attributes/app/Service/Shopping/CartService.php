<?php
declare(strict_types=1);

namespace App\Service\Shopping;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Shopping\Contract\CartServiceInterface;
use Grafikart\Http\Session\SessionInterface;
use Grafikart\Utils\Number;
use InvalidArgumentException;
use RuntimeException;

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
      protected string $cartKey = 'cart';


      /**
       * @var SessionInterface
      */
      protected SessionInterface $session;


      /**
       * @var ProductRepository
      */
      protected ProductRepository $productRepository;



      /**
       * @param SessionInterface $session
       * @param ProductRepository $productRepository
      */
      public function __construct(
          SessionInterface $session,
          ProductRepository $productRepository
      )
      {
          $this->session = $session;
          $this->productRepository = $productRepository;
      }






    /**
     * @param int $id
     * @return int
     */
    public function quantity(int $id): int
    {
        $cart = $this->cart();
        return intval($cart[$id]) ?? 0;
    }



    /**
     * @return float|int
     */
    public function count(): float|int
    {
        return array_sum($this->cart());
    }




    /**
     * @inheritDoc
     */
    public function cart(): array
    {
        return $this->session->get($this->cartKey, []);
    }




    /**
     * @return array
     */
    public function geProductIds(): array
    {
        return array_keys($this->cart());
    }




      /**
       * @return mixed
      */
      public function total(): mixed
      {
          $total       = 0;
          $productsIds = $this->geProductIds();
          $products    = $this->productRepository->findProductsInCart($productsIds);

          foreach ($products as $product) {
              $total += $product->getPrice() * $this->quantity($product->getId());
          }

          return $total;
    }



    /**
     * @return mixed
    */
    public function totalPrice(): mixed
    {
        return Number::format($this->total(), 2, ',', ' ');
    }



    public function totalPriceWithTva(): mixed
    {
        return Number::format($this->total() * Product::FR_TVA, 2, ',', ' ');
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
      * $data['cart']['quantity'] = [1 => 2, 3, 5];
      *
      * @param array $data
      * @return void
     */
     public function recalculate(array $data): void
     {
         $cart = $this->cart();

         foreach ($cart as $productId => $quantity) {
             if (isset($data[$this->cartKey]['quantity'][$productId])) {
                 $cart[$productId] = $data[$this->cartKey]['quantity'][$productId];
                 $this->session->set($this->cartKey, $cart);
             }
         }
     }





     /**
      * @param int $id
      * @return void
     */
     public function remove(int $id): void
     {
         $cart = $this->cart();

         unset($cart[$id]);

         $this->session->set($this->cartKey, $cart);
     }





     /**
      * @return void
     */
     public function clear(): void
     {
          $this->session->forget($this->cartKey);
     }







    /**
     * Incrementer
     *
     * @param int $id
     * @return void
     */
    public function increase(int $id): void {}





    /**
     * Decrementer
     *
     * @param int $id
     * @return void
     */
    public function decrease(int $id): void {}
}