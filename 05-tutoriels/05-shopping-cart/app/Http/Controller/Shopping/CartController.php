<?php
declare(strict_types=1);

namespace App\Http\Controller\Shopping;

use App\Http\AbstractController;
use App\Repository\ProductRepository;
use App\Service\Shopping\CartService;
use App\Service\Shopping\Contract\CartServiceInterface;
use Grafikart\Container\Container;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\JsonResponse;
use Grafikart\Http\Response\Response;
use ReflectionException;

/**
 * CartController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
 */
class CartController extends AbstractController
{

      /**
       * @var CartService
      */
      protected CartService $cartService;


      /**
       * @param Container $app
      */
      public function __construct(Container $app)
      {
          parent::__construct($app);
          $this->cartService = $app['cart'];
      }





      /**
        * @param ServerRequest $request
        * @return Response
        * @throws ReflectionException
      */
      public function index(ServerRequest $request): Response
      {
          $productRepository = new ProductRepository($this->getConnection());
          $productIds        = $this->cartService->geProductIds();
          $products          = $productRepository->findProductsInCart($productIds);


          return $this->render('shopping/cart/index', [
              'products'    => $products,
              'cartService' => $this->cartService
          ]);
      }




     /**
      * Add to cart via ajax
      *
      * @param ServerRequest $request
      * @return JsonResponse
      * @throws ReflectionException
     */
      public function add(ServerRequest $request): JsonResponse
      {
           $json = ['error' => true];

           if(! $id = (int)$request->getAttribute('id')) {
                $json['message'] = "Vous n' avez pas selectionne de produit a ajouter au panier.";
           }

           $productRepository = new ProductRepository($this->getConnection());

           if (! $product = $productRepository->find($id)) {
               $json['message'] = "Le produit id#$id n'existe pas.";
           }

           $this->cartService->add($product->getId());

           $json['error']   = false;
           $json['total']   = $this->cartService->totalPrice();
           $json['count']   = $this->cartService->count();
           $json['message'] = 'Le produit a bien ete ajoute a votre panier';

           return new JsonResponse($json);
      }






    /**
     * @param ServerRequest $request
     * @return Response
    */
    public function delete(ServerRequest $request): Response
    {
        if(! $id = (int)$request->getAttribute('id')) {
            $this->addFlash('danger', "Vous n' avez pas selectionne de produit a ajouter au panier.");
            return $this->redirectToRoute('home');
        }

        $this->cartService->remove($id);

        return $this->redirectToRoute('cart.list');
    }





     /**
      * @param ServerRequest $request
      * @return Response
     */
     public function increase(ServerRequest $request): Response
     {
        return new Response(__METHOD__);
     }



     /**
      * @param ServerRequest $request
      * @return Response
     */
     public function decrease(ServerRequest $request): Response
     {
         return new Response(__METHOD__);
     }





     /**
      * @param ServerRequest $request
      * @return Response
     */
     public function clear(ServerRequest $request): Response
     {
          $this->cartService->clear();

          return $this->redirectToRoute('home');
     }



    public function addToCart(ServerRequest $request): Response
    {
        if(! $id = (int)$request->getAttribute('id')) {
            $this->addFlash('danger', "Vous n' avez pas selectionne de produit a ajouter au panier.");
            return $this->redirectToRoute('home');
        }

        $productRepository = new ProductRepository($this->getConnection());

        if (! $product = $productRepository->find($id)) {
            $this->addFlash('danger', "Le produit id#$id n'existe pas.");
            return $this->redirectToRoute('home');
        }

        $this->cartService->add($product->getId());

        $this->addFlash(
            'success',
            'Le produit a bien ete ajoute a votre panier <a href="javascript:history.back()">retourner sur le catalogue</a>'
        );

        return $this->redirectToRoute('home');
    }
}