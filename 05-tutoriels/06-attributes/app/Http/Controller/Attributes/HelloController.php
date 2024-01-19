<?php
declare(strict_types=1);

namespace App\Http\Controller\Attributes;

use App\Http\AbstractController;
use Grafikart\Http\Request\ServerRequest;
use Grafikart\Http\Response\Response;
use Grafikart\Routing\Attributes\Route;
use Grafikart\Security\Attributes\Role;
use Grafikart\Security\Guard\Guard;
use JetBrains\PhpStorm\Deprecated;

/**
 * HelloController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller\Attributes
 */
##[Deprecated]
class HelloController extends AbstractController
{

      #[
          Route(path: '/hello/{name}', requirements: ['name' => '\w+']),
          #Role('USER')
      ]
      public function hello(ServerRequest $request/*, Guard $guard*/): Response
      {
           #$guard->denyAccessUnless(User::class);
           #$guard->denyAccessUnless(\App\Entity\Roles\Role::USER);
           return $this->render('attributes/hello');
      }



    #[
        Route(path: '/goodbye/{name?}', requirements: ['name' => '\w+'])
    ]
    public function goodbye(ServerRequest $request): Response
    {
        return $this->render('attributes/goodbye');
    }
}