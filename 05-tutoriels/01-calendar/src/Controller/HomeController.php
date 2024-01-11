<?php
declare(strict_types=1);

namespace App\Controller;

use App\AbstractController;
use App\Http\Response;
use App\Http\ServerRequest;

/**
 * HomeController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Controller
 */
class HomeController extends AbstractController
{
     public function index(ServerRequest $request): Response
     {
        return $this->render('index.php');
     }
}