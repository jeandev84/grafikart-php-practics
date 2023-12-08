<?php
declare(strict_types=1);

namespace App\Blog\Actions;


use App\Blog\Entity\Category;
use App\Blog\Repository\CategoryRepository;
use App\Blog\Repository\PostRepository;
use Framework\Actions\RouterAwareAction;
use Framework\Security\User\UserInterface;
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

    protected UserInterface $user;

    use RouterAwareAction;

    public function __construct(
        RendererInterface $renderer,
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        UserInterface $user
    )
    {
        $this->renderer  = $renderer;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }




    public function __invoke(Request $request)
    {
        $params = $request->getQueryParams();

        /** @var Category $category */
        $category = $this->categoryRepository->findBy('slug', $request->getAttribute('slug'));
        $page   = (int)($params['p'] ?? 1);

        $posts  = $this->postRepository->findPublicForCategory($category->id)->paginate(12, $page);
        $categories = $this->categoryRepository->findAll();

        return $this->renderer->render('@blog/index', [
            'posts' => $posts,
            'categories' => $categories,
            'category' => $category,
            'page'     => $page
        ]);
    }
}