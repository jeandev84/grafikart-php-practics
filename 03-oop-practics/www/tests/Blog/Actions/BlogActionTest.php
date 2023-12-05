<?php
declare(strict_types=1);

namespace Tests\Blog\Actions;


use App\Blog\Actions\BlogAction;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @BlogActionTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Blog\Actions
 */
class BlogActionTest extends TestCase
{


    protected BlogAction $action;

    protected $renderer;
    protected $pdo;
    protected $router;


    protected function setUp(): void
    {
        $this->renderer = $this->prophesize(RendererInterface::class);
        $this->renderer->render(Argument::any())->willReturn('');

        // Article de test
        $post = new \stdClass();
        $post->id = 9;
        $post->slug = 'demo-test';

        // PDO
        $this->pdo = $this->prophesize(\PDO::class);
        $pdoStatement     = $this->prophesize(\PDOStatement::class);
        $this->pdo->prepare(Argument::any())->willReturn($pdoStatement);
        $pdoStatement->execute(Argument::any())->willReturn(null);
        $pdoStatement->fetch()->willReturn($post);

        // Router
        $this->router = $this->prophesize(Router::class);

        // Action
        $this->action = new BlogAction(
            $this->renderer->reveal(),
            $this->pdo->reveal(),
            $this->router->reveal()
        );
    }


    public function testShowRedirect()
     {
          $this->router->generateUri('blog.show', ['id' => 9, 'slug' => 'demo-test'])->willReturn('/demo2');
          $request = (new ServerRequest('GET', '/'))
                     ->withAttribute('id', 9)
                     ->withAttribute('slug', 'demo');
          $response = call_user_func_array($this->action, [$request]);
          $this->assertEquals(301, $response->getStatusCode());
     }
}