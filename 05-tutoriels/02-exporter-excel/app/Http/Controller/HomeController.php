<?php
declare(strict_types=1);

namespace App\Http\Controller;

use Grafikart\Http\Response;
use Grafikart\Http\ServerRequest;

/**
 * HomeController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http\Controller
 */
class HomeController
{
     public function index(ServerRequest $request): Response
     {
         dump($request->getQueryParams());
         return new Response(__METHOD__);
     }
}