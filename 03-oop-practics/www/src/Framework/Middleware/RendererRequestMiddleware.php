<?php
declare(strict_types=1);

namespace App\Framework\Middleware;


use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @RendererRequestMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Framework\Middleware
 */
class RendererRequestMiddleware implements MiddlewareInterface
{

    /**
     * @var RendererInterface
    */
    protected RendererInterface $renderer;


    /**
     * @param RendererInterface $renderer
    */
    public function __construct(
        RendererInterface $renderer
    )
    {
        $this->renderer = $renderer;
    }


    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
         $domain = sprintf('%s://%s%s',
      $request->getUri()->getScheme(),
              $request->getUri()->getHost(),
              $request->getUri()->getPort() ? ':' . $request->getUri()->getPort() : ''
         );

         $this->renderer->addGlobal('domain', $domain);
         return $handler->handle($request);
    }
}