<?php
declare(strict_types=1);

namespace App\Shop\Actions;


use App\Shop\Repository\ProductRepository;
use Framework\Actions\CrudAction;
use Framework\Database\ORM\EntityRepository;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;

/**
 * Created by PhpStorm at 10.12.2023
 *
 * @AdminProductAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Shop\Actions
 */
class AdminProductAction extends CrudAction
{


       /**
        * @var string
       */
       protected string $viewPath    = "@shop/admin/products";


       /**
        * @var string
       */
       protected string $routePrefix = 'shop.admin.products';


       /**
        * @inheritdoc
       */
       public function __construct(
           RendererInterface $renderer,
           Router $router,
           ProductRepository $repository,
           FlashService $flash
       )
       {
           parent::__construct($renderer, $router, $repository, $flash);
       }
}