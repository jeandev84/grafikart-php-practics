<?php
declare(strict_types=1);

namespace App\Blog\Actions;




use App\Blog\Entity\Post;
use App\Blog\Repository\CategoryRepository;
use App\Blog\Repository\PostRepository;
use App\Blog\Upload\PostUpload;
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
     * @var CategoryRepository
    */
    protected CategoryRepository $categoryRepository;


    /**
     * @var PostUpload
    */
    protected PostUpload $postUpload;


    /**
     * @param RendererInterface $renderer
     *
     * @param Router $router
     *
     * @param PostRepository $repository
     *
     * @param FlashService $flash
     * @param CategoryRepository $categoryRepository
     * @param PostUpload $postUpload
     */
    public function __construct(
        RendererInterface $renderer,
        Router $router,
        PostRepository $repository,
        FlashService $flash,
        CategoryRepository $categoryRepository,
        PostUpload $postUpload
    )
    {
        parent::__construct($renderer, $router, $repository, $flash);
        $this->categoryRepository = $categoryRepository;
        $this->postUpload = $postUpload;
    }


    /**
     * @param array $params
     * @return array
    */
    protected function formParams(array $params): array
    {
        $params['categories'] = $this->categoryRepository->findList();

        return $params;
    }




    /**
     * @param ServerRequestInterface $request
     *
     * @return array
    */
    protected function getParams(ServerRequestInterface $request): array
    {
        $params = array_merge($request->getParsedBody(), $request->getUploadedFiles());

        // Uploader le fichier
        $params['image'] = $this->postUpload->upload($params['image']);

        $params =  array_filter($params, function ($key) {
            return in_array($key, ['name', 'slug', 'content', 'created_at', 'category_id', 'image']);
        }, ARRAY_FILTER_USE_KEY);

        return array_merge($params, ['updated_at' => date('Y-m-d H:i:s')]);
    }



    protected function getValidator(ServerRequestInterface $request): Validator
    {
         return parent::getValidator($request)
                ->required('content', 'name', 'slug', 'created_at', 'category_id')
                ->length('content', 10)
                ->length('name', 2, 250)
                ->length('slug', 2, 50)
                ->exists('category_id', $this->categoryRepository->getTable(), $this->categoryRepository->getPdo())
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