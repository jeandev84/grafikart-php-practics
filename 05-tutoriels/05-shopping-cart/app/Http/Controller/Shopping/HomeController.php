<?php
declare(strict_types=1);

namespace App\Http\Controller\Shopping;

use App\Http\AbstractController;
use App\Repository\ProductRepository;
use App\Service\Shopping\CartService;
use Grafikart\Container\Container;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use ReflectionException;

/**
 * HomeController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Shopping
 */
class HomeController extends AbstractController
{

    /**
     * @param Container $app
    */
    public function __construct(Container $app)
    {
        parent::__construct($app);
    }




    /**
     * @param ServerRequest $request
     * @return Response
     * @throws ReflectionException
    */
    public function index(ServerRequest $request): Response
    {
        $productRepository = new ProductRepository($this->getConnection());

        return $this->render('shopping/home/index', [
            'products'   => $productRepository->findAll()
        ]);
    }
}