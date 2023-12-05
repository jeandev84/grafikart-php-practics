<?php
declare(strict_types=1);

namespace App\Blog\Actions;


use App\Blog\Table\PostTable;
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

    protected $postTable;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer, Router $router, PostTable $postTable)
    {
        $this->renderer  = $renderer;
        $this->router    = $router;
        $this->postTable = $postTable;
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
        $posts = $this->pdo
                      ->query("SELECT * FROM posts ORDER BY created_at LIMIT 10")
                      ->fetchAll();


        return $this->renderer->render('@blog/index', compact('posts'));
    }


    public function show(Request $request): mixed
    {
        $id   = $request->getAttribute('id');
        $slug = $request->getAttribute('slug');
        $post = $this->postTable->find($id);

        if ($post->slug !== $slug) {
            /*
            $redirectUri = $this->router->generateUri('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
            return (new Response())
                   ->withStatus(301)
                   ->withHeader('Location', $redirectUri);
            */
            return $this->redirect('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return $this->renderer->render('@blog/show', [
             'post' => $post
        ]);
    }
}