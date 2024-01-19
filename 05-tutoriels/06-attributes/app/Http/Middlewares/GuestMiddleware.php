<?php
declare(strict_types=1);

namespace App\Http\Middlewares;

use App\Security\Token\UserTokenStorage;
use Grafikart\Container\Container;
use Grafikart\Http\Handlers\MiddlewareInterface;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;
use Grafikart\Http\Session\SessionInterface;

/**
 * AuthenticatedMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Middlewares
 */
class GuestMiddleware implements MiddlewareInterface
{
    protected SessionInterface $session;


    /**
     * @param Container $app
    */
    public function __construct(Container $app)
    {
        $this->session = $app[SessionInterface::class];
    }


    /**
     * @inheritDoc
    */
    public function process(ServerRequest $request, RequestHandlerInterface $handler): Response
    {
         if (! $this->session->has(UserTokenStorage::KEY)) {
              return new RedirectResponse("/login");
         }

         return $handler->handle($request);
    }
}