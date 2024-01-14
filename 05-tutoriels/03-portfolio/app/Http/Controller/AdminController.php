<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\AbstractController;
use App\Security\Token\UserTokenStorage;
use Grafikart\Container\Container;
use Grafikart\Http\Response\RedirectResponse;

/**
 * AdminController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
 */
class AdminController extends AbstractController
{
      protected string $layout = 'layouts/admin';

      public function __construct(Container $app)
      {
          parent::__construct($app);
          // Move this in Authenticated user Middleware
          if (!$this->session->has(UserTokenStorage::KEY)) {
              $response = new RedirectResponse('/login');
              $response->send();
              exit;
          }
      }
}