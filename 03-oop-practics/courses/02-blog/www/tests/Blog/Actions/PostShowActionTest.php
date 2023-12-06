<?php
declare(strict_types=1);

namespace Tests\Blog\Actions;


use App\Blog\Actions\BlogAction;
use App\Blog\Actions\PostShowAction;
use App\Blog\Entity\Post;
use App\Blog\Repository\PostRepository;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @PostShowActionTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Blog\Actions
 *
 * FIX BUG prophesize()
 */
class PostShowActionTest extends TestCase
{


    protected $action;
    protected $renderer;
    protected $postRepository;
    protected $router;


    public function setUp(): void
    {
        $this->renderer = $this->prophesize(RendererInterface::class);
        $this->postRepository = $this->prophesize(PostRepository::class);
        $this->router = $this->prophesize(Router::class);
        $this->action = new PostShowAction(
            $this->renderer->reveal(),
            $this->router->reveal(),
            $this->postRepository->reveal()
        );
    }


    public function makePost(int $id, string $slug): Post
    {
        $post = new Post();
        $post->id = $id;
        $post->slug = $slug;
        return $post;
    }



    public function testShowRedirect()
     {
          $post = $this->makePost(9, 'azeaze-azeaze');
          $request = (new ServerRequest('GET', '/'))
                     ->withAttribute('id', $post->id)
                     ->withAttribute('slug', 'demo');

          $this->router->generateUri('blog.show', ['id' => $post->id, 'slug' => $post->slug])->willReturn('/demo2');
          $this->postRepository->findWithCategory($post->id)->willReturn($post);


          $response = call_user_func_array($this->action, [$request]);
          $this->assertEquals(301, $response->getStatusCode());
          $this->assertEquals(['/demo2'], $response->getHeader('Location'));
    }






    public function testShowRender()
    {
        $post = $this->makePost(9, 'azeaze-azeaze');
        $request = (new ServerRequest('GET', '/'))
            ->withAttribute('id', $post->id)
            ->withAttribute('slug', $post->slug);

        $this->postRepository->findWithCategory($post->id)->willReturn($post);
        $this->renderer->render('@blog/show', ['post' => $post])->willReturn('');

        $response = call_user_func_array($this->action, [$request]);
        $this->assertEquals(true, true);
    }



}