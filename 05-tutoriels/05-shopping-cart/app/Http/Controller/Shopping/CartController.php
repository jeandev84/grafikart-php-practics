<?php
declare(strict_types=1);

namespace App\Http\Controller\Shopping;

use App\Http\AbstractController;
use App\Service\Shopping\CartService;
use App\Service\Shopping\Contract\CartServiceInterface;
use Grafikart\Container\Container;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;

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
          $this->cartService = new CartService($this->session);
      }



      /**
       * @param ServerRequest $request
       * @return Response
      */
      public function index(ServerRequest $request): Response
      {
          return $this->render('shopping/cart/index');
      }



      /**
       * @param ServerRequest $request
       * @return Response
      */
      public function add(ServerRequest $request): Response
      {
           if($id = (int)$request->getAttribute('product')) {

           }


           return new Response(__METHOD__);
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
}