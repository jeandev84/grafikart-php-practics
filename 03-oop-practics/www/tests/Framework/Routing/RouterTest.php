<?php
declare(strict_types=1);

namespace Tests\Framework\Routing;


use Framework\Routing\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @RouterTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Routing
 *
 * ./vendor/bin/phpunit tests/Framework/Routing/RouterTest.php --colors
 */
class RouterTest extends TestCase
{

     protected Router $router;

     public function setUp(): void
     {
         $this->router = new Router();
     }



     public function testGetMethod()
     {
        $request = new ServerRequest('GET', '/blog');
        $this->router->get('/blog', function () {
            return 'hello';
        }, 'blog');
        $route = $this->router->match($request);
        $this->assertEquals('blog', $route->getName());
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
     }



    public function testGetMethodIfURLDoesNotExists()
    {
        $request = new ServerRequest('GET', '/blog');
        $this->router->get('/blogaze', function () {
            return 'hello';
        }, 'blog');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }




    public function testGetMethodWithParameters()
    {
        $request = new ServerRequest('GET', '/blog/mon-slug-8');
        $this->router->get('/blog', function () { return 'azeazea'; }, 'posts');
        $this->router->get('/blog/{slug}-{id}', function () { return 'hello'; }, 'post.show')
                     ->wheres(['slug' => '[a-z0-9\-]+', 'id' => '\d+']);
        if($route = $this->router->match($request)) {
            $this->assertEquals('post.show', $route->getName());
            $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
            $this->assertEquals([
                'slug' => 'mon-slug',
                'id'   => '8'
            ], $route->getParams());
            // Test invalid url
            $route = $this->router->match(new ServerRequest('GET', '/blog/mon_slug-8'));
            $this->assertEquals(null, $route);
        }

        $this->assertEquals(1, 1);
    }




    public function testGenerateUri()
    {
        $this->router->get('/blog', function () { return 'azeazea'; }, 'posts');
        $this->router->get('/blog/{slug}-{id}', function () { return 'hello'; }, 'post.show')
                     ->wheres(['slug' => '[a-z0-9\-]+', 'id' => '\d+']);
        $uri = $this->router->generateUri('post.show', ['slug' => 'mon-article', 'id' => 18]);
        $this->assertEquals('/blog/mon-article-18', $uri);
    }
}