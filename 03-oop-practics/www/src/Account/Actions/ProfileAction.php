<?php
declare(strict_types=1);

namespace App\Account\Actions;


use Framework\Security\Auth;
use Framework\Templating\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @ProfileAction
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Account\Actions
 */
class ProfileAction
{

       protected RendererInterface $renderer;

       protected Auth $auth;

       public function __construct(
           RendererInterface $renderer,
           Auth $auth
       )
       {
           $this->renderer = $renderer;
           $this->auth     = $auth;
       }



       public function __invoke(ServerRequestInterface $request): mixed
       {
           return $this->renderer->render('@account/profile', [
                'user' => $this->auth->getUser()
           ]);
       }
}