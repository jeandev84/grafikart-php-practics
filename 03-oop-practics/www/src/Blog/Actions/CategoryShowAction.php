<?php
declare(strict_types=1);

namespace App\Blog\Actions;


use App\Blog\Entity\Category;
use App\Blog\Repository\CategoryRepository;
use App\Blog\Repository\PostRepository;
use Framework\Actions\RouterAwareAction;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @CategoryShowAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Actions
 */
class CategoryShowAction
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
        /** @var Category $category */
        $category = $this->categoryRepository->findBy('slug', $request->getAttribute('slug'));
        $params = $request->getQueryParams();
        $page   = (int)($params['p'] ?? 1);
        $posts  = $this->postRepository->findPaginatedPublicForCategory(12, $page, $category->id);
        $categories = $this->categoryRepository->findAll();

        return $this->renderer->render('@blog/index', compact('posts', 'categories', 'category'));
    }
}