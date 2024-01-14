<?php
declare(strict_types=1);

namespace App\Http\Handlers;

use Grafikart\Container\Container;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use Grafikart\Templating\Renderer;

/**
 * NotFoundHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Handlers
 */
class NotFoundHandler implements RequestHandlerInterface
{

    protected Renderer $renderer;

    public function __construct(Container $app)
    {
        $this->renderer = $app[Renderer::class];
    }


    /**
     * @inheritDoc
    */
    public function handle(ServerRequest $request): Response
    {
         dump($request->getMethod());
         dump($request->getPath());

         return new Response($this->renderer->render('errors/404.phtml'));
    }
}