<?php
declare(strict_types=1);

namespace App\Blog\Actions;


use App\Blog\Repository\CategoryRepository;
use App\Blog\Repository\PostRepository;
use Framework\Actions\RouterAwareAction;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @PostIndexAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Actions
 */
class PostIndexAction
{


    protected RendererInterface $renderer;

    protected PostRepository $postRepository;

    protected CategoryRepository $categoryRepository;

    use RouterAwareAction;

    public function __construct(
        RendererInterface $renderer,
        PostRepository $postRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->renderer  = $renderer;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }




    public function __invoke(Request $request)
    {
        $params = $request->getQueryParams();
        $page   = (int)($params['p'] ?? 1);
        $posts  = $this->postRepository->findPaginatedPublic(12, $page);
        $categories = $this->categoryRepository->findAll();

        return $this->renderer->render('@blog/index', compact('posts', 'categories'));
    }
}