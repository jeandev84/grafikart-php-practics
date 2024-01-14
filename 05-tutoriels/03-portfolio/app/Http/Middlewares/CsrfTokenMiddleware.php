<?php
declare(strict_types=1);

namespace App\Http\Middlewares;

use App\Security\Token\CsrfToken;
use Grafikart\Container\Container;
use Grafikart\Http\Handlers\MiddlewareInterface;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;
use Grafikart\Security\Token\Csrf\CsrfTokenInterface;

/**
 * CsrfTokenMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Middlewares
 */
class CsrfTokenMiddleware implements MiddlewareInterface
{

    protected CsrfTokenInterface $csrfToken;


    /**
     * @param Container $app
    */
    public function __construct(Container $app)
    {
        $this->csrfToken = $app[CsrfTokenInterface::class];
    }


    /**
     * @inheritDoc
     */
    public function process(ServerRequest $request, RequestHandlerInterface $handler): Response
    {
        $token = $request->getQueryParams()['csrf'] ?? '';

        if (!$this->csrfToken->isValidToken($token)) {
             return new RedirectResponse('/csrf');
        }

        return $handler->handle($request);
    }
}