<?php
declare(strict_types=1);

namespace App\Blog\Actions;


use App\Blog\Repository\PostRepository;
use Framework\Actions\RouterAwareAction;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @BlogAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Blog\Actions
 */
class BlogAction
{


    protected RendererInterface $renderer;

    protected Router $router;

    protected $postRepository;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer, Router $router, PostRepository $postRepository)
    {
        $this->renderer  = $renderer;
        $this->router    = $router;
        $this->postRepository = $postRepository;
    }



    public function __invoke(Request $request)
    {
         if ($request->getAttribute('id')) {
             return $this->show($request);
         }

         return $this->index();
    }


    public function index(): string
    {
        $posts = $this->postRepository->findPaginated();

        return $this->renderer->render('@blog/index', compact('posts'));
    }


    public function show(Request $request): mixed
    {
        $id   = (int)$request->getAttribute('id');
        $slug = $request->getAttribute('slug');
        $post = $this->postRepository->find($id);

        if ($post->slug !== $slug) {
            return $this->redirect('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return $this->renderer->render('@blog/show', [
             'post' => $post
        ]);
    }
}