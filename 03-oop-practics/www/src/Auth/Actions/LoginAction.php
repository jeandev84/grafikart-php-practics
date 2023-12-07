<?php
declare(strict_types=1);

namespace App\Auth\Actions;


use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @LoginAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Actions
 */
class LoginAction
{


    /**
     * @var RendererInterface
    */
    protected RendererInterface $renderer;



    /**
     * @param RendererInterface $renderer
    */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }



    /**
      * @param ServerRequestInterface $request
      *
      * @return void
    */
    public function __invoke(ServerRequestInterface $request): mixed
    {
        return $this->renderer->render("@auth/login");
    }
}