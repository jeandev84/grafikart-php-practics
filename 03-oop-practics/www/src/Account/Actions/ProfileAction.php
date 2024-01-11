<?php
declare(strict_types=1);

namespace App\Account\Actions;


use App\Auth\Repository\UserRepository;
use Framework\Security\Auth;
use Framework\Session\FlashService;
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

       /**
        * @var RendererInterface
       */
       protected RendererInterface $renderer;



       /**
        * @var Auth
       */
       protected Auth $auth;



       public function __construct(RendererInterface $renderer, Auth $auth)
       {
           $this->renderer = $renderer;
           $this->auth     = $auth;
       }


       /**
        * @param ServerRequestInterface $request
        * @return mixed
       */
       public function __invoke(ServerRequestInterface $request): mixed
       {
           return $this->renderer->render('@account/profile', [
                'user' => $this->auth->getUser()
           ]);
       }
}