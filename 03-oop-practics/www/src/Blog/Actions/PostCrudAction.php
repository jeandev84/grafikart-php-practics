<?php
declare(strict_types=1);

namespace App\Blog\Actions;




use App\Blog\Entity\Post;
use App\Blog\Repository\PostRepository;
use Framework\Actions\CrudAction;
use Framework\Routing\Router;
use Framework\Session\FlashService;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @PostCrudAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Admin\Actions
 */
class PostCrudAction extends CrudAction
{
    /**
     * @var string
     */
    protected string $viewPath = '@blog/admin/posts';


    /**
     * @var string
    */
    protected string $routePrefix = 'blog.admin.post';


    /**
     * @param RendererInterface $renderer
     *
     * @param Router $router
     *
     * @param PostRepository $repository
     *
     * @param FlashService $flash
    */
    public function __construct(RendererInterface $renderer, Router $router, PostRepository $repository, FlashService $flash)
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
            return in_array($key, ['name', 'slug', 'content', 'created_at', 'category_id']);
        }, ARRAY_FILTER_USE_KEY);

        return array_merge($params, ['updated_at' => date('Y-m-d H:i:s')]);
    }



    protected function getValidator(ServerRequestInterface $request): Validator
    {
         return parent::getValidator($request)
                ->required('content', 'name', 'slug', 'created_at')
                ->length('content', 10)
                ->length('name', 2, 250)
                ->length('slug', 2, 50)
                ->dateTime('created_at')
                ->slug('slug');
    }


    /**
     * @return mixed
    */
    protected function getNewEntity(): mixed
    {
         $post = new Post();
         $post->created_at = new \DateTime();
         return $post;
    }
}