<?php
declare(strict_types=1);

namespace App\Account;


use App\Account\Actions\ProfileAction;
use App\Account\Actions\SignupAction;
use App\Contact\Actions\ContactAction;
use Framework\Middleware\Security\LoggedInMiddleware;
use Framework\Module;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;

/**
 * Created by PhpStorm at 08.12.2023
 *
 * @AccountModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Account
*/
class AccountModule extends Module
{

      const MIGRATIONS = __DIR__.'/migrations';
      const DEFINITIONS = __DIR__.'/definitions.php';


      public function __construct(Router $router, RendererInterface $renderer)
      {
          $renderer->addPath('account', __DIR__.'/views');
          $router->map('GET|POST', '/signup', SignupAction::class, 'account.signup');
          $router->get('/profile', ProfileAction::class, 'account.profile')
                 ->middleware([
                     LoggedInMiddleware::class
                 ]);
      }
}