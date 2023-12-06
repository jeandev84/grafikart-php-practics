<?php
declare(strict_types=1);

namespace App\Blog\Actions;


use App\Blog\Entity\Category;
use App\Blog\Entity\Post;
use App\Blog\Repository\CategoryRepository;
use App\Blog\Repository\PostRepository;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @CategoryCrudAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Actions
 */
class CategoryCrudAction
{

    /**
     * @var string
     */
    protected string $viewPath = '@blog/admin/categories';


    /**
     * @var string
     */
    protected string $routePrefix = 'blog.admin.category';


    /**
     * @param RendererInterface $renderer
     *
     * @param Router $router
     *
     * @param CategoryRepository $repository
     *
     * @param FlashService $flash
     */
    public function __construct(RendererInterface $renderer, Router $router, CategoryRepository $repository, FlashService $flash)
    {
        parent::__construct($renderer, $router, $repository, $flash);
    }





    /**
     * @param ServerRequestInterface $request
     *
     * @return array
     */
    protected function getParams(ServerRequestInterface $request): array
    {
        $params =  array_filter($request->getParsedBody(), function ($key) {
            return in_array($key, ['name', 'slug', 'content', 'created_at']);
        }, ARRAY_FILTER_USE_KEY);

        return array_merge($params, ['updated_at' => date('Y-m-d H:i:s')]);
    }



    protected function getValidator(ServerRequestInterface $request): Validator
    {
        return parent::getValidator($request)
                ->required('name', 'slug')
                ->length('name', 2, 250)
                ->length('slug', 2, 50)
                ->slug('slug');
    }



    /**
     * @return mixed
     */
    protected function getNewEntity(): mixed
    {
        return new Category();
    }
}